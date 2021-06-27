<?php
namespace RIS\Auction\Frontend;

use RIS\Auction\Traits\Features;

class Shortcode {
    use Features;

    /**
     * Class constructor.
     */
    public function __construct() {
        add_shortcode( 'RIS_AUCTION_FORM', [$this, 'render_shortcode'] );
    }

    public function render_shortcode( $atts, $content = '' ) {

        $states = array_keys( $this->all_states );

        ob_start();
        include __DIR__ . '/views/add_new_form.php';

        return ob_get_clean();
    }

}