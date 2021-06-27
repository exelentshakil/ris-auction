<?php
namespace RIS\Auction;

class Api {
    /**
     * Class constructor.
     */
    public function __construct() {
        add_action( 'rest_api_init', [$this, 'register_api'] );
    }

    public function register_api() {
        $realisity_api = new Api\RealisityApi();
        $realisity_api->register_routes();
    }
}