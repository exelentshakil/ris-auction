<?php
namespace RIS\Auction;

class Assets {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );

        add_action( 'wp_enqueue_scripts', [$this, 'common_scripts'] );
        add_action( 'admin_enqueue_scripts', [$this, 'common_scripts'] );

    }

    public function common_scripts() {
        // Default
        wp_enqueue_script( 'wp-util' );
        wp_enqueue_script( 'jquery-ui-mouse' );
        wp_enqueue_script( 'jquery-ui-accordion' );
        wp_enqueue_script( 'jquery-ui-autocomplete' );
        wp_enqueue_script( 'jquery-ui-slider' );
        wp_enqueue_script( 'jquery-datetimepicker-min' );
        wp_enqueue_script( 'year-select' );
        wp_enqueue_script( 'swal' );

        wp_enqueue_script( 'main' );
        wp_enqueue_script( 'bootstrap' );

        wp_enqueue_script( 'stepper' );
        wp_enqueue_style( 'stepper' );
        wp_enqueue_style( 'bootstrap' );

        wp_enqueue_script( 'add-new-form' );

        //wp_enqueue_script( 'update-new-form' );
        wp_enqueue_style( 'add-new-form' );

        wp_enqueue_media();

        wp_enqueue_script( 'media-upload' );

        wp_enqueue_script( 'file-upload' );

        wp_localize_script( 'main', 'RIS_Notify', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'ris_nonce' ),
        ] );
    }

    public function enqueue_scripts() {
        $styles  = $this->get_styles();
        $scripts = $this->get_scripts();

        $this->register_styles( $styles );
        $this->register_scripts( $scripts );
    }

    public function register_styles( $styles ) {

        foreach ( $styles as $handle => $style ) {
            $deps    = isset( $style['deps'] ) ? $style['deps'] : [];
            $version = isset( $style['version'] ) ? $style['version'] : '1.0';
            wp_register_style( $handle, $style['src'], $deps, $version );
        }

    }

    public function register_scripts( $scripts ) {

        foreach ( $scripts as $handle => $script ) {
            $deps    = isset( $script['deps'] ) ? $script['deps'] : [];
            $version = isset( $script['version'] ) ? $script['version'] : '1.0';

            wp_register_script( $handle, $script['src'], $deps, $version, true );
        }

    }

    public function get_styles() {

        return [
            'main'         => [
                'src'     => RIS_AUCTION_ASSETS . '/css/main.css',
                'version' => filemtime( RIS_AUCTION_PATH . '/assets/css/main.css' ),
                'deps'    => [],
            ],
            'add-new-form' => [
                'src'     => RIS_AUCTION_ASSETS . '/css/add-new-form.css',
                'version' => filemtime( RIS_AUCTION_PATH . '/assets/css/add-new-form.css' ),
                'deps'    => [],
            ],
            'stepper'      => [
                'src'     => RIS_AUCTION_ASSETS . '/css/stepper.css',
                'version' => filemtime( RIS_AUCTION_PATH . '/assets/css/stepper.css' ),
                'deps'    => [],
            ],
            'bootstrap'    => [
                'src'     => RIS_AUCTION_ASSETS . '/css/bootstrap.min.css',
                'version' => '4.1',
                'deps'    => [],
            ],

        ];

    }

    public function get_scripts() {

        return [
            'main'                      => [
                'src'     => RIS_AUCTION_ASSETS . '/js/main.js',
                'version' => filemtime( RIS_AUCTION_PATH . '/assets/js/main.js' ),
                'deps'    => ['jquery'],
            ],
            'add-new-form'              => [
                'src'     => RIS_AUCTION_ASSETS . '/js/add-new-form.js',
                'version' => filemtime( RIS_AUCTION_PATH . '/assets/js/add-new-form.js' ),
                'deps'    => ['jquery', 'file-upload'],
            ],
            'update-new-form'           => [
                'src'     => RIS_AUCTION_ASSETS . '/js/update-new-form.js',
                'version' => filemtime( RIS_AUCTION_PATH . '/assets/js/update-new-form.js' ),
                'deps'    => ['jquery'],
            ],
            'stepper'                   => [
                'src'     => RIS_AUCTION_ASSETS . '/js/stepper.js',
                'version' => filemtime( RIS_AUCTION_PATH . '/assets/js/stepper.js' ),
                'deps'    => ['jquery'],
            ],
            'year-select'               => [
                'src'     => RIS_AUCTION_ASSETS . '/js/year-select.js',
                'version' => filemtime( RIS_AUCTION_PATH . '/assets/js/year-select.js' ),
                'deps'    => ['jquery'],
            ],
            'swal'                      => [
                'src'     => 'https://cdn.jsdelivr.net/npm/sweetalert2@10',
                'version' => '1.8.1',
                'deps'    => ['jquery'],
            ],
            'jquery-datetimepicker-min' => [
                'src'     => RIS_AUCTION_ASSETS . '/css/jquery.datetimepicker.min.js',
                'version' => filemtime( RIS_AUCTION_PATH . '/assets/js/jquery.datetimepicker.min.js' ),
                'deps'    => ['jquery'],
            ],
            'bootstrap'                 => [
                'src'     => 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js',
                'version' => '4.1',
                'deps'    => ['jquery'],
            ],

            'file-upload'               => [
                'src'     => RIS_AUCTION_ASSETS . '/js/file-upload.js',
                'version' => '4.1',
                'deps'    => ['jquery'],
            ],

        ];

    }

}