<?php

function ajax_save_add_product_meta() {

    global $woocommerce_auctions;

    $product_id = isset( $_POST['dokan_product_id'] ) && ! empty( $_POST['dokan_product_id'] ) ? absint(
        $_POST['dokan_product_id'] ) : 0;

    $seller_id = dokan_get_current_user_id();

    if ( empty( $product_id ) ) {

        $post_title   = isset( $_POST['post_title'] ) ? trim( $_POST['post_title'] ) : '';
        $post_content = isset( $_POST['post_content'] ) ? trim( $_POST['post_content'] ) : '';
        $post_excerpt = isset( $_POST['post_excerpt'] ) ? trim( $_POST['post_excerpt'] ) : '';
//$product_cat = isset( $_POST['product_cat'] ) ? absint( $_POST['product_cat'] ) : '';
        $featured_image = isset( $_POST['feat_image_id'] ) ? absint( $_POST['feat_image_id'] ) : '';

        $product_status = dokan_get_new_post_status();

        $post_data = apply_filters( 'dokan_insert_auction_product_post_data', array(
            'post_type'    => 'product',
            'post_status'  => $product_status,
            'post_title'   => $post_title,
            'post_content' => $post_content,
            'post_excerpt' => $post_excerpt,
            'post_author'  => dokan_get_current_user_id(),
        ) );

        $product_id = wp_insert_post( $post_data );

        if ( $product_id ) {
            update_post_meta( $product_id, '_auction_type', 'normal', true );

// Set featured images
            if ( $featured_image ) {
                set_post_thumbnail( $product_id, $featured_image );
            }

// Set Gallery Images
            if ( ! empty( $_POST['product_image_gallery'] ) ) {
                $attachment_ids = array_filter( explode( ',', wc_clean( $_POST['product_image_gallery'] ) ) );
                update_post_meta( $product_id, '_product_image_gallery', implode( ',', $attachment_ids ) );
            }

/** set product category * */
            if ( dokan_get_option( 'product_category_style', 'dokan_selling', 'single' ) == 'single' ) {
//wp_set_object_terms( $product_id, (int) $_POST['product_cat'], 'product_cat' );
            } else {

                if ( isset( $_POST['product_cat'] ) && ! empty( $_POST['product_cat'] ) ) {
                    $cat_ids = array_map( 'intval', (array) $_POST['product_cat'] );
                    wp_set_object_terms( $product_id, $cat_ids, 'product_cat' );
                }

            }

// Set Product tags
            if ( isset( $_POST['product_tag'] ) ) {
                $tags_ids = array_map( 'intval', (array) $_POST['product_tag'] );
            } else {
                $tags_ids = array();
            }

            wp_set_object_terms( $product_id, $tags_ids, 'product_tag' );

// Set product type
            wp_set_object_terms( $product_id, 'auction', 'product_type' );
            $woocommerce_auctions->product_save_data( $product_id, get_post( $product_id ) );

            wp_send_json_success(
                [
                    'id' => $product_id,
                ]
            );

        } else {

            update_post_meta( $product_id, '_auction_type', 'normal', true );

            $address       = isset( $_POST['address'] ) ? $_POST['address'] : '';
            $home_details  = isset( $_POST['home_details'] ) ? $_POST['home_details'] : '';
            $contact       = isset( $_POST['contact'] ) ? $_POST['contact'] : '';
            $home_features = isset( $_POST['home_features'] ) ? $_POST['home_features'] : '';
            $video         = isset( $_POST['video'] ) ? $_POST['video'] : '';

            $property_data = [
                'address'       => $address,
                'home_details'  => $home_details,
                'contact'       => $contact,
                'home_features' => $home_features,
                'video'         => $video,
            ];

            $product_info = array(
                'ID'           => $product_id,
                'post_title'   => sanitize_text_field( $_POST['post_title'] ),

//'post_content' => $_POST['post_content'],
                'post_excerpt' => $_POST['post_excerpt'],
                'post_status'  => isset( $_POST['post_status'] ) ? $_POST['post_status'] : 'pending',
//'comment_status' => isset( $_POST['_enable_reviews'] ) ? 'open' : 'closed'
                'post_author'  => dokan_get_current_user_id(),
            );

            wp_update_post( $product_info );

            if ( ! empty( $property_data ) ) {
                update_post_meta( $product_id, 'property_data', $property_data );
            }

            if ( ! empty( $address['address_1'] ) ) {
                update_post_meta( $product_id, '_address_1', $address['address_1'] );
            }

            if ( ! empty( $address['address_2'] ) ) {
                update_post_meta( $product_id, '_address_2', $address['address_2'] );
            }

            if ( ! empty( $address['city'] ) ) {
                update_post_meta( $product_id, '_city', $address['city'] );
            }

            if ( ! empty( $address['state'] ) ) {
                update_post_meta( $product_id, '_state', $address['state'] );
            }

            if ( ! empty( $address['zip_code'] ) ) {
                update_post_meta( $product_id, '_zip_code', $address['zip_code'] );
            }

            if ( ! empty( $home_details['property_type'] ) ) {
                update_post_meta( $product_id, '_property_type', $home_details['property_type'] );
            }

            if ( ! empty( $home_details['home_size'] ) ) {
                update_post_meta( $product_id, '_home_size', $home_details['home_size'] );
            }

            if ( ! empty( $home_details['lot_size'] ) ) {
                update_post_meta( $product_id, '_lot_size', $home_details['lot_size'] );
            }

            if ( ! empty( $home_details['lot_unit'] ) ) {
                update_post_meta( $product_id, '_lot_unit', $home_details['lot_unit'] );
            }

            if ( ! empty( $home_details['bedrooms'] ) ) {
                update_post_meta( $product_id, '_bedrooms', $home_details['bedrooms'] );
            }

            if ( ! empty( $home_details['bathrooms'] ) ) {
                update_post_meta( $product_id, '_bathrooms', $home_details['bathrooms'] );
            }

            if ( ! empty( $home_details['half_bathrooms'] ) ) {
                update_post_meta( $product_id, '_half_bathrooms', $home_details['half_bathrooms'] );
            }

/** set images **/
            $featured_image = absint( $_POST['feat_image_id'] );

            if ( $featured_image ) {
                set_post_thumbnail( $product_id, $featured_image );
            } else {
                delete_post_thumbnail( $product_id );
            }

// Gallery Images
            $attachment_ids = array_filter( explode( ',', wc_clean( $_POST['product_image_gallery'] ) ) );
            update_post_meta( $product_id, '_product_image_gallery', implode( ',', $attachment_ids ) );
// Set product type
            wp_set_object_terms( $product_id, 'auction', 'product_type' );
            $woocommerce_auctions->product_save_data( $product_id, get_post( $product_id ) );

//var_dump( $_REQUEST );
            wp_send_json_success( ['id' => $product_id] );

        }

    }

}