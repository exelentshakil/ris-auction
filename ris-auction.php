<?php
/**
 * Plugin Name:       RIS Auction Manager
 * Plugin URI:        https://realinternetsales.com
 * Description:       RIS internal app to auth / create new auction product.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            RIS
 * Author URI:        https://realinternetsales.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ris-auction
 * Domain Path:       /languages
 */

// Don't call this file directly

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class RIS_Auction {

    /**
     * Plugin version
     *
     * @var string
     */

    public $version = '1.0';

    /**
     * Class constructor.
     */
    public function __construct() {

        session_start();

        require_once __DIR__ . '/vendor/autoload.php';
        require_once __DIR__ . '/includes/TGM/ris-auction-dep.php';

        $this->define_constants();

        register_activation_hook( __FILE__, [$this, 'active'] );
        register_deactivation_hook( __FILE__, [$this, 'deactive'] );
        add_action( 'plugins_loaded', [$this, 'plugins_loaded'] );
    }

    public function plugins_loaded() {

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            new RIS\Auction\Ajax();
        }

        if ( is_admin() ) {
            new RIS\Auction\Admin();
        } else {
            new RIS\Auction\Frontend();
        }

        new RIS\Auction\Assets();

    }

    public function define_constants() {
        define( 'RIS_AUCTION_VERSION', $this->version );
        define( 'RIS_AUCTION_FILE', __FILE__ );
        define( 'RIS_AUCTION_PATH', dirname( RIS_AUCTION_FILE ) );
        define( 'RIS_AUCTION_URL', plugins_url( '', RIS_AUCTION_FILE ) );
        define( 'RIS_AUCTION_ASSETS', RIS_AUCTION_URL . '/assets' );
    }

    public function active() {

        $installer = new RIS\Auction\Installer();
        $installer->run();
    }

    public function deactive() {}

    /**
     * Initialize singleton
     *
     * @return \RIS_Auction
     */
    public static function init() {

        static $instance = false;

        if ( ! $instance ) {
            $instance = new RIS_Auction();
        }

        return $instance;
    }

}

function ris_auction() {
    return RIS_Auction::init();
}

// hook plugin with world
ris_auction();