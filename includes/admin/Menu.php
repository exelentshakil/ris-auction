<?php
namespace RIS\Auction\Admin;

class Menu {

    /**
     * Auction settings
     *
     * @var \AuctionSettings
     */
    private $auctionSettings;

    /**
     * Class constructor.
     */
    public function __construct( AuctionSettings $auctionSettings ) {

        $this->auctionSettings = $auctionSettings;
        add_action( 'admin_menu', [$this, 'admin_menu'] );
    }

    public function admin_menu() {

        $capabilities = 'manage_options';
        $slug         = 'ris_auction';
        $icon         = 'dashicons-admin-multisite';

        $hook = add_menu_page( __( 'RIS Auction', 'ris-auction' ), __( 'RIS Auction', 'ris-auction' ), $capabilities, $slug, [$this->auctionSettings, 'menu_page'], $icon );
        add_action( 'load-' . $hook, [$this, 'menu_script'] );
    }

    public function menu_script() {
        add_action( 'admin_enqueue_scripts', [$this, 'menu_enqueue_scripts'] );
    }

    public function menu_enqueue_scripts() {
        wp_enqueue_style( 'main' );
        wp_enqueue_script( 'add-new-form' );
        wp_enqueue_script( 'stepper' );
        wp_enqueue_style( 'add-new-form' );
        wp_enqueue_style( 'stepper' );
    }

}