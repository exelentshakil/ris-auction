<?php
namespace RIS\Auction\Api;

class RealisityApi {

    /** @var string $base the route base */
    protected $base = '/ris-auction';

    /**
     * Register the routes for this class
     *
     * GET/POST /products
     * GET /products/count
     * GET/PUT/DELETE /products/<id>
     * GET /products/<id>/reviews
     *
     * @since 2.1
     * @param array $routes
     * @return array
     */
    public function register_routes() {
        # GET/POST /products
        $routes[$this->base] = array(
            array( array( $this, 'get_products' ), WC_API_Server::READABLE ),
            array( array( $this, 'create_product' ), WC_API_SERVER::CREATABLE | WC_API_Server::ACCEPT_DATA ),
        );
    }

    /**
     * Get all products
     *
     * @since 2.1
     * @param string $fields
     * @param string $type
     * @param array $filter
     * @param int $page
     * @return array
     */
    public function get_products( $fields = null, $type = null, $filter = array(), $page = 1 ) {

        if ( ! empty( $type ) ) {
            $filter['type'] = $type;
        }

        $filter['page'] = $page;

        $query = $this->query_products( $filter );

        $products = array();

        foreach ( $query->posts as $product_id ) {

            if ( ! $this->is_readable( $product_id ) ) {
                continue;
            }

            $products[] = current( $this->get_product( $product_id, $fields ) );
        }

        $this->server->add_pagination_headers( $query );

        return array( 'products' => $products );
    }

    /**
     * Create a new product
     *
     * @since 2.2
     * @param array $data posted data
     * @return array
     */
    public function create_product( $data ) {
        $id = 0;

        try {

            if ( ! isset( $data['product'] ) ) {
                throw new WC_API_Exception( 'woocommerce_api_missing_product_data', sprintf( __( 'No %1$s data specified to create %1$s', 'woocommerce' ), 'product' ), 400 );
            }

            $data = $data['product'];

// Check permissions
            if ( ! current_user_can( 'publish_products' ) ) {
                throw new WC_API_Exception( 'woocommerce_api_user_cannot_create_product', __( 'You do not have permission to create products', 'woocommerce' ), 401 );
            }

            $data = apply_filters( 'woocommerce_api_create_product_data', $data, $this );

// Check if product title is specified
            if ( ! isset( $data['title'] ) ) {
                throw new WC_API_Exception( 'woocommerce_api_missing_product_title', sprintf( __( 'Missing parameter %s', 'woocommerce' ), 'title' ), 400 );
            }

// Check product type
            if ( ! isset( $data['type'] ) ) {
                $data['type'] = 'simple';
            }

// Set visible visibility when not sent
            if ( ! isset( $data['catalog_visibility'] ) ) {
                $data['catalog_visibility'] = 'visible';
            }

// Validate the product type
            if ( ! in_array( wc_clean( $data['type'] ), array_keys( wc_get_product_types() ) ) ) {
                throw new WC_API_Exception( 'woocommerce_api_invalid_product_type', sprintf( __( 'Invalid product type - the product type must be any of these: %s', 'woocommerce' ), implode( ', ', array_keys( wc_get_product_types() ) ) ), 400 );
            }

            // Enable description html tags.
            $post_content = isset( $data['description'] ) ? wc_clean( $data['description'] ) : '';

            if ( $post_content && isset( $data['enable_html_description'] ) && true === $data['enable_html_description'] ) {

                $post_content = $data['description'];
            }

            // Enable short description html tags.
            $post_excerpt = isset( $data['short_description'] ) ? wc_clean( $data['short_description'] ) : '';

            if ( $post_excerpt && isset( $data['enable_html_short_description'] ) && true === $data['enable_html_short_description'] ) {
                $post_excerpt = $data['short_description'];
            }

            $new_product = array(
                'post_title'   => wc_clean( $data['title'] ),
                'post_status'  => ( isset( $data['status'] ) ? wc_clean( $data['status'] ) : 'publish' ),
                'post_type'    => 'product',
                'post_excerpt' => ( isset( $data['short_description'] ) ? $post_excerpt : '' ),
                'post_content' => ( isset( $data['description'] ) ? $post_content : '' ),
                'post_author'  => get_current_user_id(),
            );

            // Attempts to create the new product
            $id = wp_insert_post( $new_product, true );

// Checks for an error in the product creation
            if ( is_wp_error( $id ) ) {
                throw new WC_API_Exception( 'woocommerce_api_cannot_create_product', $id->get_error_message(), 400 );
            }

// Check for featured/gallery images, upload it and set it
            if ( isset( $data['images'] ) ) {
                $this->save_product_images( $id, $data['images'] );
            }

            // Save product meta fields
            $this->save_product_meta( $id, $data );

// Save variations
            if ( isset( $data['type'] ) && 'variable' == $data['type'] && isset( $data['variations'] ) && is_array( $data['variations'] ) ) {
                $this->save_variations( $id, $data );
            }

            // Clear cache/transients
            wc_delete_product_transients( $id );

            $this->server->send_status( 201 );

            return $this->get_product( $id );
        } catch ( WC_API_Exception $e ) {
            // Remove the product when fails
            $this->clear_product( $id );

            return new WP_Error( $e->getErrorCode(), $e->getMessage(), array( 'status' => $e->getCode() ) );
        }

    }

}