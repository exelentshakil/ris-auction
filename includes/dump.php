<?php
    include_once __DIR__ . '/shortcode.php';

    $all_states = [
        'Alabama'        => 'AL',
        'Alaska'         => 'AK',
        'Arizona'        => 'AZ',
        'Arkansas'       => 'AR',
        'California'     => 'CA',
        'Colorado'       => 'CO',
        'Connecticut'    => 'CT',
        'Delaware'       => 'DE',
        'Florida'        => 'FL',
        'Georgia'        => 'GA',
        'Hawaii'         => 'HI',
        'Idaho'          => 'ID',
        'Illinois'       => 'IL',
        'Indiana'        => 'IN',
        'Iowa'           => 'IA',
        'Kansas'         => 'KS',
        'Kentucky'       => 'KY',
        'Louisiana'      => 'LA',
        'Maine'          => 'ME',
        'Maryland'       => 'MD',
        'Massachusetts'  => 'MA',
        'Michigan'       => 'MI',
        'Minnesota'      => 'MN',
        'Mississippi'    => 'MS',
        'Missouri'       => 'MO',
        'Montana'        => 'MT',
        'Nebraska'       => 'NE',
        'Nevada'         => 'NV',
        'New Hampshire'  => 'NH',
        'New Jersey'     => 'NJ',
        'New Mexico'     => 'NM',
        'New York'       => 'NY',
        'North Carolina' => 'NC',
        'North Dakota'   => 'ND',
        'Ohio'           => 'OH',
        'Oklahoma'       => 'OK',
        'Oregon'         => 'OR',
        'Pennsylvania'   => 'PA',
        'Rhode Island'   => 'RI',
        'South Carolina' => 'SC',
        'South Dakota'   => 'SD',
        'Tennessee'      => 'TN',
        'Texas'          => 'TX',
        'Utah'           => 'UT',
        'Vermont'        => 'VT',
        'Virginia'       => 'VA',
        'Washington'     => 'WA',
        'West Virginia'  => 'WV',
        'Wisconsin'      => 'WI',
        'Wyoming'        => 'WY',

    ];

    add_action( 'template_redirect', 'logout_confirmation' );

    function dokan_get_analytics_tabs_filter( $tabs ) {

        return $tabs;
    }

    add_action( 'dokan_report_content_inside_after', 'dokan_report_content_inside_after' );
    function logout_confirmation() {

        global $wp;

        if ( isset( $wp->query_vars['customer-logout'] ) ) {

            wp_redirect( str_replace( '&amp;', '&', wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) );

            exit;

        }

    }

    function ibid_child_scripts() {

        wp_enqueue_style( 'ibid-parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/slick-theme.css' );
        wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/slick.min.js', 'jquery', '1.8.1', true );
        wp_enqueue_style( 'auction-template', get_stylesheet_directory_uri() . '/auction-template.css' );
        wp_enqueue_script( 'notify', get_stylesheet_directory_uri() . '/custom.js', 'jquery', '1.8.1', true );
        wp_enqueue_style( 'search-table', get_stylesheet_directory_uri() . '/search-table.css' );
        wp_enqueue_script( 'search-table', get_stylesheet_directory_uri() . '/search-table.js', 'jquery', '1.8.1', true );
        wp_enqueue_script( 'jquery.sticky', get_stylesheet_directory_uri() . '/js/jquery.sticky.js', 'jquery', '1.8.1', true );
        wp_enqueue_script( 'bid-custom', get_stylesheet_directory_uri() . '/js/bid-custom.js', 'jquery', '1.8.1', true );
        wp_enqueue_script( 'swal', 'https://cdn.jsdelivr.net/npm/sweetalert2@10', 'jquery', '1.8.1', true );
        wp_enqueue_script( 'wp-util' );

    //wp_enqueue_style( 'ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' );

        //wp_enqueue_script( 'ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js', 'jquery', '1.8.1', true );
        wp_enqueue_script( 'jquery-ui-mouse' );
        wp_enqueue_script( 'jquery-ui-accordion' );
        wp_enqueue_script( 'jquery-ui-autocomplete' );
        wp_enqueue_script( 'jquery-ui-slider' );

        wp_enqueue_style( 'ion-rangeSlider', get_stylesheet_directory_uri() . '/ion.rangeSlider.min.css' );
        wp_enqueue_script( 'ion-rangeSlider', get_stylesheet_directory_uri() . '/ion.rangeSlider.min.js', 'jquery', '1.8.1', true );
        wp_enqueue_script( 'year-select-js', get_stylesheet_directory_uri() . '/js/year-select.js', 'jquery', '1.8.1', true );

        wp_localize_script( 'notify', 'RIS_Notify', [
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'dokan_auction_product_notification_nonce' ),
        ] );

    }

    add_action( 'wp_enqueue_scripts', 'ibid_child_scripts' );

    function remove_core_updates() {
        global $wp_version;return (object) array( 'last_checked' => time(), 'version_checked' => $wp_version );
    }

    add_filter( 'pre_site_transient_update_core', 'remove_core_updates' );
    add_filter( 'pre_site_transient_update_plugins', 'remove_core_updates' );
    add_filter( 'pre_site_transient_update_themes', 'remove_core_updates' );

    // Your php code goes here

    add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_more_seller_product_tab', 100 );

    function wcs_woo_remove_more_seller_product_tab( $tabs ) {

    //echo '<pre>';

    //var_dump($tabs);

    //$tabs['more_seller_product']['title'] = 'More from Seller';
        //$tabs['shipping']['title']            = 'ESCROW ';
        unset( $tabs['more_seller_product'] );
        unset( $tabs['shipping'] );
        unset( $tabs['reviews'] );
        unset( $tabs['seller'] );

    //unset( $tabs['reviews'] );
        //var_dump($tabs["more_seller_product"]);
        return $tabs;
    }

    add_filter( 'gettext', 'change_post_to_article', 99 );
    add_filter( 'ngettext', 'change_post_to_article', 99 );

    function change_post_to_article( $translated ) {
        $translated = str_replace( 'Dokan', 'CGL', $translated );
        $translated = str_replace( 'Vendors', 'Sellers', $translated );
        $translated = str_replace( 'vendors', 'sellers', $translated );
        $translated = str_replace( 'Processing', 'Active', $translated );
        $translated = str_replace( 'Buy now for', 'IMMEDIATE OFFER', $translated );
        $translated = str_replace( 'Cash on delivery', 'Escrow Funding', $translated );
        $translated = str_replace( 'Pay with cash upon delivery', 'Pay with Escrow Funding', $translated );
        $translated = str_replace( 'Place order', 'Fund Purchase', $translated );
        $translated = str_replace( 'Billing details', 'Buyer details', $translated );
        $translated = str_replace( 'Products', 'Homes', $translated );
        $translated = str_replace( 'Product', 'Home', $translated );
        $translated = str_replace( 'product', 'home', $translated );
        $translated = str_replace( 'Affiliate', 'Referral', $translated );
        $translated = str_replace( 'affiliate', 'referral', $translated );

        return $translated;
    }

    // Change woocommerce menu label
    function change_post_menu_label() {
        global $menu;
        global $submenu;

        $menu[27][0] = 'Homes';

    //$submenu['edit.php'][5][0] = 'Contacts';

    ////$submenu['edit.php'][10][0] = 'Add Contacts';

    //$submenu['edit.php'][15][0] = 'Status'; // Change name for categories
        //$submenu['edit.php'][16][0] = 'Labels'; // Change name for tags
        echo '';
    }

    function change_post_object_label() {
        global $wp_post_types;
        $labels       = &$wp_post_types['product']->labels;
        $labels->name = 'Homes';

    //$labels->singular_name = 'Contact';

    //$labels->add_new = 'Add Contact';

    //$labels->add_new_item = 'Add Contact';

    //$labels->edit_item = 'Edit Contacts';

    //$labels->new_item = 'Contact';

    //$labels->view_item = 'View Contact';

    //$labels->search_items = 'Search Contacts';

    //$labels->not_found = 'No Contacts found';
        //$labels->not_found_in_trash = 'No Contacts found in Trash';
    }

    add_action( 'init', 'change_post_object_label' );
    add_action( 'admin_menu', 'change_post_menu_label' );

    function dokan_remove_coupon_menu( $menus ) {

        unset( $menus['coupons'] );
        unset( $menus['withdraw'] );
        unset( $menus['reviews'] );
        unset( $menus['products'] );
        $dollar = '<i class="fas fa-dollar-sign"></i>';

        $menus['orders'] = [
            'title' => 'Transactions',
            'icon'  => $dollar,
            'url'   => '/dashboard/orders/',
            'pos'   => 34,

        ];

        $menus['auction'] = [
            'title' => 'Auction',
            'icon'  => '<i class="fa fa-gavel"></i>',
            'url'   => '/dashboard/auction/',
            'pos'   => 31,
        ];

    //echo '<pre>';

    //var_dump($menus);

        if ( is_vendor_subscribed_pack( 6793 ) ) {
            unset( $menus['products'] );
        }

    //echo '<pre>';
        //var_dump($menus);
        return $menus;
    }

    add_filter( 'dokan_get_dashboard_nav', 'dokan_remove_coupon_menu', 99 );

    function misha_custom_related_products_text( $translated_text, $text, $domain ) {

        if ( $translated_text == 'Related products' || $translated_text == 'You may also like&hellip;' || $translated_text == 'You may be interested in&hellip;' ) {
            $translated_text = 'Related Listing'; //
        }

        return $translated_text;

    }

    add_filter( 'gettext', 'misha_custom_related_products_text', 20, 3 );
    add_action( 'admin_head', 'my_custom_fonts' );

    function my_custom_fonts() {

        if ( is_vendor_subscribed_pack( 6793 ) ) {
        ?>
<style>
.dokan-orders-content #order-filter .dokan-form-control {
    min-height: 42px !important;
    border-radius: 30px !important;
    margin-bottom: 20px;
    width: 98% !important;
    display: none !important;
}

.dokan-order-filter-serach {
    display: none !important;
}

input#bulk-order-action {
    display: none !important;
}
</style>

<?php
    }

        echo '<style>

    .dokan-admin-header {
        background: #fff;
        padding: 15px 15px 15px 22px;
        margin: 0 0 0 -20px;
        box-shadow: 0 0 5px 0 rgb(0 0 0 / 10%);
        display: flex;
        align-items: center;
        display: none !important;
    }
    .left-side .postbox:last-child {
        display: none !important;
    }


    </style>';
    }

    function my_logged_in_redirect() {

        if ( ! is_user_logged_in() && is_page( 4861 ) ) {
            wp_redirect( get_permalink( 16 ) );
            die;
        }

    }

    add_action( 'template_redirect', 'my_logged_in_redirect' );

    /*
     * Adding product data on product field
     */

    add_action( 'dokan_new_listing_form', 'new_product_field', 10 );

    function new_product_field() {
        global $all_states;

        // Interior
        $interior_features      = ['2 Staircases', 'In-Law Floorplan', 'Attic Fan', 'Balcony', 'Bar', 'Beamed Ceilings', 'Block Walls', 'Brick Walls', 'Built-in Features', 'Cathedral Ceiling(s)', 'Ceiling Fan(s)', 'Ceramic Counters', 'Chair Railings', 'Coffered Ceiling(s)', 'Copper Plumbing Full', 'Copper Plumbing Partial', 'Corian Counters', 'Crown Molding', 'Dry Bar', 'Dumbwaiter', 'Electronic Air Cleaner', 'Elevator', 'Formica Counters', 'Furnished', 'Granite Counters', 'High Ceilings', 'Home Automation System', 'Intercom', 'Laminate Counters', 'Living Room Balcony', 'Living Room Deck Attached', 'Open Floorplan', 'Pantry', 'Partially Furnished', 'Phone System', 'Pull Down Stairs to Attic', 'Recessed Lighting', 'Stair Climber', 'Stone Counters', 'Storage', 'Sump Pump', 'Sunken Living Room', 'Suspended Ceiling(s)', 'Tandem', 'Tile Counters', 'Track Lighting', 'Trash Chute', 'Tray Ceiling(s)', 'Two Story Ceilings', 'Unfinished Walls', 'Unfurnished', 'Vacuum Central', 'Wainscoting', 'Wet Bar', 'Wired for Data', 'Wired for Sound', 'Wood Product Walls'];
        $basements              = ['Finished', 'Unfinished', 'Utility'];
        $fireplaces             = ['Bath', 'Bonus Room', 'Den', 'Dining Room', 'Family Room', 'Game Room', 'Guest House', 'Kitchen', 'Library', 'Living Room', 'Circulating', 'Master Bedroom', 'Master Retreat', 'Outside', 'Patio', 'Electric', 'Gas', 'Gas Starter', 'Pellet Stove', 'Propane', 'Wood Burning', 'Wood Stove Insert', 'Blower Fan', 'Circular', 'Decorative', 'Fire Pit', 'Free Standing', 'Great Room', 'Heatilator', 'Masonry', 'Raised Hearth', 'Zero Clearance', 'See Through', 'Two Way', 'See Remarks'];
        $coolings               = ['Central Air', 'Dual', 'Zoned', 'Wall/Window Unit(s)', 'Evaporative Cooling', 'Heat Pump', 'Humidity Control', 'Whole House Fan', 'Electric', 'Gas', 'ENERGY STAR Qualified Equipment', 'High Efficiency', 'SEER Rated 13-15', 'SEER Rated 16+', 'See Remarks'];
        $heatings               = ['Central', 'Zoned', 'Baseboard', 'Floor Furnace', 'Wall Furnace', 'Space Heater', 'Forced Air', 'Gravity', 'Heat Pump', 'Radiant', 'Electric', 'Natural Gas', 'Propane', 'Kerosene', 'Pellet Stove', 'Wood', 'Oil', 'Solar', 'ENERGY STAR Qualified Equipment', 'High Efficiency', 'Combination', 'Fireplace(s)', 'Humidity Control', 'Wood Stove', 'See Remarks'];
        $accessibility_features = ['2+ Access Exits', '32 Inch Or More Wide Doors', '36 Inch Or More Wide Halls', '48 Inch Or More Wide Halls', 'Accessible Elevator Installed', 'Adaptable For Elevator', 'Customized Wheelchair Accessible', 'Disability Features', 'Doors - Swing In', 'Entry Slope Less Than 1 Foot', 'Grab Bars In Bathroom(s)', 'Low Pile Carpeting', 'Lowered Light Switches', 'No Interior Steps', 'Other', 'Parking', 'Ramp - Main Level', 'See Remarks'];
        $kitchen_features       = ['Built-in Trash/Recycling', 'Butler’s Pantry', 'Corian Counters', 'Formica Counters', 'Granite Counters', 'Kitchen Island', 'Kitchen Open to Family Room', 'Kitchenette', 'Laminate Counters', 'Pots & Pan Drawers', 'Quartz Counters', 'Remodeled Kitchen', 'Self-closing cabinet doors', 'Self-closing drawers', 'Stone Counters', 'Tile Counters', 'Utility sink', 'Walk-In Pantry'];
        $floorings              = ['Bamboo', 'Brick', 'Carpet', 'Concrete', 'Laminate', 'See Remarks', 'Stone', 'Tile', 'Vinyl', 'Wood'];
        $appliances             = ['6 Burner Stove', 'Barbecue', 'Built-In Range', 'Coal Water Heater', 'Convection Oven', 'Dishwasher', 'Double Oven', 'Electric Oven', 'Electric Range', 'Electric Cooktop', 'Electric Water Heater', 'ENERGY STAR Qualified Appliances', 'ENERGY STAR Qualified Water Heater', 'Free-Standing Range', 'Freezer', 'Disposal', 'Gas & Electric Range', 'Gas Oven', 'Gas Range', 'Gas Cooktop', 'Gas Water Heater', 'Indoor Grill', 'High Efficiency Water Heater', 'Hot Water Circulator', 'Ice Maker', 'Instant Hot Water', 'Microwave', 'No Hot Water', 'Portable Dishwasher', 'Propane Oven', 'Propane Range', 'Propane Cooktop', 'Propane Water Heater', 'Range Hood', 'Recirculated Exhaust Fan', 'Refrigerator', 'Self Cleaning Oven', 'Solar Hot Water', 'Tankless Water Heater', 'Trash Compactor', 'Vented Exhaust Fan', 'Warming Drawer', 'Water Heater Central', 'Water Heater', 'Water Line to Refrigerator', 'Water Purifier', 'Water Softener'];
        $bathroom_features      = ['Bathtub', 'Bidet', 'Low Flow Shower', 'Low Flow Toilet(s)', 'Shower', 'Shower in Tub', 'Closet in bathroom', 'Corian Counters', 'Double sinks in bath(s)', 'Double Sinks In Master Bath', 'Dual shower heads (or Multiple)', 'Exhaust fan(s)', 'Formica Counters', 'Granite Counters', 'Heated Floor', 'Hollywood Bathroom (Jack&Jill)', 'Humidity controlled', 'Jetted Tub', 'Laminate Counters', 'Linen Closet/Storage', 'Privacy toilet door', 'Quartz Counters', 'Remodeled', 'Separate tub and shower', 'Soaking Tub', 'Stone Counters', 'Tile Counters', 'Upgraded', 'Vanity area', 'Walk-in shower'];
        $eating_areas           = ['Area', 'Breakfast Counter / Bar', 'Breakfast Nook', 'Dining Ell', 'Family Kitchen', 'In Family Room', 'Dining Room', 'In Kitchen', 'In Living Room', 'Separated', 'Country Kitchen', 'See Remarks'];
        $electrics              = ['220 Volts For Spa', '220 Volts in Garage', '220 Volts in Kitchen', '220 Volts in Laundry', '220 Volts in Workshop', '220V Other - See Remarks', '220 Volts', '440 Volts', 'Electricity - On Bond', 'Electricity - On Property', 'Electricity - Unknown', 'Heavy', 'Photovoltaics on Grid', 'Photovoltaics Seller Owned', 'Photovoltaics Stand-Alone', 'Photovoltaics Third-Party Owned', 'Standard'];
        $laundries              = ['Common Area', 'Community', 'Dryer Included', 'Electric Dryer Hookup', 'Gas & Electric Dryer Hookup', 'Gas Dryer Hookup', 'In Carport', 'In Closet', 'In Garage', 'In Kitchen', 'Individual Room', 'Inside', 'Laundry Chute', 'Upper Level', 'Outside', 'Propane Dryer Hookup', 'See Remarks', 'Stackable', 'Washer Hookup', 'Washer Included'];
        $room_types             = ['All Bedrooms Down', 'All Bedrooms Up', 'Art Studio', 'Atrium', 'Attic', 'Basement', 'Bonus Room', 'Center Hall', 'Converted Bedroom', 'Dance Studio', 'Den', 'Dressing Area', 'Entry', 'Exercise Room', 'Family Room', 'Formal Entry', 'Foyer', 'Galley Kitchen', 'Game Room', 'Great Room', "Guest/Maid's Quarters", 'Home Theatre', 'Jack & Jill', 'Kitchen', 'Laundry', 'Library', 'Living Room', 'Loft', 'Main Floor Bedroom', 'Main Floor Master Bedroom', 'Master Bathroom', 'Master Bedroom', 'Master Suite', 'Media Room', 'Multi-Level Bedroom', 'Office', 'Projection', 'Recreation', 'Retreat', 'Sauna', 'See Remarks', 'Separate Family Room', 'Sound Studio', 'Sun', 'Two Masters', 'Utility Room', 'Walk-In Closet', 'Walk-In Pantry', 'Wine Cellar', 'Workshop'];
        $utilities              = ['Cable Available', 'Cable Connected', 'Cable Not Available', 'Electricity Available', 'Electricity Connected', 'Electricity Not Available', 'Natural Gas Available', 'Natural Gas Connected', 'Natural Gas Not Available', 'Other', 'Phone Available', 'Phone Connected', 'Phone Not Available', 'Propane', 'See Remarks', 'Sewer Available', 'Sewer Connected', 'Sewer Not Available', 'Underground Utilities', 'Water Available', 'Water Connected', 'Water Not Available'];

        // Exterior

        $pool_features            = ['None', 'Private', 'Association', 'Community', 'Above Ground', 'Black Bottom', 'Diving Board', 'Exercise Pool', 'Fenced', 'Fiberglass', 'Filtered', 'Gunite', 'Heated', 'Heated Passively', 'Electric Heat', 'Gas Heat', 'Heated with Propane', 'In Ground', 'Indoor', 'Lap', 'Infinity', 'No Permits', 'Pebble', 'Permits', 'Pool Cover', 'Roof Top', 'Salt Water', 'See Remarks', 'Solar Heat', 'Tile', 'Vinyl', 'Waterfall'];
        $views                    = ['None', 'Back Bay', 'Dunes', 'Bay', 'Bluff', 'Bridge(s)', 'Canal', 'Canyon', 'Catalina', 'City Lights', 'Coastline', 'Courtyard', 'Creek/Stream', 'Desert', 'Golf Course', 'Harbor', 'Hills', 'Lake', 'Landmark', 'Marina', 'Meadow', 'Mountain(s)', 'Neighborhood', 'Ocean', 'Orchard', 'Panoramic', 'Park/Greenbelt', 'Pasture', 'Peek-A-Boo', 'Pier', 'Pond', 'Pool', 'Reservoir', 'River', 'Rocks', 'See Remarks', 'Trees/Woods', 'Valley', 'Vincent Thomas Bridge', 'Vineyard', 'Water', 'White Water'];
        $door_features            = ['Atrium Doors', 'Double Door Entry', 'ENERGY STAR Qualified Doors', 'French Doors', 'Insulated Doors', 'Mirror Closet Door(s)', 'Panel Doors', 'Service Entrance', 'Sliding Doors', 'Storm Door(s)'];
        $fencings                 = ['None', 'Average Condition', 'Barbed Wire', 'Block', 'Brick', 'Chain Link', 'Cross Fenced', 'Electric', 'Excellent Condition', 'Fair Condition', 'Glass', 'Goat Type', 'Good Condition', 'Grapestake', 'Invisible', 'Livestock', 'Masonry', 'Needs Repair', 'New Condition', 'Partial', 'Pipe', 'Poor Condition', 'Privacy', 'Redwood', 'Security', 'See Remarks', 'Split Rail', 'Stone', 'Stucco Wall', 'Vinyl', 'Wire', 'Wood', 'Wrought Iron'];
        $security_features        = ['24 Hour Security', 'Gated with Attendant', 'Automatic Gate', 'Carbon Monoxide Detector(s)', 'Card/Code Access', 'Closed Circuit Camera(s)', 'Fire and Smoke Detection System', 'Fire Rated Drywall', 'Fire Sprinkler System', 'Firewall(s)', 'Gated Community', 'Gated with Guard', 'Guarded', 'Resident Manager', 'Security Lights', 'Security System', 'Smoke Detector(s)', 'Window Bars', 'Wired for Alarm System'];
        $parkings                 = ['None', 'Assigned', 'Auto Driveway Gate', 'Boat', 'Built-In Storage', 'Carport', 'Attached Carport', 'Detached Carport', 'Circular Driveway', 'Community Structure', 'Controlled Entrance', 'Converted Garage', 'Covered', 'Deck', 'Direct Garage Access', 'Driveway', 'Asphalt', 'Driveway - Brick', 'Driveway - Combination', 'Concrete', 'Gravel', 'Paved', 'Unpaved', 'Driveway Blind', 'Driveway Down Slope From Street', 'Driveway Level', 'Driveway Up Slope From Street', 'Garage', 'Garage Faces Front', 'Garage Faces Rear', 'Garage Faces Side', 'Garage - Single Door', 'Garage - Three Door', 'Garage - Two Door', 'Garage Door Opener', 'Gated', 'Golf Cart Garage', 'Guarded', 'Guest', 'Heated Garage', 'Metered', 'No Driveway', 'Off Site', 'Off Street', 'On Site', 'Other', 'Oversized', 'Parking Space', 'Permit Required', 'Porte-Cochere', 'Private', 'Public', 'Pull-through', 'RV Access/Parking', 'RV Covered', 'RV Garage', 'RV Gated', 'RV Hook-Ups', 'RV Potential', 'See Remarks', 'Shared Driveway', 'Side by Side', 'Street', 'Structure', 'Subterranean', 'Tandem Covered', 'Tandem Garage', 'Tandem Uncovered', 'Unassigned', 'Uncovered', 'Valet', 'Workshop in Garage', 'Electric Vehicle Charging Station(s)'];
        $spa_features             = ['None', 'Private', 'Association', 'Community', 'Above Ground', 'Bath', 'Fiberglass', 'Gunite', 'Heated', 'In Ground', 'No Permits', 'Permits', 'Roof Top', 'See Remarks', 'Solar Heated', 'Vinyl'];
        $common_walls             = ['1 Common Wall', '2+ Common Walls', 'End Unit', 'No Common Walls', 'No One Above', 'No One Below'];
        $construction_materials   = ['Adobe', 'Alcan', 'Aluminum Siding', 'Asbestos', 'Asphalt', 'Block', 'Blown-In Insulation', 'Board & Batten Siding', 'Brick', 'Brick Veneer', 'Cedar', 'Cellulose Insulation', 'Cement Siding', 'Clapboard', 'Concrete', 'Drywall Walls', 'Ducts Professionally Air-Sealed', 'Fiber Cement', 'Fiberglass Siding', 'Flagstone', 'Frame', 'Glass', 'Hardboard', 'HardiPlank Type', 'ICFs (Insulated Concrete Forms)', 'Lap Siding', 'Log', 'Log Siding', 'Masonite', 'Metal Siding', 'Natural Building', 'NES Insulation Pkg', 'Other', 'Plaster', 'Radiant Barrier', 'Rammed Earth', 'Redwood Siding', 'Shake Siding', 'Shingle Siding', 'Slump Block', 'Spray Foam Insulation', 'Steel', 'Steel Siding', 'Stone', 'Stone Veneer', 'Straw', 'Stucco', 'Synthetic Stucco', 'TVA Insulation Pkg', 'Unknown', 'Vertical Siding', 'Vinyl Siding', 'Wood Siding'];
        $roofs                    = ['None', 'Asbestos Shingle', 'Asphalt', 'Bahama', 'Barrel', 'Bitumen', 'Bituthene', 'Clay', 'Common Roof', 'Composition', 'Concrete', 'Copper', 'Elastomeric', 'Fiberglass', 'Fire Retardant', 'Flat', 'Flat Tile', 'Foam', 'Green Roof', 'Mansard', 'Membrane', 'Metal', 'Mixed', 'Other', 'Reflective', 'Ridge Vents', 'Rolled/Hot Mop', 'See Remarks', 'Shake', 'Shingle', 'Slate', 'Spanish Tile', 'Stone', 'Synthetic', 'Tar/Gravel', 'Tile', 'Wood'];
        $foundation_details       = ['None', 'Block', 'Brick/Mortar', 'Combination', 'Concrete Perimeter', 'Permanent', 'Pier Jacks', 'Pillar/Post/Pier', 'Quake Bracing', 'Raised', 'See Remarks', 'Seismic Tie Down', 'Slab', 'Stacked Block', 'Stone', 'Tie Down'];
        $waterfront_features      = ['Across the Road from Lake/Ocean', 'Bay Front', 'Beach Access', 'Beach Front', 'Canal Front', 'Creek', 'Fishing in Community', 'Includes Dock', 'Lagoon', 'Lake', 'Lake Front', 'Lake Privileges', 'Marina in Community', 'Navigable Water', 'Ocean Access', 'Ocean Front', 'Ocean Side of Freeway', 'Ocean Side Of Highway 1', 'Pond', 'Reservoir in Community', 'River Front', 'Sea Front', 'Seawall', 'Stream', 'Waterfront With Home Across Road'];
        $patio_and_porch_features = ['None', 'Arizona Room', 'Brick', 'Cabana', 'Concrete', 'Covered', 'Deck', 'Enclosed', 'Enclosed Glass Porch', 'Lanai', 'Patio', 'Patio Open', 'Porch', 'Front Porch', 'Rear Porch', 'Roof Top', 'Screened', 'Screened Porch', 'See Remarks', 'Slab', 'Stone', 'Terrace', 'Tile', 'Wood', 'Wrap Around'];
        $lot_features             = ['0-1 Unit/Acre', '2-5 Units/Acre', '6-10 Units/Acre', '11-15 Units/Acre', '16-20 Units/Acre', '21-25 Units/Acre', '26-30 Units/Acre', '31-35 Units/Acre', '36-40 Units/Acre', 'Agricultural', 'Agricultural - Dairy', 'Agricultural - Other', 'Agricultural - Row/Crop', 'Agricultural - Tree/Orchard', 'Agricultural - Vine/Vineyard', 'Back Yard', 'Bluff', 'Close to Clubhouse', 'Corner Lot', 'Corners Marked', 'Cul-De-Sac', 'Desert Back', 'Desert Front', 'Sloped Down', 'Front Yard', 'Garden', 'Gentle Sloping', 'Greenbelt', 'Horse Property', 'Horse Property Improved', 'Horse Property Unimproved', 'Landscaped', 'Lawn', 'Level with Street', 'Lot 10000-19999 Sqft', 'Lot 20000-39999 Sqft', 'Lot 6500-9999', 'Lot Over 40000 Sqft', 'Flag Lot', 'Irregular Lot', 'Rectangular Lot', 'Level', 'Misting System', 'Near Public Transit', 'No Landscaping', 'On Golf Course', 'Over 40 Units/Acre', 'Park Nearby', 'Pasture', 'Patio Home', 'Paved', 'Percolate', 'Ranch', 'Rocks', 'Rolling Slope', 'Secluded', 'Sprinkler System', 'Sprinklers Drip System', 'Sprinklers In Front', 'Sprinklers In Rear', 'Sprinklers Manual', 'Sprinklers None', 'Sprinklers On Side', 'Sprinklers Timer', 'Steep Slope', 'Tear Down', 'Treed Lot', 'Up Slope from Street', 'Utilities - Overhead', 'Value In Land', 'Walkstreet', 'Yard', 'Zero Lot Line'];
        $property_conditions      = ['Additions/Alterations', 'Building Permit', 'Fixer', 'Repairs Cosmetic', 'Repairs Major', 'Termite Clearance', 'Turnkey', 'Under Construction', 'Updated/Remodeled'];
        $sewers                   = ['None', 'Aerobic Septic', 'Cesspool', 'Conventional Septic', 'Engineered Septic', 'Holding Tank', 'Mound Septic', 'Other', 'Perc Test On File', 'Perc Test Required', 'Private Sewer', 'Public Sewer', 'Septic Type Unknown', 'Sewer Applied for Permit', 'Sewer Assessments', 'Sewer On Bond', 'Sewer Paid', 'Shared Septic', 'Soils Analysis Septic', 'Unknown'];
        $water_sources            = ['None', 'Agricultural Well', 'Cistern', 'Other', 'Private', 'Public', 'See Remarks', 'Shared Well', 'Well'];
        $architectural_styles     = ['Bungalow', 'Cape Cod', 'Colonial', 'Contemporary', 'Cottage', 'Craftsman', 'Custom Built', 'English', 'French', 'Georgian', 'Log', 'Mediterranean', 'Mid Century Modern', 'Modern', 'Ranch', 'See Remarks', 'Shotgun', 'Spanish', 'Traditional', 'Tudor', 'Victorian'];
        $community_features       = ['Biking', 'BLM/National Forest', 'Curbs', 'Dog Park', 'Fishing', 'Foothills', 'Golf', 'Hiking', 'Gutters', 'Lake', 'Horse Trails', 'Park', 'Hunting', 'Watersports', 'Military Land', 'Mountainous', 'Preserve/Public Land', 'Ravine', 'Stable(s)', 'Rural', 'Sidewalks', 'Storm Drains', 'Street Lights', 'Suburban', 'Urban', 'Valley'];
        $road_frontage_types      = ['Access is Seasonal', 'Alley', 'City Street', 'Country Road', 'County Road', 'Highway', 'Private Road'];
        $road_surface_types       = ['Alley Paved', 'Gravel', 'Maintained', 'Not Maintained', 'Paved', 'Unpaved'];
        $disclosures              = ['Accessory Dwelling Unit', '3rd Party Rights', 'Bankruptcy', 'Beach Rights', 'Cautions Call Agent', "CC And R's", 'City Inspection Required', 'Coastal Commission Restrictions', 'Coastal Zone', 'Conditional Use Permit', 'Court Confirmation', 'Death On Property < 3 yrs', 'Earthquake Insurance Available', 'Easements', 'Environmental Restrictions', 'Exclusions Call Agent', 'Flood Insurance Required', 'Flood Zone', 'HERO/PACE Loan', 'Historical', 'Home Warranty', 'Homeowners Association', 'Incorporated', 'LA/Owner Related', 'Licensed Vacation Rental', 'Listing Broker Advantage', 'Manufactured Homes Allowed', 'Methane Gas', 'Mineral Rights', 'Moratorium', 'No Lake Rights', 'Oil Rights', 'Open Space Restrictions', 'Pet Restrictions', 'Principal Is RE Licensed', 'Private Transfer Taxes', 'Property Report', 'REAP', 'Redevelopment Area', 'Rent Control', 'Section 8 Approved', 'Seismic Hazard', 'Seller Will Pay Sec. 1 Termite', 'Slide Zone', 'Special Study Area', 'Subject To Estate Ruling', 'Tenants In Common - DRE Pink', 'Tenants In Common - DRE White', 'Unincorporated', 'Water Rights', 'Well Log Available'];
        $exterior_features        = ['Awning(s)', 'Barbecue Private', 'Boat Lift', 'Boat Slip', 'Corral', 'Dock Private', 'Kennel', 'Koi Pond', 'Lighting', 'Pier', 'Rain Gutters', 'Satellite Dish', 'Stable', 'TV Antenna'];
        $other_structures         = ['Airplane Hangar', 'Aviary', 'Barn(s)', 'Gazebo', 'Greenhouse', 'Guest House', 'Guest House Attached', 'Guest House Detached', 'Outbuilding', 'Sauna Private', 'Second Garage', 'Second Garage Attached', 'Second Garage Detached', 'Shed(s)', 'Sport Court Private', 'Storage', 'Tennis Court Private', 'Two On A Lot', 'Workshop'];
        $window_features          = ['Atrium', 'Bay Window(s)', 'Blinds', 'Casement Windows', 'Custom Covering', 'Double Pane Windows', 'Drapes', 'ENERGY STAR Qualified Windows', 'French/Mullioned', 'Garden Window(s)', 'Insulated Windows', 'Jalousies/Louvered', 'Low Emissivity Windows', 'Palladian', 'Plantation Shutters', 'Roller Shields', 'Screens', 'Shutters', 'Skylight(s)', 'Solar Screens', 'Solar Tinted Windows', 'Stained Glass', 'Storm Window(s)', 'Tinted Windows', 'Triple Pane Windows', 'Wood Frames'];

        $states = array_keys( $all_states );

    ?>


<div class="container">
    <!-- Grid row -->
    <div class="row pt-5 d-flex justify-content-center step-card">

        <!-- Grid column -->
        <div class="col-md-3 pl-5 pl-md-0 pb-5 step-nav">
            <!-- Stepper -->
            <div class="steps-form-3">
                <div class="steps-row-3 setup-panel-3 d-flex justify-content-between">
                    <div class="steps-step-3">
                        <a href="#step-1" type="button" class="btn btn-info btn-circle-3 waves-effect ml-0"
                            data-toggle="tooltip" data-placement="top" title="Location"><i class="fa fa-street-view"
                                aria-hidden="true"></i>Location</a>
                    </div>
                    <div class="steps-step-3">
                        <a href="#step-2" type="button" class="btn btn-pink btn-circle-3 waves-effect p-3"
                            data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-home"
                                aria-hidden="true"></i>Details</a>

                    </div>
                    <div class="steps-step-3">
                        <a href="#step-3" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                            data-toggle="tooltip" data-placement="top" title="Contact"><i class="fa fa-id-card"
                                aria-hidden="true"></i>Contact</a>
                    </div>
                    <div class="steps-step-3">
                        <a href="#step-4" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                            data-toggle="tooltip" data-placement="top" title="Utilities & Features"><i class="fa fa-th"
                                aria-hidden="true"></i>Utilities & Features</a>
                    </div>
                    <div class="steps-step-3">
                        <a href="#step-5" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                            data-toggle="tooltip" data-placement="top" title="Photos"><i class="fa fa-picture-o"
                                aria-hidden="true"></i>Photos</a>
                    </div>
                    <div class="steps-step-3">
                        <a href="#step-6" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                            data-toggle="tooltip" data-placement="top" title="Video"><i class="fa fa-file-video-o"
                                aria-hidden="true"></i>Video</a>
                    </div>
                    <div class="steps-step-3">
                        <a href="#step-7" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                            data-toggle="tooltip" data-placement="top" title="Description"><i class="fa fa-map-signs"
                                aria-hidden="true"></i>Description</a>
                    </div>
                    <div class="steps-step-3">
                        <a href="#step-8" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                            data-toggle="tooltip" data-placement="top" title="Asking Price"><i
                                class="fas fa-file-invoice-dollar" aria-hidden="true"></i>Asking Price</a>
                    </div>
                    <div class="steps-step-3 no-height">
                        <a href="#step-9" type="button" class="btn btn-pink btn-circle-3 waves-effect p-3"
                            data-toggle="tooltip" data-placement="top" title="Post Your Listing"><i class="fa fa-laptop"
                                aria-hidden="true"></i>Post Your Listing</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-7">

            <!-- First Step -->
            <div class="row setup-content-3" id="step-1">
                <div class="col-md-12">
                    <h3 class="font-weight-bold pl-0 my-4"><strong>What's the Address of the Home for Sale?</strong>
                    </h3>
                    <div class="form-group md-form">
                        <label for="address_1" data-error="wrong" data-success="right">Address Line 1
                        </label>
                        <input id="address_1" type="text" name="address[address_1]" placeholder="Address Line 1"
                            class="form-control">
                    </div>
                    <div class="form-group md-form">
                        <label for="address_2" data-error="wrong" data-success="right">Address Line 2
                        </label>
                        <input id="address_2" type="text" name="address[address_2]"
                            placeholder="Apartment, Unit Number, Etc" class="form-control">
                    </div>
                    <div class="form-group md-form mt-3">
                        <label for="city" data-error="wrong" data-success="right">City</label>
                        <input id="city" type="text" name="address[city]" placeholder="City" class="form-control">

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group md-form mt-3">
                                <label for="state" data-error="wrong" data-success="right">State</label>
                                <select id="state" name="address[state]" class="form-control">

                                    <?php

                                        foreach ( $states as $key => $state ) {?>

                                    <option value="<?php echo $state; ?>"><?php echo $state; ?></option>

                                    <?php }

                                        ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group md-form mt-3">
                                <label for="zip_code" data-error="wrong" data-success="right">Zip Code</label>
                                <input id="zip_code" type="text" name="address[zip_code]" placeholder="Zip Code"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="submit-first-btn" class="btn dokan-btn-theme dokan-btn-lg ajax-update"
                        value="Next" />
                    <!-- <input type="submit" class="btn dokan-btn-theme dokan-btn-lg"
                        value="<?php //esc_attr_e( 'Next', 'dokan' );?>" /> -->
                </div>
            </div>


            <!-- Second Step -->
            <div class="row setup-content-3" id="step-2">
                <div class="col-md-12">

                    <h3 class="font-weight-bold pl-0 my-4"><strong>Provide Some Important Home Details</strong></h3>

                    <div class="form-group md-form">
                        <input id="post_title" type="hidden" name="post_title" placeholder="Property Title"
                            class="form-control" placeholder="" value="">
                    </div>


                    <div class="form-group md-form">
                    </div>
                    <div class="form-group md-form">
                        <label for="property_type" data-error="wrong" data-success="right">Property Type</label>
                        <select id="property_type" name="home_details[property_type]" class="form-control">
                            <option value="Condo">Condo</option>
                            <option value="Single Family">Single Family</option>
                            <option value="Townhome">Townhome</option>
                            <option value="Mobile Home">Other</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group md-form mt-3">
                                <label for="home_size" data-error="wrong" data-success="right">Home Size (SqFt)</label>
                                <input step="any" id="home_size" type="number" name="home_details[home_size]"
                                    placeholder="SqFt" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group md-form mt-3">
                                <select id="lot_unit" type="checkmark" name="home_details[lot_unit]">
                                    <option value="sqft">SqFt</option>
                                    <option value="acres">Acres</option>
                                </select>
                                <label id="lot_label" for="lot_size" data-error="wrong" data-success="right">Lot Size
                                </label>
                                <input step="any" id="lot_size" type="number" name="home_details[lot_size]"
                                    placeholder="SqFt" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group md-form mt-3">
                                <label for="year_built" data-error="wrong" data-success="right">Year Built</label>
                                <input id="year_built" type="text" name="home_details[year_built]"
                                    placeholder="Year Built" class="year form-control">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group md-form mt-3">
                                <label for="bedrooms" data-error="wrong" data-success="right">Bedrooms</label>
                                <input step="any" id="bedrooms" type="number" name="home_details[bedrooms]"
                                    placeholder="Bedrooms" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group md-form mt-3">
                                <label for="bathrooms" data-error="wrong" data-success="right">Bathrooms</label>
                                <input step="any" id="bathrooms" type="number" name="home_details[bathrooms]"
                                    placeholder="Bathrooms" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group md-form mt-3">
                                <label for="half_bathrooms" data-error="wrong" data-success="right">Half
                                    Bathrooms</label>
                                <input step="any" id="half_bathrooms" type="number" name="home_details[half_bathrooms]"
                                    placeholder="Half Bathrooms" class="form-control">
                            </div>
                        </div>
                    </div>




                    <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                    <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                </div>
            </div>


            <!-- Third Step -->
            <div class="row setup-content-3" id="step-3">
                <div class="col-md-12">
                    <h3 class="font-weight-bold pl-0 my-4"><strong>Connect with Buyers</strong></h3>

                    <div class="form-group md-form">
                        <label for="name" data-error="wrong" data-success="right">Contact Name</label>
                        <input id="name" type="text" name="contact[name]" placeholder="Contact Name"
                            class="form-control">
                    </div>
                    <div class="form-group md-form">
                        <label for="email" data-error="wrong" data-success="right">Contact Email</label>
                        <input id="email" type="text" name="contact[email]" placeholder="Contact Email"
                            class="form-control">
                    </div>
                    <div class="form-group md-form">
                        <label for="number" data-error="wrong" data-success="right">Contact Number</label>
                        <input id="number" type="phone" name="contact[number]" placeholder="(800) 555-5555"
                            class="form-control">
                    </div>

                    <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                    <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                </div>
            </div>


            <!-- Fourth Step -->
            <div class="row setup-content-3" id="step-4">
                <div class="col-md-12">
                    <h3 class="font-weight-bold pl-0 my-4"><strong>Promote Your Home Features</strong></h3>
                    <div class="row">
                        <div class="font-display features-heading">Interior Features</div>

                    </div>
                    <div class="row">
                        <div class="font-display">Interior Features</div>

                        <?php

                            foreach ( $interior_features as $key => $interior_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[interior_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $interior_feature; ?></label>

                                <input type="checkbox" id="home_features[interior_features][<?php echo $key; ?>]"
                                    name="home_features[interior_features][<?php echo $key; ?>]"
                                    value="<?php echo $interior_feature; ?>"
                                    class="interior_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>

                    </div>

                    <div class="row">

                        <div class="font-display">Basements</div>

                        <?php

                            foreach ( $basements as $key => $basement ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[basements][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $basement; ?></label>

                                <input type="checkbox" id="home_features[basements][<?php echo $key; ?>]"
                                    name="home_features[basements][<?php echo $key; ?>]"
                                    value="<?php echo $basement; ?>" class="basements form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>


                    <div class="row">

                        <div class="font-display">Fireplaces</div>

                        <?php

                            foreach ( $fireplaces as $key => $fireplace ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[fireplaces][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $fireplace; ?></label>

                                <input type="checkbox" id="home_features[fireplaces][<?php echo $key; ?>]"
                                    name="home_features[fireplaces][<?php echo $key; ?>]"
                                    value="<?php echo $fireplace; ?>" class="fireplaces form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>


                    <div class="row">

                        <div class="font-display">Coolings <span>(1 or more boxes required to be checked)</span></div>

                        <?php

                            foreach ( $coolings as $key => $cooling ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[coolings][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $cooling; ?></label>

                                <input type="checkbox" id="home_features[coolings][<?php echo $key; ?>]"
                                    name="home_features[coolings][<?php echo $key; ?>]" value="<?php echo $cooling; ?>"
                                    class="coolings form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>

                    <div class="row">

                        <div class="font-display">Heatings</div>

                        <?php

                            foreach ( $heatings as $key => $heating ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[heatings][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $heating; ?></label>

                                <input type="checkbox" id="home_features[heatings][<?php echo $key; ?>]"
                                    name="home_features[heatings][<?php echo $key; ?>]" value="<?php echo $heating; ?>"
                                    class="heatings form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>


                    <div class="row">

                        <div class="font-display">Accessibility Features (*require at
                            least 1 box checked)</div>

                        <?php

                            foreach ( $accessibility_features as $key => $accessibility_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[accessibility_features][<?php echo $key; ?>]"
                                    data-error="wrong"
                                    data-success="right"><?php echo $accessibility_feature; ?></label>

                                <input type="checkbox" id="home_features[accessibility_features][<?php echo $key; ?>]"
                                    name="home_features[accessibility_features][<?php echo $key; ?>]"
                                    value="<?php echo $accessibility_feature; ?>"
                                    class="accessibility_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>

                    <div class="row">

                        <div class="font-display">Kitchen Features (*require at least 1 box
                            checked)</div>
                        <?php

                            foreach ( $kitchen_features as $key => $kitchen_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[kitchen_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $kitchen_feature; ?></label>

                                <input type="checkbox" id="home_features[kitchen_features][<?php echo $key; ?>]"
                                    name="home_features[kitchen_features][<?php echo $key; ?>]"
                                    value="<?php echo $kitchen_feature; ?>"
                                    class="kitchen_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>


                    <div class="row">

                        <div class="font-display">Floorings</div>

                        <?php

                            foreach ( $floorings as $key => $flooring ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[floorings][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $flooring; ?></label>

                                <input type="checkbox" id="home_features[floorings][<?php echo $key; ?>]"
                                    name="home_features[floorings][<?php echo $key; ?>]"
                                    value="<?php echo $flooring; ?>" class="floorings form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>

                    <div class="row">

                        <div class="font-display">Appliances <span>(3 or more boxes required to be checked)</span></div>

                        <?php

                            foreach ( $appliances as $key => $appliance ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[appliances][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $appliance; ?></label>

                                <input type="checkbox" id="home_features[appliances][<?php echo $key; ?>]"
                                    name="home_features[appliances][<?php echo $key; ?>]"
                                    value="<?php echo $appliance; ?>" class="appliances form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>

                    <div class="row">

                        <div class="font-display">Bathroom Features (*require at least 1 box
                            checked)</div>
                        <?php

                            foreach ( $bathroom_features as $key => $bathroom_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[bathroom_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $bathroom_feature; ?></label>

                                <input type="checkbox" id="home_features[bathroom_features][<?php echo $key; ?>]"
                                    name="home_features[bathroom_features][<?php echo $key; ?>]"
                                    value="<?php echo $bathroom_feature; ?>"
                                    class="bathroom_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>

                    <div class="row">

                        <div class="font-display">Eating Areas</div>

                        <?php

                            foreach ( $eating_areas as $key => $eating_area ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[eating_areas][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $eating_area; ?></label>

                                <input type="checkbox" id="home_features[eating_areas][<?php echo $key; ?>]"
                                    name="home_features[eating_areas][<?php echo $key; ?>]"
                                    value="<?php echo $eating_area; ?>" class="eating_areas form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>


                    <div class="row">

                        <div class="font-display">Electrics <span>(1 or more boxes required to be checked)</span></div>

                        <?php

                            foreach ( $electrics as $key => $electric ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[electrics][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $electric; ?></label>

                                <input type="checkbox" id="home_features[electrics][<?php echo $key; ?>]"
                                    name="home_features[electrics][<?php echo $key; ?>]"
                                    value="<?php echo $electric; ?>" class="electrics form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>

                    <div class="row">

                        <div class="font-display">Laundries <span>(1 or more boxes required to be checked)</span></div>

                        <?php

                            foreach ( $laundries as $key => $laundry ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[laundries][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $laundry; ?></label>

                                <input type="checkbox" id="home_features[laundries][<?php echo $key; ?>]"
                                    name="home_features[laundries][<?php echo $key; ?>]" value="<?php echo $laundry; ?>"
                                    class="laundries form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>


                    <div class="row">

                        <div class="font-display">Room Types <span>(2 or more boxes required to be checked)</span></div>
                        <?php

                            foreach ( $room_types as $key => $room_type ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[room_types][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $room_type; ?></label>

                                <input type="checkbox" id="home_features[room_types][<?php echo $key; ?>]"
                                    name="home_features[room_types][<?php echo $key; ?>]"
                                    value="<?php echo $room_type; ?>" class="room_types form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>

                    <div class="row">

                        <div class="font-display">Utilities <span>(1 or more boxes required to be checked)</span></div>
                        <?php

                            foreach ( $utilities as $key => $utility ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[utilities][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $utility; ?></label>

                                <input type="checkbox" id="home_features[utilities][<?php echo $key; ?>]"
                                    name="home_features[utilities][<?php echo $key; ?>]" value="<?php echo $utility; ?>"
                                    class="utilities form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>

                    </div>

                    <div class="row">
                        <div class="font-display features-heading">Exterior Features</div>
                    </div>

                    <div class="row">
                        <div class="font-display">Pool Features</div>
                        <?php

                            foreach ( $pool_features as $key => $pool_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[pool_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $pool_feature; ?></label>

                                <input type="checkbox" id="home_features[pool_features][<?php echo $key; ?>]"
                                    name="home_features[pool_features][<?php echo $key; ?>]"
                                    value="<?php echo $pool_feature; ?>"
                                    class="pool_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Views</div>
                        <?php

                            foreach ( $views as $key => $view ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[views][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $view; ?></label>

                                <input type="checkbox" id="home_features[views][<?php echo $key; ?>]"
                                    name="home_features[views][<?php echo $key; ?>]" value="<?php echo $view; ?>"
                                    class="views form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Door Features</div>
                        <?php

                            foreach ( $door_features as $key => $door_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[door_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $door_feature; ?></label>

                                <input type="checkbox" id="home_features[door_features][<?php echo $key; ?>]"
                                    name="home_features[door_features][<?php echo $key; ?>]"
                                    value="<?php echo $door_feature; ?>"
                                    class="door_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Fencings <span>(1 or more boxes required to be checked)</span></div>
                        <?php

                            foreach ( $fencings as $key => $fencing ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[fencings][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $fencing; ?></label>

                                <input type="checkbox" id="home_features[fencings][<?php echo $key; ?>]"
                                    name="home_features[fencings][<?php echo $key; ?>]" value="<?php echo $fencing; ?>"
                                    class="fencings form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Security Features</div>
                        <?php

                            foreach ( $security_features as $key => $security_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[security_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $security_feature; ?></label>

                                <input type="checkbox" id="home_features[security_features][<?php echo $key; ?>]"
                                    name="home_features[security_features][<?php echo $key; ?>]"
                                    value="<?php echo $security_feature; ?>"
                                    class="security_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Parkings <span>(1 or more boxes required to be checked)</span></div>
                        <?php

                            foreach ( $parkings as $key => $parking ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[parkings][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $parking; ?></label>

                                <input type="checkbox" id="home_features[parkings][<?php echo $key; ?>]"
                                    name="home_features[parkings][<?php echo $key; ?>]" value="<?php echo $parking; ?>"
                                    class="parkings form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Spa Features</div>
                        <?php

                            foreach ( $spa_features as $key => $spa_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[spa_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $spa_feature; ?></label>

                                <input type="checkbox" id="home_features[spa_features][<?php echo $key; ?>]"
                                    name="home_features[spa_features][<?php echo $key; ?>]"
                                    value="<?php echo $spa_feature; ?>" class="spa_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Common Walls <span>(1 or more boxes required to be checked)</span>
                        </div>
                        <?php

                            foreach ( $common_walls as $key => $common_wall ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[common_walls][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $common_wall; ?></label>

                                <input type="checkbox" id="home_features[common_walls][<?php echo $key; ?>]"
                                    name="home_features[common_walls][<?php echo $key; ?>]"
                                    value="<?php echo $common_wall; ?>" class="common_walls form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Construction Materials</div>
                        <?php

                            foreach ( $construction_materials as $key => $construction_material ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[construction_materials][<?php echo $key; ?>]"
                                    data-error="wrong"
                                    data-success="right"><?php echo $construction_material; ?></label>

                                <input type="checkbox" id="home_features[construction_materials][<?php echo $key; ?>]"
                                    name="home_features[construction_materials][<?php echo $key; ?>]"
                                    value="<?php echo $construction_material; ?>"
                                    class="construction_materials form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Roofs <span>(1 or more boxes required to be checked)</span></div>
                        <?php

                            foreach ( $roofs as $key => $roof ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[roofs][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $roof; ?></label>

                                <input type="checkbox" id="home_features[roofs][<?php echo $key; ?>]"
                                    name="home_features[roofs][<?php echo $key; ?>]" value="<?php echo $roof; ?>"
                                    class="roofs form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Foundation Details (*require at least 1
                            box checked)</div>
                        <?php

                            foreach ( $foundation_details as $key => $foundation_detail ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[foundation_details][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $foundation_detail; ?></label>

                                <input type="checkbox" id="home_features[foundation_details][<?php echo $key; ?>]"
                                    name="home_features[foundation_details][<?php echo $key; ?>]"
                                    value="<?php echo $foundation_detail; ?>"
                                    class="foundation_details form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Waterfront Features</div>
                        <?php

                            foreach ( $waterfront_features as $key => $waterfront_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[waterfront_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $waterfront_feature; ?></label>

                                <input type="checkbox" id="home_features[waterfront_features][<?php echo $key; ?>]"
                                    name="home_features[waterfront_features][<?php echo $key; ?>]"
                                    value="<?php echo $waterfront_feature; ?>"
                                    class="waterfront_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Patio and Porch Features</div>
                        <?php

                            foreach ( $patio_and_porch_features as $key => $patio_and_porch_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[patio_and_porch_features][<?php echo $key; ?>]"
                                    data-error="wrong"
                                    data-success="right"><?php echo $patio_and_porch_feature; ?></label>

                                <input type="checkbox" id="home_features[patio_and_porch_features][<?php echo $key; ?>]"
                                    name="home_features[patio_and_porch_features][<?php echo $key; ?>]"
                                    value="<?php echo $patio_and_porch_feature; ?>"
                                    class="patio_and_porch_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Lot Features <span>(1 or more boxes required to be checked)</span>
                        </div>
                        <?php

                            foreach ( $lot_features as $key => $lot_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[lot_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $lot_feature; ?></label>

                                <input type="checkbox" id="home_features[lot_features][<?php echo $key; ?>]"
                                    name="home_features[lot_features][<?php echo $key; ?>]"
                                    value="<?php echo $lot_feature; ?>" class="lot_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Property Conditions (*require at least 1
                            box checked)</div>
                        <?php

                            foreach ( $property_conditions as $key => $property_condition ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[property_conditions][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $property_condition; ?></label>

                                <input type="checkbox" id="home_features[property_conditions][<?php echo $key; ?>]"
                                    name="home_features[property_conditions][<?php echo $key; ?>]"
                                    value="<?php echo $property_condition; ?>"
                                    class="property_conditions form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Sewers <span>(1 or more boxes required to be checked)</span></div>
                        <?php

                            foreach ( $sewers as $key => $sewer ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[sewers][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $sewer; ?></label>

                                <input type="checkbox" id="home_features[sewers][<?php echo $key; ?>]"
                                    name="home_features[sewers][<?php echo $key; ?>]" value="<?php echo $sewer; ?>"
                                    class="sewers form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Water Sources <span>(1 or more boxes required to be checked)</span>
                        </div>
                        <?php

                            foreach ( $water_sources as $key => $water_source ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[water_sources][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $water_source; ?></label>

                                <input type="checkbox" id="home_features[water_sources][<?php echo $key; ?>]"
                                    name="home_features[water_sources][<?php echo $key; ?>]"
                                    value="<?php echo $water_source; ?>"
                                    class="water_sources form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Architectural Styles</div>
                        <?php

                            foreach ( $architectural_styles as $key => $architectural_style ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[architectural_styles][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $architectural_style; ?></label>

                                <input type="checkbox" id="home_features[architectural_styles][<?php echo $key; ?>]"
                                    name="home_features[architectural_styles][<?php echo $key; ?>]"
                                    value="<?php echo $architectural_style; ?>"
                                    class="architectural_styles form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Community Features (*require at least 1
                            box checked)</div>
                        <?php

                            foreach ( $community_features as $key => $community_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[community_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $community_feature; ?></label>

                                <input type="checkbox" id="home_features[community_features][<?php echo $key; ?>]"
                                    name="home_features[community_features][<?php echo $key; ?>]"
                                    value="<?php echo $community_feature; ?>"
                                    class="community_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Road Frontage Types</div>
                        <?php

                            foreach ( $road_frontage_types as $key => $road_frontage_type ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[road_frontage_types][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $road_frontage_type; ?></label>

                                <input type="checkbox" id="home_features[road_frontage_types][<?php echo $key; ?>]"
                                    name="home_features[road_frontage_types][<?php echo $key; ?>]"
                                    value="<?php echo $road_frontage_type; ?>"
                                    class="road_frontage_types form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Road Surface Types</div>
                        <?php

                            foreach ( $road_surface_types as $key => $road_surface_type ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[road_surface_types][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $road_surface_type; ?></label>

                                <input type="checkbox" id="home_features[road_surface_types][<?php echo $key; ?>]"
                                    name="home_features[road_surface_types][<?php echo $key; ?>]"
                                    value="<?php echo $road_surface_type; ?>"
                                    class="road_surface_type form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Disclosures</div>
                        <?php

                            foreach ( $disclosures as $key => $disclosure ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[disclosures][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $disclosure; ?></label>

                                <input type="checkbox" id="home_features[disclosures][<?php echo $key; ?>]"
                                    name="home_features[disclosures][<?php echo $key; ?>]"
                                    value="<?php echo $disclosure; ?>" class="disclosures form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Exterior Features</div>
                        <?php

                            foreach ( $exterior_features as $key => $exterior_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[exterior_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $exterior_feature; ?></label>

                                <input type="checkbox" id="home_features[exterior_features][<?php echo $key; ?>]"
                                    name="home_features[exterior_features][<?php echo $key; ?>]"
                                    value="<?php echo $exterior_feature; ?>"
                                    class="exterior_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Other Structures</div>
                        <?php

                            foreach ( $other_structures as $key => $other_structure ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[other_structures][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $other_structure; ?></label>

                                <input type="checkbox" id="home_features[other_structures][<?php echo $key; ?>]"
                                    name="home_features[other_structures][<?php echo $key; ?>]"
                                    value="<?php echo $other_structure; ?>"
                                    class="other_structures form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>
                    <div class="row">
                        <div class="font-display">Window Features</div>
                        <?php

                            foreach ( $window_features as $key => $window_feature ) {?>
                        <div class="col-md-4">
                            <div class="form-check md-form mt-3">
                                <label for="home_features[window_features][<?php echo $key; ?>]" data-error="wrong"
                                    data-success="right"><?php echo $window_feature; ?></label>

                                <input type="checkbox" id="home_features[window_features][<?php echo $key; ?>]"
                                    name="home_features[window_features][<?php echo $key; ?>]"
                                    value="<?php echo $window_feature; ?>"
                                    class="window_features form-check-input validate">

                            </div>
                        </div>

                        <?php }

                            ?>
                    </div>



                    <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                    <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update features-tab"
                        value="Next" />

                </div>
            </div>
            <!-- Fifth Step Images Upload -->
            <div class="row setup-content-3" id="step-5">
                <div class="col-md-12">
                    <h3 class="font-weight-bold pl-0 my-4"><strong>Upload Your Home Photos</strong></h3>
                    <div class="product-edit-container dokan-clearfix">
                        <div class="half featured-image">
                            <div class="featured-image">
                                <div class="dokan-feat-image-upload">
                                    <div class="instruction-inside">
                                        <input type="hidden" name="feat_image_id" class="dokan-feat-image-id" value="0">
                                        <i class="fa fa-cloud-upload"></i>
                                        <a href="#"
                                            class="dokan-feat-image-btn dokan-btn"><?php _e( 'Upload Product Image', 'dokan' );?></a>
                                    </div>

                                    <div class="image-wrap dokan-hide">
                                        <a class="close dokan-remove-feat-image">&times;</a>
                                        <img src="" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="dokan-product-gallery">
                                <div class="dokan-side-body" id="dokan-product-images">
                                    <div id="product_images_container">
                                        <ul class="product_images dokan-clearfix">
                                            <li class="add-image add-product-images tips"
                                                data-title="<?php _e( 'Add gallery image', 'dokan' );?>">
                                                <a href="#" class="add-product-images"><i class="fa fa-plus"
                                                        aria-hidden="true"></i></a>
                                            </li>
                                        </ul>
                                        <input type="hidden" id="product_image_gallery" name="product_image_gallery"
                                            value="">
                                    </div>
                                </div>
                            </div> <!-- .product-gallery -->
                        </div>
                        <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                        <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                    </div>
                </div>
            </div>

            <!-- Sixth Step Video Tour-->
            <div class="row setup-content-3" id="step-6">
                <div class="col-md-12">
                    <h3 class="font-weight-bold pl-0 my-4"><strong>Add a Video Tour</strong></h3>
                    <div class="form-group md-form">
                        <label for="video" data-error="wrong" data-success="right">Include a Video of Your
                            Listing</label>
                        <input id="video" type="text" name="video"
                            placeholder="https://www.youtube.com/watch?v=ffMfvsejBoo" class="form-control">
                    </div>

                    <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                    <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                </div>
            </div>
            <div class="row setup-content-3" id="step-7">
                <div class="col-md-12">
                    <h3 class="font-weight-bold pl-0 my-4"><strong>Description</strong></h3>
                    <div class="dokan-form-group dokan-auction-post-excerpt">
                        <textarea name="post_excerpt" id="post-excerpt" rows="5" class="dokan-form-control"
                            placeholder="<?php esc_attr_e( 'Short description about the listing...', 'dokan' );?>"><?php echo dokan_posted_textarea( 'post_excerpt' ); ?></textarea>
                    </div>
                    <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                    <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                </div>
            </div>
            <div class="row setup-content-3" id="step-8">
                <div class="col-md-12">
                    <h3 class="font-weight-bold pl-0 my-4"><strong>Asking Price</strong></h3>

                    <div class="form-group">
                        <label for="_regular_price" data-error="wrong"
                            data-success="right"><?php _e( 'Final Offer', 'dokan' );?></label>
                        <div class="dokan-form-group">
                            <div class="dokan-input-group">
                                <span
                                    class="dokan-input-group-addon"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                <input id="_regular_price" type="number" name="_regular_price" placeholder="$404,999"
                                    class="wc_input_price form-control validate">
                            </div>
                        </div>
                        <div id="final_price_popup">Help me to determine price <i class="fas fa-info-circle"></i></div>
                    </div>

                    <div class="half dokan-auction-start-price">
                        <label class="dokan-control-label"
                            for="_auction_start_price"><?php _e( 'Start Price', 'dokan' );?></label>
                        <div class="dokan-form-group">
                            <div class="dokan-input-group">
                                <span
                                    class="dokan-input-group-addon"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                <input class="wc_input_price dokan-form-control form-control validate"
                                    name="_auction_start_price" id="_auction_start_price" type="text"
                                    placeholder="<?php echo wc_format_localized_price( '9.99' ); ?>" value=""
                                    style="width: 97%;">
                            </div>
                        </div>
                    </div>

                    <div class="dokan-auction-bid-increment">

                        <div class="dokan-form-group">
                            <div class="dokan-input-group">

                                <input class="wc_input_price dokan-form-control form-control validate"
                                    name="_auction_bid_increment" id="_auction_bid_increment" type="hidden"
                                    placeholder="<?php echo wc_format_localized_price( '1000' ); ?>" value="">
                            </div>
                        </div>
                    </div>
                    <div class="half dokan-auction-dates-from">
                        <label class="dokan-control-label"
                            for="_auction_dates_from"><?php _e( 'Auction Start date', 'dokan' );?></label>
                        <div class="dokan-form-group">
                            <input class="dokan-form-control auction-datepicker" name="_auction_dates_from"
                                id="_auction_dates_from" type="text" value="" style="width: 97%;" readonly>

                        </div>
                    </div>

                    <div class="half dokan-auction-dates-to">
                        <label class="dokan-control-label"
                            for="_auction_dates_to"><?php _e( 'Auction End date', 'dokan' );?></label>
                        <div class="dokan-form-group">
                            <input class="dokan-form-control auction-datepicker" name="_auction_dates_to"
                                id="_auction_dates_to" type="text" value="" readonly>
                        </div>
                    </div>
                    <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                    <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                </div>
            </div>

            <!-- Final Step -->
            <div class="row setup-content-3" id="step-9">
                <div class="col-md-12">

                    <h3 class="font-weight-bold pl-0 my-4"><strong>Finish</strong></h3>
                    <h4 class="font-weight-bold my-4">Listing completed!</h4>



                    <div class="dokan-form-group">
                        <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                        <input type="hidden" name="product-type" value="auction">

                        <?php wp_nonce_field( 'dokan_add_new_auction_product', 'dokan_add_new_auction_product_nonce' );?>
                        <input type="hidden" name="dokan_product_id" id="dokan-edit-product-id" value="" />
                        <input type="hidden" name="product-type" value="auction">
                        <input type="hidden" name="action" value="update_product_meta">
                        <input type="submit" name="add_auction_product"
                            class="submit-btn btn dokan-btn-theme dokan-btn-lg"
                            value="<?php esc_attr_e( 'Add auction', 'dokan' );?>" />
                    </div>
                </div>
            </div>


        </div>
        <!-- Grid row -->
    </div>

    <script type="text/javascript">
    ;
    (function($) {
        var auction_submit = $('.dokan-auction-product-form');

        var ajax_submit = $('.ajax_update_form');


        ajax_submit.on('submit', function(e) {

            e.preventDefault();

            var address_1 = $('#address_1').val() != '' ? $('#address_1').val() + ', ' : '';
            var address_2 = $('#address_2').val() != '' ? $('#address_2').val() + ', ' : '';
            var city = $('#city').val() != '' ? $('#city').val() + ', ' : '';
            var state = $('#state').val() != '' ? $('#state').val() + ', ' : '';
            var zip_code = $('#zip_code').val() != '' ? $('#zip_code').val() : '';
            var edit_id = $('#dokan-edit-product-id');
            //var featureBtn = $(this).find("input[type=submit]:focus");


            var curStep = $(this).closest(".setup-content-3"),
                curStepBtn = curStep.attr("id"),
                nextStepStep = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().next()
                .children("a");

            var title = address_1 + address_2 + city + state + zip_code;
            var post_title = $('#post_title');
            post_title.val(title);

            var data = $(this).serialize();

            //btn.attr('disabled', true);
            //nextBtn.attr('disabled', true);

            $.ajax({
                url: RIS_Notify.ajaxurl,
                method: 'POST',
                beforeSend: function(xhr) {
                    // Set nonce here
                    xhr.setRequestHeader('X-WP-Nonce', RIS_Notify.nonce);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Updating records...',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    });
                },
                // Build post data.
                // If method is "delete", data should be passed as query params.
                data: data
            }).done(function(response) {

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your home details has been updated',
                    showConfirmButton: false,
                    timer: 2000
                });

                //submitNext.removeClass('btn dokan-btn-theme dokan-btn-lg ajax-update');
                //submitNext.addClass('btn dokan-btn-theme dokan-btn-lg nextBtn-3');
                //submitNext.prop('type', 'button');

                console.log(response.data.id);

                edit_id.val(response.data.id);

                //nextStepStep.trigger('click');


                //window.location.reload(true);
            }).fail(function(response) {


            }).always(function() {

            });


        });



        $('input[type="checkbox"]').click(function() {

            var showBtn = false;
            var featureTab = $('#step-4 .features-tab');
            var coolings = $('.coolings:checked').length; // 3
            var accessibility_features = $('.accessibility_features:checked').length; // 1
            var kitchen_features = $('.kitchen_features:checked').length; // 1
            var appliances = $('.appliances:checked').length; // 3
            var bathroom_features = $('.bathroom_features:checked').length; // 1
            var fencings = $('.fencings:checked').length; // 1
            var parkings = $('.parkings:checked').length; // 1
            var electrics = $('.electrics:checked').length; // 1
            var laundries = $('.laundries:checked').length; // 1
            var room_types = $('.room_types:checked').length; // 2
            var utilities = $('.utilities:checked').length; // 1
            var common_walls = $('.common_walls:checked').length; // 1
            var construction_materials = $('.construction_materials:checked').length; // 1
            var roofs = $('.roofs:checked').length; // 1
            var foundation_details = $('.foundation_details:checked').length; // 1
            var lot_features = $('.lot_features:checked').length; // 1
            var property_conditions = $('.property_conditions:checked').length; // 1
            var sewers = $('.sewers:checked').length; // 1
            var water_sources = $('.water_sources:checked').length; // 1
            var community_features = $('.community_features:checked').length; // 1


            if (coolings >= 3 && accessibility_features >= 3 && room_types >= 2 && accessibility_features >=
                1 && kitchen_features >= 1 && appliances >= 1 && bathroom_features >= 1 && fencings >= 1 &&
                parkings >= 1 && electrics >= 1 && laundries >= 1 && utilities >= 1 && common_walls >= 1 &&
                construction_materials >= 1 && roofs >= 1 && foundation_details >= 1 && lot_features >= 1 &&
                property_conditions >= 1 && sewers >= 1 && water_sources >= 1 && community_features >= 1) {

                console.log(this);
                showBtn = true;
            }

            if (showBtn) {
                featureTab.attr('disabled', false);
            } else {
                featureTab.attr('disabled', true);
            }
            console.log(showBtn);


        });



        $(function() {

            var featureTab = $('#step-4 .features-tab');

            var coolings = $('.coolings:checked').length; // 3
            var accessibility_features = $('.accessibility_features:checked').length; // 1
            var kitchen_features = $('.kitchen_features:checked').length; // 1
            var appliances = $('.appliances:checked').length; // 3
            var bathroom_features = $('.bathroom_features:checked').length; // 3
            var fencings = $('.fencings:checked').length; // 1
            var parkings = $('.parkings:checked').length; // 1
            var electrics = $('.electrics:checked').length; // 1
            var laundries = $('.laundries:checked').length; // 1
            var room_types = $('.room_types:checked').length; // 2
            var utilities = $('.utilities:checked').length; // 1
            var common_walls = $('.common_walls:checked').length; // 1
            var construction_materials = $('.construction_materials:checked').length; // 1
            var roofs = $('.roofs:checked').length; // 1
            var foundation_details = $('.foundation_details:checked').length; // 1
            var lot_features = $('.lot_features:checked').length; // 1
            var property_conditions = $('.property_conditions:checked').length; // 1
            var sewers = $('.sewers:checked').length; // 1
            var water_sources = $('.water_sources:checked').length; // 1
            var community_features = $('.community_features:checked').length; // 1


            featureTab.attr('disabled', false);
        });


        $(function() {
            console.log($('.auction-datepicker').datetimepicker({
                dateFormat: 'mm-dd-yy'
            }));

            $('.auction-datepicker').datetimepicker({
                format: 'd-m-Y H:i',
            });

            $('#_auction_dates_from').datetimepicker({
                minDate: 0
            });

            $('#_auction_dates_from').datepicker("setDate", new Date());

        });

        var final_price_popup = $('#final_price_popup');
        final_price_popup.on('click', function(e) {

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Get My Price Now',
                html: '<p style="font-size: 20px;font-weight: 400;line-height: 1.2;">Use Home Value tool to determine home value, <a href="/dashboard/tools" target="_blank">Go to the tool page</a></p>',
                showConfirmButton: true,
                confirmButtonColor: '#FF6600',
                confirmButtonText: 'Get Your Value',
                timerProgressBar: false,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.open('/dashboard/tools');
                };

            });
        });

    })(jQuery);
    </script>



    <?php
        }

        /*
         * Saving product field data for edit and update
         */

        //add_action( 'woocommerce_update_product', 'save_add_product_meta', 10, 1 );
        add_action( 'dokan_new_auction_product_added', 'save_add_product_meta', 10, 1 );
        add_action( 'dokan_update_auction_product', 'save_add_product_meta', 10, 1 );

        function save_add_product_meta( $product_id ) {

        //$_auction_dates_from_old = get_post_meta( $product_id, '_auction_dates_from', true );
            //$_auction_dates_to_old   = get_post_meta( $product_id, '_auction_dates_to', true );

            update_post_meta( $product_id, '_auction_type', 'normal', true );

            $address       = isset( $_POST['address'] ) ? $_POST['address'] : '';
            $home_details  = isset( $_POST['home_details'] ) ? $_POST['home_details'] : '';
            $contact       = isset( $_POST['contact'] ) ? $_POST['contact'] : '';
            $home_features = isset( $_POST['home_features'] ) ? $_POST['home_features'] : '';
            $video         = isset( $_POST['video'] ) ? $_POST['video'] : '';

        // echo '<pre>';

        //     var_dump($_POST );
            //     die();

            $property_data = [
                'address'       => $address,
                'home_details'  => $home_details,
                'contact'       => $contact,
                'home_features' => $home_features,
                'video'         => $video,
            ];

            if ( ! dokan_is_user_seller( get_current_user_id() ) ) {
                return;
            }

        //echo '<pre>';

        //var_dump(  );

            //die();

            update_post_meta( $product_id, 'property_data', $property_data );
            update_post_meta( $product_id, '_address_1', $address['address_1'] );
            update_post_meta( $product_id, '_address_2', $address['address_2'] );
            update_post_meta( $product_id, '_city', $address['city'] );
            update_post_meta( $product_id, '_state', $address['state'] );
            update_post_meta( $product_id, '_zip_code', $address['zip_code'] );
            update_post_meta( $product_id, '_property_type', $home_details['property_type'] );
            update_post_meta( $product_id, '_home_size', $home_details['home_size'] );
            update_post_meta( $product_id, '_lot_size', $home_details['lot_size'] );
            update_post_meta( $product_id, '_lot_unit', $home_details['lot_unit'] );
            update_post_meta( $product_id, '_year_built', $home_details['year_built'] );
            update_post_meta( $product_id, '_bedrooms', $home_details['bedrooms'] );
            update_post_meta( $product_id, '_bathrooms', $home_details['bathrooms'] );
            update_post_meta( $product_id, '_half_bathrooms', $home_details['half_bathrooms'] );

        }

        /*
         * Showing field data on product edit page
         */

        add_action( 'dokan_product_edit_after_main_updated', 'show_on_edit_page', 99, 2 );
        add_action( 'dokan_product_edit_after_main', 'show_on_edit_page', 99, 2 );

        function show_on_edit_page( $post, $post_id ) {

            global $all_states;

        //echo '<pre>';

            //var_dump($_POST );

            $_regular_price          = get_post_meta( $post_id, '_regular_price', true );
            $_auction_start_price    = get_post_meta( $post_id, '_auction_start_price', true );
            $_auction_bid_increment  = get_post_meta( $post_id, '_auction_bid_increment', true );
            $_auction_reserved_price = get_post_meta( $post_id, '_auction_reserved_price', true );
            $_auction_dates_from     = get_post_meta( $post_id, '_auction_dates_from', true );
            $_auction_dates_to       = get_post_meta( $post_id, '_auction_dates_to', true );

            $states         = array_keys( $all_states );
            $property_types = ['Condo', 'Single Family', 'Townhome', 'Other'];

            // Interior
            $interior_features      = ['2 Staircases', 'In-Law Floorplan', 'Attic Fan', 'Balcony', 'Bar', 'Beamed Ceilings', 'Block Walls', 'Brick Walls', 'Built-in Features', 'Cathedral Ceiling(s)', 'Ceiling Fan(s)', 'Ceramic Counters', 'Chair Railings', 'Coffered Ceiling(s)', 'Copper Plumbing Full', 'Copper Plumbing Partial', 'Corian Counters', 'Crown Molding', 'Dry Bar', 'Dumbwaiter', 'Electronic Air Cleaner', 'Elevator', 'Formica Counters', 'Furnished', 'Granite Counters', 'High Ceilings', 'Home Automation System', 'Intercom', 'Laminate Counters', 'Living Room Balcony', 'Living Room Deck Attached', 'Open Floorplan', 'Pantry', 'Partially Furnished', 'Phone System', 'Pull Down Stairs to Attic', 'Recessed Lighting', 'Stair Climber', 'Stone Counters', 'Storage', 'Sump Pump', 'Sunken Living Room', 'Suspended Ceiling(s)', 'Tandem', 'Tile Counters', 'Track Lighting', 'Trash Chute', 'Tray Ceiling(s)', 'Two Story Ceilings', 'Unfinished Walls', 'Unfurnished', 'Vacuum Central', 'Wainscoting', 'Wet Bar', 'Wired for Data', 'Wired for Sound', 'Wood Product Walls'];
            $basements              = ['Finished', 'Unfinished', 'Utility'];
            $fireplaces             = ['Bath', 'Bonus Room', 'Den', 'Dining Room', 'Family Room', 'Game Room', 'Guest House', 'Kitchen', 'Library', 'Living Room', 'Circulating', 'Master Bedroom', 'Master Retreat', 'Outside', 'Patio', 'Electric', 'Gas', 'Gas Starter', 'Pellet Stove', 'Propane', 'Wood Burning', 'Wood Stove Insert', 'Blower Fan', 'Circular', 'Decorative', 'Fire Pit', 'Free Standing', 'Great Room', 'Heatilator', 'Masonry', 'Raised Hearth', 'Zero Clearance', 'See Through', 'Two Way', 'See Remarks'];
            $coolings               = ['Central Air', 'Dual', 'Zoned', 'Wall/Window Unit(s)', 'Evaporative Cooling', 'Heat Pump', 'Humidity Control', 'Whole House Fan', 'Electric', 'Gas', 'ENERGY STAR Qualified Equipment', 'High Efficiency', 'SEER Rated 13-15', 'SEER Rated 16+', 'See Remarks'];
            $heatings               = ['Central', 'Zoned', 'Baseboard', 'Floor Furnace', 'Wall Furnace', 'Space Heater', 'Forced Air', 'Gravity', 'Heat Pump', 'Radiant', 'Electric', 'Natural Gas', 'Propane', 'Kerosene', 'Pellet Stove', 'Wood', 'Oil', 'Solar', 'ENERGY STAR Qualified Equipment', 'High Efficiency', 'Combination', 'Fireplace(s)', 'Humidity Control', 'Wood Stove', 'See Remarks'];
            $accessibility_features = ['2+ Access Exits', '32 Inch Or More Wide Doors', '36 Inch Or More Wide Halls', '48 Inch Or More Wide Halls', 'Accessible Elevator Installed', 'Adaptable For Elevator', 'Customized Wheelchair Accessible', 'Disability Features', 'Doors - Swing In', 'Entry Slope Less Than 1 Foot', 'Grab Bars In Bathroom(s)', 'Low Pile Carpeting', 'Lowered Light Switches', 'No Interior Steps', 'Other', 'Parking', 'Ramp - Main Level', 'See Remarks'];
            $kitchen_features       = ['Built-in Trash/Recycling', 'Butler’s Pantry', 'Corian Counters', 'Formica Counters', 'Granite Counters', 'Kitchen Island', 'Kitchen Open to Family Room', 'Kitchenette', 'Laminate Counters', 'Pots & Pan Drawers', 'Quartz Counters', 'Remodeled Kitchen', 'Self-closing cabinet doors', 'Self-closing drawers', 'Stone Counters', 'Tile Counters', 'Utility sink', 'Walk-In Pantry', 'Needs Update'];
            $floorings              = ['Bamboo', 'Brick', 'Carpet', 'Concrete', 'Laminate', 'See Remarks', 'Stone', 'Tile', 'Vinyl', 'Wood'];
            $appliances             = ['6 Burner Stove', 'Barbecue', 'Built-In Range', 'Coal Water Heater', 'Convection Oven', 'Dishwasher', 'Double Oven', 'Electric Oven', 'Electric Range', 'Electric Cooktop', 'Electric Water Heater', 'ENERGY STAR Qualified Appliances', 'ENERGY STAR Qualified Water Heater', 'Free-Standing Range', 'Freezer', 'Disposal', 'Gas & Electric Range', 'Gas Oven', 'Gas Range', 'Gas Cooktop', 'Gas Water Heater', 'Indoor Grill', 'High Efficiency Water Heater', 'Hot Water Circulator', 'Ice Maker', 'Instant Hot Water', 'Microwave', 'No Hot Water', 'Portable Dishwasher', 'Propane Oven', 'Propane Range', 'Propane Cooktop', 'Propane Water Heater', 'Range Hood', 'Recirculated Exhaust Fan', 'Refrigerator', 'Self Cleaning Oven', 'Solar Hot Water', 'Tankless Water Heater', 'Trash Compactor', 'Vented Exhaust Fan', 'Warming Drawer', 'Water Heater Central', 'Water Heater', 'Water Line to Refrigerator', 'Water Purifier', 'Water Softener'];
            $bathroom_features      = ['Bathtub', 'Bidet', 'Low Flow Shower', 'Low Flow Toilet(s)', 'Shower', 'Shower in Tub', 'Closet in bathroom', 'Corian Counters', 'Double sinks in bath(s)', 'Double Sinks In Master Bath', 'Dual shower heads (or Multiple)', 'Exhaust fan(s)', 'Formica Counters', 'Granite Counters', 'Heated Floor', 'Hollywood Bathroom (Jack&Jill)', 'Humidity controlled', 'Jetted Tub', 'Laminate Counters', 'Linen Closet/Storage', 'Privacy toilet door', 'Quartz Counters', 'Remodeled', 'Separate tub and shower', 'Soaking Tub', 'Stone Counters', 'Tile Counters', 'Upgraded', 'Vanity area', 'Walk-in shower', 'Needs Update'];
            $eating_areas           = ['Area', 'Breakfast Counter / Bar', 'Breakfast Nook', 'Dining Ell', 'Family Kitchen', 'In Family Room', 'Dining Room', 'In Kitchen', 'In Living Room', 'Separated', 'Country Kitchen', 'See Remarks'];
            $electrics              = ['220 Volts For Spa', '220 Volts in Garage', '220 Volts in Kitchen', '220 Volts in Laundry', '220 Volts in Workshop', '220V Other - See Remarks', '220 Volts', '440 Volts', 'Electricity - On Bond', 'Electricity - On Property', 'Electricity - Unknown', 'Heavy', 'Photovoltaics on Grid', 'Photovoltaics Seller Owned', 'Photovoltaics Stand-Alone', 'Photovoltaics Third-Party Owned', 'Standard'];
            $laundries              = ['Common Area', 'Community', 'Dryer Included', 'Electric Dryer Hookup', 'Gas & Electric Dryer Hookup', 'Gas Dryer Hookup', 'In Carport', 'In Closet', 'In Garage', 'In Kitchen', 'Individual Room', 'Inside', 'Laundry Chute', 'Upper Level', 'Outside', 'Propane Dryer Hookup', 'See Remarks', 'Stackable', 'Washer Hookup', 'Washer Included'];
            $room_types             = ['All Bedrooms Down', 'All Bedrooms Up', 'Art Studio', 'Atrium', 'Attic', 'Basement', 'Bonus Room', 'Center Hall', 'Converted Bedroom', 'Dance Studio', 'Den', 'Dressing Area', 'Entry', 'Exercise Room', 'Family Room', 'Formal Entry', 'Foyer', 'Galley Kitchen', 'Game Room', 'Great Room', "Guest/Maid's Quarters", 'Home Theatre', 'Jack & Jill', 'Kitchen', 'Laundry', 'Library', 'Living Room', 'Loft', 'Main Floor Bedroom', 'Main Floor Master Bedroom', 'Master Bathroom', 'Master Bedroom', 'Master Suite', 'Media Room', 'Multi-Level Bedroom', 'Office', 'Projection', 'Recreation', 'Retreat', 'Sauna', 'See Remarks', 'Separate Family Room', 'Sound Studio', 'Sun', 'Two Masters', 'Utility Room', 'Walk-In Closet', 'Walk-In Pantry', 'Wine Cellar', 'Workshop'];
            $utilities              = ['Cable Available', 'Cable Connected', 'Cable Not Available', 'Electricity Available', 'Electricity Connected', 'Electricity Not Available', 'Natural Gas Available', 'Natural Gas Connected', 'Natural Gas Not Available', 'Other', 'Phone Available', 'Phone Connected', 'Phone Not Available', 'Propane', 'See Remarks', 'Sewer Available', 'Sewer Connected', 'Sewer Not Available', 'Underground Utilities', 'Water Available', 'Water Connected', 'Water Not Available'];

            // Exterior

            $pool_features            = ['Private', 'Association', 'Community', 'Above Ground', 'Black Bottom', 'Diving Board', 'Exercise Pool', 'Fenced', 'Fiberglass', 'Filtered', 'Gunite', 'Heated', 'Heated Passively', 'Electric Heat', 'Gas Heat', 'Heated with Propane', 'In Ground', 'Indoor', 'Lap', 'Infinity', 'No Permits', 'Pebble', 'Permits', 'Pool Cover', 'Roof Top', 'Salt Water', 'See Remarks', 'Solar Heat', 'Tile', 'Vinyl', 'Waterfall'];
            $views                    = ['Back Bay', 'Dunes', 'Bay', 'Bluff', 'Bridge(s)', 'Canal', 'Canyon', 'Catalina', 'City Lights', 'Coastline', 'Courtyard', 'Creek/Stream', 'Desert', 'Golf Course', 'Harbor', 'Hills', 'Lake', 'Landmark', 'Marina', 'Meadow', 'Mountain(s)', 'Neighborhood', 'Ocean', 'Orchard', 'Panoramic', 'Park/Greenbelt', 'Pasture', 'Peek-A-Boo', 'Pier', 'Pond', 'Pool', 'Reservoir', 'River', 'Rocks', 'See Remarks', 'Trees/Woods', 'Valley', 'Vincent Thomas Bridge', 'Vineyard', 'Water', 'White Water'];
            $door_features            = ['Atrium Doors', 'Double Door Entry', 'ENERGY STAR Qualified Doors', 'French Doors', 'Insulated Doors', 'Mirror Closet Door(s)', 'Panel Doors', 'Service Entrance', 'Sliding Doors', 'Storm Door(s)'];
            $fencings                 = ['Average Condition', 'Barbed Wire', 'Block', 'Brick', 'Chain Link', 'Cross Fenced', 'Electric', 'Excellent Condition', 'Fair Condition', 'Glass', 'Goat Type', 'Good Condition', 'Grapestake', 'Invisible', 'Livestock', 'Masonry', 'Needs Repair', 'New Condition', 'Partial', 'Pipe', 'Poor Condition', 'Privacy', 'Redwood', 'Security', 'See Remarks', 'Split Rail', 'Stone', 'Stucco Wall', 'Vinyl', 'Wire', 'Wood', 'Wrought Iron'];
            $security_features        = ['24 Hour Security', 'Gated with Attendant', 'Automatic Gate', 'Carbon Monoxide Detector(s)', 'Card/Code Access', 'Closed Circuit Camera(s)', 'Fire and Smoke Detection System', 'Fire Rated Drywall', 'Fire Sprinkler System', 'Firewall(s)', 'Gated Community', 'Gated with Guard', 'Guarded', 'Resident Manager', 'Security Lights', 'Security System', 'Smoke Detector(s)', 'Window Bars', 'Wired for Alarm System'];
            $parkings                 = ['None', 'Assigned', 'Auto Driveway Gate', 'Boat', 'Built-In Storage', 'Carport', 'Attached Carport', 'Detached Carport', 'Circular Driveway', 'Community Structure', 'Controlled Entrance', 'Converted Garage', 'Covered', 'Deck', 'Direct Garage Access', 'Driveway', 'Asphalt', 'Driveway - Brick', 'Driveway - Combination', 'Concrete', 'Gravel', 'Paved', 'Unpaved', 'Driveway Blind', 'Driveway Down Slope From Street', 'Driveway Level', 'Driveway Up Slope From Street', 'Garage', 'Garage Faces Front', 'Garage Faces Rear', 'Garage Faces Side', 'Garage - Single Door', 'Garage - Three Door', 'Garage - Two Door', 'Garage Door Opener', 'Gated', 'Golf Cart Garage', 'Guarded', 'Guest', 'Heated Garage', 'Metered', 'No Driveway', 'Off Site', 'Off Street', 'On Site', 'Other', 'Oversized', 'Parking Space', 'Permit Required', 'Porte-Cochere', 'Private', 'Public', 'Pull-through', 'RV Access/Parking', 'RV Covered', 'RV Garage', 'RV Gated', 'RV Hook-Ups', 'RV Potential', 'See Remarks', 'Shared Driveway', 'Side by Side', 'Street', 'Structure', 'Subterranean', 'Tandem Covered', 'Tandem Garage', 'Tandem Uncovered', 'Unassigned', 'Uncovered', 'Valet', 'Workshop in Garage', 'Electric Vehicle Charging Station(s)'];
            $spa_features             = ['None', 'Private', 'Association', 'Community', 'Above Ground', 'Bath', 'Fiberglass', 'Gunite', 'Heated', 'In Ground', 'No Permits', 'Permits', 'Roof Top', 'See Remarks', 'Solar Heated', 'Vinyl'];
            $common_walls             = ['1 Common Wall', '2+ Common Walls', 'End Unit', 'No Common Walls', 'No One Above', 'No One Below'];
            $construction_materials   = ['Adobe', 'Alcan', 'Aluminum Siding', 'Asbestos', 'Asphalt', 'Block', 'Blown-In Insulation', 'Board & Batten Siding', 'Brick', 'Brick Veneer', 'Cedar', 'Cellulose Insulation', 'Cement Siding', 'Clapboard', 'Concrete', 'Drywall Walls', 'Ducts Professionally Air-Sealed', 'Fiber Cement', 'Fiberglass Siding', 'Flagstone', 'Frame', 'Glass', 'Hardboard', 'HardiPlank Type', 'ICFs (Insulated Concrete Forms)', 'Lap Siding', 'Log', 'Log Siding', 'Masonite', 'Metal Siding', 'Natural Building', 'NES Insulation Pkg', 'Other', 'Plaster', 'Radiant Barrier', 'Rammed Earth', 'Redwood Siding', 'Shake Siding', 'Shingle Siding', 'Slump Block', 'Spray Foam Insulation', 'Steel', 'Steel Siding', 'Stone', 'Stone Veneer', 'Straw', 'Stucco', 'Synthetic Stucco', 'TVA Insulation Pkg', 'Unknown', 'Vertical Siding', 'Vinyl Siding', 'Wood Siding'];
            $roofs                    = ['Asbestos Shingle', 'Asphalt', 'Bahama', 'Barrel', 'Bitumen', 'Bituthene', 'Clay', 'Common Roof', 'Composition', 'Concrete', 'Copper', 'Elastomeric', 'Fiberglass', 'Fire Retardant', 'Flat', 'Flat Tile', 'Foam', 'Green Roof', 'Mansard', 'Membrane', 'Metal', 'Mixed', 'Other', 'Reflective', 'Ridge Vents', 'Rolled/Hot Mop', 'See Remarks', 'Shake', 'Shingle', 'Slate', 'Spanish Tile', 'Stone', 'Synthetic', 'Tar/Gravel', 'Tile', 'Wood'];
            $foundation_details       = ['Block', 'Brick/Mortar', 'Combination', 'Concrete Perimeter', 'Permanent', 'Pier Jacks', 'Pillar/Post/Pier', 'Quake Bracing', 'Raised', 'See Remarks', 'Seismic Tie Down', 'Slab', 'Stacked Block', 'Stone', 'Tie Down'];
            $waterfront_features      = ['Across the Road from Lake/Ocean', 'Bay Front', 'Beach Access', 'Beach Front', 'Canal Front', 'Creek', 'Fishing in Community', 'Includes Dock', 'Lagoon', 'Lake', 'Lake Front', 'Lake Privileges', 'Marina in Community', 'Navigable Water', 'Ocean Access', 'Ocean Front', 'Ocean Side of Freeway', 'Ocean Side Of Highway 1', 'Pond', 'Reservoir in Community', 'River Front', 'Sea Front', 'Seawall', 'Stream', 'Waterfront With Home Across Road'];
            $patio_and_porch_features = ['Arizona Room', 'Brick', 'Cabana', 'Concrete', 'Covered', 'Deck', 'Enclosed', 'Enclosed Glass Porch', 'Lanai', 'Patio', 'Patio Open', 'Porch', 'Front Porch', 'Rear Porch', 'Roof Top', 'Screened', 'Screened Porch', 'See Remarks', 'Slab', 'Stone', 'Terrace', 'Tile', 'Wood', 'Wrap Around'];
            $lot_features             = ['0-1 Unit/Acre', '2-5 Units/Acre', '6-10 Units/Acre', '11-15 Units/Acre', '16-20 Units/Acre', '21-25 Units/Acre', '26-30 Units/Acre', '31-35 Units/Acre', '36-40 Units/Acre', 'Agricultural', 'Agricultural - Dairy', 'Agricultural - Other', 'Agricultural - Row/Crop', 'Agricultural - Tree/Orchard', 'Agricultural - Vine/Vineyard', 'Back Yard', 'Bluff', 'Close to Clubhouse', 'Corner Lot', 'Corners Marked', 'Cul-De-Sac', 'Desert Back', 'Desert Front', 'Sloped Down', 'Front Yard', 'Garden', 'Gentle Sloping', 'Greenbelt', 'Horse Property', 'Horse Property Improved', 'Horse Property Unimproved', 'Landscaped', 'Lawn', 'Level with Street', 'Lot 10000-19999 Sqft', 'Lot 20000-39999 Sqft', 'Lot 6500-9999', 'Lot Over 40000 Sqft', 'Flag Lot', 'Irregular Lot', 'Rectangular Lot', 'Level', 'Misting System', 'Near Public Transit', 'No Landscaping', 'On Golf Course', 'Over 40 Units/Acre', 'Park Nearby', 'Pasture', 'Patio Home', 'Paved', 'Percolate', 'Ranch', 'Rocks', 'Rolling Slope', 'Secluded', 'Sprinkler System', 'Sprinklers Drip System', 'Sprinklers In Front', 'Sprinklers In Rear', 'Sprinklers Manual', 'Sprinklers None', 'Sprinklers On Side', 'Sprinklers Timer', 'Steep Slope', 'Tear Down', 'Treed Lot', 'Up Slope from Street', 'Utilities - Overhead', 'Value In Land', 'Walkstreet', 'Yard', 'Zero Lot Line'];
            $property_conditions      = ['Additions/Alterations', 'Building Permit', 'Fixer', 'Repairs Cosmetic', 'Repairs Major', 'Termite Clearance', 'Turnkey', 'Under Construction', 'Updated/Remodeled', 'Needs Upgrade'];
            $sewers                   = ['Aerobic Septic', 'Cesspool', 'Conventional Septic', 'Engineered Septic', 'Holding Tank', 'Mound Septic', 'Other', 'Perc Test On File', 'Perc Test Required', 'Private Sewer', 'Public Sewer', 'Septic Type Unknown', 'Sewer Applied for Permit', 'Sewer Assessments', 'Sewer On Bond', 'Sewer Paid', 'Shared Septic', 'Soils Analysis Septic', 'Unknown'];
            $water_sources            = ['Agricultural Well', 'Cistern', 'Other', 'Private', 'Public', 'See Remarks', 'Shared Well', 'Well'];
            $architectural_styles     = ['Bungalow', 'Cape Cod', 'Colonial', 'Contemporary', 'Cottage', 'Craftsman', 'Custom Built', 'English', 'French', 'Georgian', 'Log', 'Mediterranean', 'Mid Century Modern', 'Modern', 'Ranch', 'See Remarks', 'Shotgun', 'Spanish', 'Traditional', 'Tudor', 'Victorian'];
            $community_features       = ['Biking', 'BLM/National Forest', 'Curbs', 'Dog Park', 'Fishing', 'Foothills', 'Golf', 'Hiking', 'Gutters', 'Lake', 'Horse Trails', 'Park', 'Hunting', 'Watersports', 'Military Land', 'Mountainous', 'Preserve/Public Land', 'Ravine', 'Stable(s)', 'Rural', 'Sidewalks', 'Storm Drains', 'Street Lights', 'Suburban', 'Urban', 'Valley'];
            $road_frontage_types      = ['Access is Seasonal', 'Alley', 'City Street', 'Country Road', 'County Road', 'Highway', 'Private Road'];
            $road_surface_types       = ['Alley Paved', 'Gravel', 'Maintained', 'Not Maintained', 'Paved', 'Unpaved'];
            $disclosures              = ['Accessory Dwelling Unit', '3rd Party Rights', 'Bankruptcy', 'Beach Rights', 'Cautions Call Agent', "CC And R's", 'City Inspection Required', 'Coastal Commission Restrictions', 'Coastal Zone', 'Conditional Use Permit', 'Court Confirmation', 'Death On Property < 3 yrs', 'Earthquake Insurance Available', 'Easements', 'Environmental Restrictions', 'Exclusions Call Agent', 'Flood Insurance Required', 'Flood Zone', 'HERO/PACE Loan', 'Historical', 'Home Warranty', 'Homeowners Association', 'Incorporated', 'LA/Owner Related', 'Licensed Vacation Rental', 'Listing Broker Advantage', 'Manufactured Homes Allowed', 'Methane Gas', 'Mineral Rights', 'Moratorium', 'No Lake Rights', 'Oil Rights', 'Open Space Restrictions', 'Pet Restrictions', 'Principal Is RE Licensed', 'Private Transfer Taxes', 'Property Report', 'REAP', 'Redevelopment Area', 'Rent Control', 'Section 8 Approved', 'Seismic Hazard', 'Seller Will Pay Sec. 1 Termite', 'Slide Zone', 'Special Study Area', 'Subject To Estate Ruling', 'Tenants In Common - DRE Pink', 'Tenants In Common - DRE White', 'Unincorporated', 'Water Rights', 'Well Log Available'];
            $exterior_features        = ['Awning(s)', 'Barbecue Private', 'Boat Lift', 'Boat Slip', 'Corral', 'Dock Private', 'Kennel', 'Koi Pond', 'Lighting', 'Pier', 'Rain Gutters', 'Satellite Dish', 'Stable', 'TV Antenna'];
            $other_structures         = ['Airplane Hangar', 'Aviary', 'Barn(s)', 'Gazebo', 'Greenhouse', 'Guest House', 'Guest House Attached', 'Guest House Detached', 'Outbuilding', 'Sauna Private', 'Second Garage', 'Second Garage Attached', 'Second Garage Detached', 'Shed(s)', 'Sport Court Private', 'Storage', 'Tennis Court Private', 'Two On A Lot', 'Workshop'];
            $window_features          = ['Atrium', 'Bay Window(s)', 'Blinds', 'Casement Windows', 'Custom Covering', 'Double Pane Windows', 'Drapes', 'ENERGY STAR Qualified Windows', 'French/Mullioned', 'Garden Window(s)', 'Insulated Windows', 'Jalousies/Louvered', 'Low Emissivity Windows', 'Palladian', 'Plantation Shutters', 'Roller Shields', 'Screens', 'Shutters', 'Skylight(s)', 'Solar Screens', 'Solar Tinted Windows', 'Stained Glass', 'Storm Window(s)', 'Tinted Windows', 'Triple Pane Windows', 'Wood Frames'];

            $property_data = get_post_meta( $post_id, 'property_data', true );

            $address_1 = get_post_meta( $post->ID, '_address_1', true ) != '' ? get_post_meta( $post->ID, '_address_1', true ) . ', ' : '';
            $address_2 = get_post_meta( $post->ID, '_address_2', true ) != '' ? get_post_meta( $post->ID, '_address_2', true ) . ', ' : '';
            $city      = get_post_meta( $post->ID, '_city', true ) != '' ? get_post_meta( $post->ID, '_city', true ) . ', ' : '';
            $state     = get_post_meta( $post->ID, '_state', true ) != '' ? get_post_meta( $post->ID, '_state', true ) . ', ' : '';
            $zip       = get_post_meta( $post->ID, '_zip_code', true ) != '' ? get_post_meta( $post->ID, '_zip_code', true ) : '';

            $post_title = ucwords( $address_1 ) . ucwords( $address_2 ) . ucwords( $city ) . ucwords( $state ) . $zip;

        //echo '<pre>';
            //var_dump( get_post_meta( $post_id ) );

        ?>


    <div class="container">
        <!-- Grid row -->
        <div class="row pt-5 d-flex justify-content-center step-card">

            <!-- Grid column -->
            <div class="col-md-3 pl-5 pl-md-0 pb-5 step-nav">
                <!-- Stepper -->
                <div class="steps-form-3">
                    <div class="steps-row-3 setup-panel-3 d-flex justify-content-between">
                        <div class="steps-step-3">
                            <a href="#step-1" type="button" class="btn btn-info btn-circle-3 waves-effect ml-0"
                                data-toggle="tooltip" data-placement="top" title="Location"><i class="fa fa-street-view"
                                    aria-hidden="true"></i>Location</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-2" type="button" class="btn btn-pink btn-circle-3 waves-effect p-3"
                                data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-home"
                                    aria-hidden="true"></i>Details</a>

                        </div>
                        <div class="steps-step-3">
                            <a href="#step-3" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Contact"><i class="fa fa-id-card"
                                    aria-hidden="true"></i>Contact</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-4" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Utilities & Features"><i
                                    class="fa fa-th" aria-hidden="true"></i>Utilities & Features</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-5" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Photos"><i class="fa fa-picture-o"
                                    aria-hidden="true"></i>Photos</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-6" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Video"><i class="fa fa-file-video-o"
                                    aria-hidden="true"></i>Video</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-7" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Description"><i
                                    class="fa fa-map-signs" aria-hidden="true"></i>Description</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-8" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Asking Price"><i
                                    class="fas fa-file-invoice-dollar" aria-hidden="true"></i>Asking Price</a>
                        </div>
                        <div class="steps-step-3 no-height">
                            <a href="#step-9" type="button" class="btn btn-pink btn-circle-3 waves-effect p-3"
                                data-toggle="tooltip" data-placement="top" title="Post Your Listing"><i
                                    class="fa fa-laptop" aria-hidden="true"></i>Post Your Listing</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-7">

                <!-- First Step -->
                <div class="row setup-content-3" id="step-1">
                    <div class="col-md-12">
                        <h3 class="font-weight-bold pl-0 my-4"><strong>What's the Address of the Home for
                                Sale?</strong>
                        </h3>
                        <div class="form-group md-form">
                            <label for="address_1" data-error="wrong" data-success="right">Address Line 1
                            </label>
                            <input id="address_1" type="text" name="address[address_1]"
                                placeholder="Address Line 1" " class=" form-control validate"
                                value="<?php echo $property_data['address']['address_1']; ?>">
                        </div>
                        <div class="form-group md-form">
                            <label for="address_2" data-error="wrong" data-success="right">Address Line 2
                            </label>
                            <input id="address_2" type="text" name="address[address_2]"
                                placeholder="Apartment, Unit Number, Etc" class="form-control validate"
                                value="<?php echo $property_data['address']['address_2']; ?>">
                        </div>
                        <div class="form-group md-form mt-3">
                            <label for="city" data-error="wrong" data-success="right">City</label>
                            <input id="city" type="text" name="address[city]" placeholder="City" "
                                    class=" form-control validate"
                                value="<?php echo $property_data['address']['city']; ?>">

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group md-form mt-3">
                                    <label for="state" data-error="wrong" data-success="right">State</label>
                                    <select id="state" name="address[state]" "
                                            class=" form-control validate">

                                        <?php

                                            foreach ( $states as $key => $state ) {?>

                                        <option value="<?php echo $state; ?>"
                                            <?php echo $property_data['address']['state'] === $state ? 'selected' : ''; ?>>
                                            <?php echo $state; ?></option>

                                        <?php }

                                            ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group md-form mt-3">
                                    <label for="zip_code" data-error="wrong" data-success="right">Zip Code</label>
                                    <input id="zip_code" type="text" name="address[zip_code]"
                                        placeholder="Zip Code" " class=" form-control validate"
                                        value="<?php echo $property_data['address']['zip_code']; ?>">
                                </div>
                            </div>
                        </div>

                        <input type="submit" id="submit-first-btn" class="btn dokan-btn-theme dokan-btn-lg ajax-update"
                            value="Next" />
                    </div>
                </div>


                <!-- Second Step -->
                <div class="row setup-content-3" id="step-2">
                    <div class="col-md-12">

                        <h3 class="font-weight-bold pl-0 my-4"><strong>Provide Some Important Home Details</strong>
                        </h3>

                        <div class="form-group md-form dokan-auction-post-title">
                            <input type="hidden" name="dokan_product_id" value="<?php echo $post_id; ?>">
                            <input type="hidden" id="post_title" name="post_title" value="<?php echo $post_title; ?>">
                        </div>

                        <div class="form-group md-form">
                        </div>
                        <div class="form-group md-form">
                            <label for="property_type" data-error="wrong" data-success="right">Property Type</label>
                            <select id="property_type" name="home_details[property_type]" "
                                    class=" form-control validate">
                                <?php

                                    foreach ( $property_types as $key => $property_type ) {?>

                                <option value="<?php echo $property_type; ?>"
                                    <?php echo $property_data['home_details']['property_type'] === $property_type ? 'selected' : ''; ?>>
                                    <?php echo $property_type; ?></option>

                                <?php }

                                    ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group md-form mt-3">
                                    <label for="home_size" data-error="wrong" data-success="right">Home Size
                                        (SqFt)</label>
                                    <input step="any" id="home_size" type="number" name="home_details[home_size]"
                                        placeholder="SqFt" class="form-control validate"
                                        value="<?php echo $property_data['home_details']['home_size']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group md-form mt-3">

                                    <select id="lot_size" type="checkmark" name="home_details[lot_unit]">

                                        <option value="sqft"
                                            <?php echo ( $property_data['home_details']['lot_unit'] == 'sqft' ) ? 'selected' : ''; ?>>
                                            SqFt</option>

                                        <option value="acres"
                                            <?php echo ( $property_data['home_details']['lot_unit'] == 'acres' ) ? 'selected' : ''; ?>>
                                            Acres</option>


                                    </select>
                                    <label for="lot_size" data-error="wrong" data-success="right">Lot Size</label>
                                    <input step="any" id="lot_size" type="number" name="home_details[lot_size]"
                                        placeholder="SqFt" class="form-control validate"
                                        value="<?php echo $property_data['home_details']['lot_size']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group md-form mt-3">
                                    <label for="home_details[year_built]" data-error="wrong" data-success="right">Year
                                        Built</label>
                                    <input id="year_built" type="text" name="home_details[year_built]"
                                        placeholder="Year Built" class="year form-control validate"
                                        value="<?php echo $property_data['home_details']['year_built']; ?>">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group md-form mt-3">
                                    <label for="bedrooms" data-error="wrong" data-success="right">Bedrooms</label>
                                    <input step="any" id="bedrooms" type="number" name="home_details[bedrooms]"
                                        placeholder="Bedrooms" class="form-control validate"
                                        value="<?php echo $property_data['home_details']['bedrooms']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group md-form mt-3">
                                    <label for="bathrooms" data-error="wrong" data-success="right">Bathrooms</label>
                                    <input step="any" id="bathrooms" type="number" name="home_details[bathrooms]"
                                        placeholder="bathrooms" class="form-control validate"
                                        value="<?php echo $property_data['home_details']['bathrooms']; ?>">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group md-form mt-3">
                                    <label for="half_bathrooms" data-error="wrong" data-success="right">Half
                                        Bathrooms</label>
                                    <input step="any" id="half_bathrooms" type="number"
                                        name="home_details[half_bathrooms]" placeholder="Half Bathrooms"
                                        value="<?php echo $property_data['home_details']['half_bathrooms']; ?>"
                                        class="form-control validate">
                                </div>
                            </div>
                        </div>




                        <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                        <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                    </div>
                </div>


                <!-- Third Step -->
                <div class="row setup-content-3" id="step-3">
                    <div class="col-md-12">
                        <h3 class="font-weight-bold pl-0 my-4"><strong>Connect with Buyers</strong></h3>

                        <div class="form-group md-form">
                            <label for="name" data-error="wrong" data-success="right">Contact Name</label>
                            <input id="name" type="text" name="contact[name]" placeholder="Contact Name" " class="
                                form-control validate" value="<?php echo $property_data['contact']['name']; ?>">
                        </div>
                        <div class="form-group md-form">
                            <label for="email" data-error="wrong" data-success="right">Contact Email</label>
                            <input id="email" type="text" name="contact[email]" placeholder="Contact Email" " class="
                                form-control validate" value="<?php echo $property_data['contact']['email']; ?>">
                        </div>
                        <div class="form-group md-form">
                            <label for="number" data-error="wrong" data-success="right">Contact Number</label>
                            <input id="number" type="phone" name="contact[number]"
                                placeholder="(800) 555-5555" " class=" form-control validate"
                                value="<?php echo $property_data['contact']['number']; ?>">
                        </div>

                        <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                        <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                    </div>
                </div>


                <!-- Fourth Step -->
                <div class="row setup-content-3" id="step-4">
                    <div class="col-md-12">
                        <h3 class="font-weight-bold pl-0 my-4"><strong>Promote Your Home Features</strong></h3>
                        <div class="row">
                            <div class="font-display features-heading">Interior Features</div>

                        </div>
                        <div class="row">
                            <div class="font-display">Interior Features</div>

                            <?php

                                foreach ( $interior_features as $key => $interior_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[interior_features][<?php echo $key; ?>]"
                                        data-error="wrong" data-success="right"><?php echo $interior_feature; ?></label>

                                    <input type="checkbox" id="home_features[interior_features][<?php echo $key; ?>]"
                                        name="home_features[interior_features][<?php echo $key; ?>]"
                                        value="<?php echo $interior_feature; ?>"
                                        class="interior_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['interior_features'] ) ): echo in_array( $interior_feature, $property_data['home_features']['interior_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>

                        </div>

                        <div class="row">

                            <div class="font-display" id="basements">Basements</div>

                            <?php

                                foreach ( $basements as $key => $basement ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[basements][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $basement; ?></label>

                                    <input type="checkbox" id="home_features[basements][<?php echo $key; ?>]"
                                        name="home_features[basements][<?php echo $key; ?>]"
                                        value="<?php echo $basement; ?>" class="basements form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['basements'] ) ): echo in_array( $basement, $property_data['home_features']['basements'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>


                        <div class="row">

                            <div class="font-display" id="fireplaces">Fireplaces</div>

                            <?php

                                foreach ( $fireplaces as $key => $fireplace ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[fireplaces][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $fireplace; ?></label>

                                    <input type="checkbox" id="home_features[fireplaces][<?php echo $key; ?>]"
                                        name="home_features[fireplaces][<?php echo $key; ?>]"
                                        value="<?php echo $fireplace; ?>" class="fireplaces form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['fireplaces'] ) ): echo in_array( $fireplace, $property_data['home_features']['fireplaces'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>


                        <div class="row">

                            <div class="font-display" id="coolings">Coolings <span>(1 or more boxes required to be
                                    checked)</span></div>

                            <?php

                                foreach ( $coolings as $key => $cooling ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[coolings][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $cooling; ?></label>

                                    <input type="checkbox" id="home_features[coolings][<?php echo $key; ?>]"
                                        name="home_features[coolings][<?php echo $key; ?>]"
                                        value="<?php echo $cooling; ?>" class="coolings form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['coolings'] ) ): echo in_array( $cooling, $property_data['home_features']['coolings'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>

                        <div class="row">

                            <div class="font-display" id="heatings">Heatings</div>

                            <?php

                                foreach ( $heatings as $key => $heating ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[heatings][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $heating; ?></label>

                                    <input type="checkbox" id="home_features[heatings][<?php echo $key; ?>]"
                                        name="home_features[heatings][<?php echo $key; ?>]"
                                        value="<?php echo $heating; ?>" class="heatings form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['heatings'] ) ): echo in_array( $heating, $property_data['home_features']['heatings'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>


                        <div class="row">

                            <div class="font-display" id="accessibility_features">Accessibility Features (*require at
                                least 3 box checked)</div>

                            <?php

                                foreach ( $accessibility_features as $key => $accessibility_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[accessibility_features][<?php echo $key; ?>]"
                                        data-error="wrong"
                                        data-success="right"><?php echo $accessibility_feature; ?></label>

                                    <input type="checkbox"
                                        id="home_features[accessibility_features][<?php echo $key; ?>]"
                                        name="home_features[accessibility_features][<?php echo $key; ?>]"
                                        value="<?php echo $accessibility_feature; ?>"
                                        class="accessibility_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['accessibility_features'] ) ): echo in_array( $accessibility_feature, $property_data['home_features']['accessibility_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>

                        <div class="row">

                            <div class="font-display" id="kitchen_features">Kitchen Features (*require at least 1 box
                                checked)</div>
                            <?php

                                foreach ( $kitchen_features as $key => $kitchen_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[kitchen_features][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $kitchen_feature; ?></label>

                                    <input type="checkbox" id="home_features[kitchen_features][<?php echo $key; ?>]"
                                        name="home_features[kitchen_features][<?php echo $key; ?>]"
                                        value="<?php echo $kitchen_feature; ?>"
                                        class="kitchen_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['kitchen_features'] ) ): echo in_array( $kitchen_feature, $property_data['home_features']['kitchen_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>


                        <div class="row">

                            <div class="font-display" id="floorings">Floorings</div>

                            <?php

                                foreach ( $floorings as $key => $flooring ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[floorings][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $flooring; ?></label>

                                    <input type="checkbox" id="home_features[floorings][<?php echo $key; ?>]"
                                        name="home_features[floorings][<?php echo $key; ?>]"
                                        value="<?php echo $flooring; ?>" class="floorings form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['floorings'] ) ): echo in_array( $flooring, $property_data['home_features']['floorings'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>

                        <div class="row">

                            <div class="font-display" id="appliances">Appliances <span>(3 or more boxes required to be
                                    checked)</span></div>

                            <?php

                                foreach ( $appliances as $key => $appliance ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[appliances][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $appliance; ?></label>

                                    <input type="checkbox" id="home_features[appliances][<?php echo $key; ?>]"
                                        name="home_features[appliances][<?php echo $key; ?>]"
                                        value="<?php echo $appliance; ?>" class="appliances form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['appliances'] ) ): echo in_array( $appliance, $property_data['home_features']['appliances'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>

                        <div class="row">

                            <div class="font-display" id="bathroom_features">Bathroom Features (*require at least 1 box
                                checked)</div>
                            <?php

                                foreach ( $bathroom_features as $key => $bathroom_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[bathroom_features][<?php echo $key; ?>]"
                                        data-error="wrong" data-success="right"><?php echo $bathroom_feature; ?></label>

                                    <input type="checkbox" id="home_features[bathroom_features][<?php echo $key; ?>]"
                                        name="home_features[bathroom_features][<?php echo $key; ?>]"
                                        value="<?php echo $bathroom_feature; ?>"
                                        class="bathroom_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['bathroom_features'] ) ): echo in_array( $bathroom_feature, $property_data['home_features']['bathroom_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>

                        <div class="row">

                            <div class="font-display" id="eating_areas">Eating Areas</div>

                            <?php

                                foreach ( $eating_areas as $key => $eating_area ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[eating_areas][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $eating_area; ?></label>

                                    <input type="checkbox" id="home_features[eating_areas][<?php echo $key; ?>]"
                                        name="home_features[eating_areas][<?php echo $key; ?>]"
                                        value="<?php echo $eating_area; ?>"
                                        class="eating_areas form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['eating_areas'] ) ): echo in_array( $eating_area, $property_data['home_features']['eating_areas'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>


                        <div class="row">

                            <div class="font-display" id="electrics">Electrics <span>(1 or more boxes required to be
                                    checked)</span></div>

                            <?php

                                foreach ( $electrics as $key => $electric ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[electrics][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $electric; ?></label>

                                    <input type="checkbox" id="home_features[electrics][<?php echo $key; ?>]"
                                        name="home_features[electrics][<?php echo $key; ?>]"
                                        value="<?php echo $electric; ?>" class="electrics form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['electrics'] ) ): echo in_array( $electric, $property_data['home_features']['electrics'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>

                        <div class="row">

                            <div class="font-display" id="laundries">Laundries <span>(1 or more boxes required to be
                                    checked)</span></div>

                            <?php

                                foreach ( $laundries as $key => $laundry ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[laundries][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $laundry; ?></label>

                                    <input type="checkbox" id="home_features[laundries][<?php echo $key; ?>]"
                                        name="home_features[laundries][<?php echo $key; ?>]"
                                        value="<?php echo $laundry; ?>" class="laundries form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['laundries'] ) ): echo in_array( $laundry, $property_data['home_features']['laundries'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>


                        <div class="row">

                            <div class="font-display" id="room_types">Room Types <span>(2 or more boxes required to be
                                    checked)</span></div>
                            <?php

                                foreach ( $room_types as $key => $room_type ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[room_types][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $room_type; ?></label>

                                    <input type="checkbox" id="home_features[room_types][<?php echo $key; ?>]"
                                        name="home_features[room_types][<?php echo $key; ?>]"
                                        value="<?php echo $room_type; ?>" class="room_types form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['room_types'] ) ): echo in_array( $room_type, $property_data['home_features']['room_types'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>

                        <div class="row">

                            <div class="font-display" id="utilities">Utilities <span>(1 or more boxes required to be
                                    checked)</span></div>
                            <?php

                                foreach ( $utilities as $key => $utility ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[utilities][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $utility; ?></label>

                                    <input type="checkbox" id="home_features[utilities][<?php echo $key; ?>]"
                                        name="home_features[utilities][<?php echo $key; ?>]"
                                        value="<?php echo $utility; ?>" class="utilities form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['utilities'] ) ): echo in_array( $utility, $property_data['home_features']['utilities'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>

                        </div>

                        <div class="row">
                            <div class="font-display features-heading">Exterior Features</div>
                        </div>

                        <div class="row">
                            <div class="font-display" id="pool_features">Pool Features</div>
                            <?php

                                foreach ( $pool_features as $key => $pool_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[pool_features][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $pool_feature; ?></label>

                                    <input type="checkbox" id="home_features[pool_features][<?php echo $key; ?>]"
                                        name="home_features[pool_features][<?php echo $key; ?>]"
                                        value="<?php echo $pool_feature; ?>"
                                        class="pool_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['pool_features'] ) ): echo in_array( $pool_feature, $property_data['home_features']['pool_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="views">Views</div>
                            <?php

                                foreach ( $views as $key => $view ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[views][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $view; ?></label>

                                    <input type="checkbox" id="home_features[views][<?php echo $key; ?>]"
                                        name="home_features[views][<?php echo $key; ?>]" value="<?php echo $view; ?>"
                                        class="views form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['views'] ) ): echo in_array( $view, $property_data['home_features']['views'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="door_features">Door Features</div>
                            <?php

                                foreach ( $door_features as $key => $door_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[door_features][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $door_feature; ?></label>

                                    <input type="checkbox" id="home_features[door_features][<?php echo $key; ?>]"
                                        name="home_features[door_features][<?php echo $key; ?>]"
                                        value="<?php echo $door_feature; ?>"
                                        class="door_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['door_features'] ) ): echo in_array( $door_feature, $property_data['home_features']['door_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="fencings">Fencings <span>(1 or more boxes required to be
                                    checked)</span></div>
                            <?php

                                foreach ( $fencings as $key => $fencing ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[fencings][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $fencing; ?></label>

                                    <input type="checkbox" id="home_features[fencings][<?php echo $key; ?>]"
                                        name="home_features[fencings][<?php echo $key; ?>]"
                                        value="<?php echo $fencing; ?>" class="fencings form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['fencings'] ) ): echo in_array( $fencing, $property_data['home_features']['fencings'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="security_features">Security Features</div>
                            <?php

                                foreach ( $security_features as $key => $security_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[security_features][<?php echo $key; ?>]"
                                        data-error="wrong" data-success="right"><?php echo $security_feature; ?></label>

                                    <input type="checkbox" id="home_features[security_features][<?php echo $key; ?>]"
                                        name="home_features[security_features][<?php echo $key; ?>]"
                                        value="<?php echo $security_feature; ?>"
                                        class="security_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['security_features'] ) ): echo in_array( $security_feature, $property_data['home_features']['security_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="parkings">Parkings <span>(1 or more boxes required to be
                                    checked)</span></div>
                            <?php

                                foreach ( $parkings as $key => $parking ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[parkings][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $parking; ?></label>

                                    <input type="checkbox" id="home_features[parkings][<?php echo $key; ?>]"
                                        name="home_features[parkings][<?php echo $key; ?>]"
                                        value="<?php echo $parking; ?>" class="parkings form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['parkings'] ) ): echo in_array( $parking, $property_data['home_features']['parkings'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="spa_features">Spa Features</div>
                            <?php

                                foreach ( $spa_features as $key => $spa_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[spa_features][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $spa_feature; ?></label>

                                    <input type="checkbox" id="home_features[spa_features][<?php echo $key; ?>]"
                                        name="home_features[spa_features][<?php echo $key; ?>]"
                                        value="<?php echo $spa_feature; ?>"
                                        class="spa_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['spa_features'] ) ): echo in_array( $spa_feature, $property_data['home_features']['spa_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="common_walls">Common Walls <span>(1 or more boxes required to
                                    be checked)</span>
                            </div>
                            <?php

                                foreach ( $common_walls as $key => $common_wall ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[common_walls][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $common_wall; ?></label>

                                    <input type="checkbox" id="home_features[common_walls][<?php echo $key; ?>]"
                                        name="home_features[common_walls][<?php echo $key; ?>]"
                                        value="<?php echo $common_wall; ?>"
                                        class="common_walls form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['common_walls'] ) ): echo in_array( $common_wall, $property_data['home_features']['common_walls'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="construction_materials">Construction Materials (*require at
                                least 1 box checked)</div>
                            <?php

                                foreach ( $construction_materials as $key => $construction_material ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[construction_materials][<?php echo $key; ?>]"
                                        data-error="wrong"
                                        data-success="right"><?php echo $construction_material; ?></label>

                                    <input type="checkbox"
                                        id="home_features[construction_materials][<?php echo $key; ?>]"
                                        name="home_features[construction_materials][<?php echo $key; ?>]"
                                        value="<?php echo $construction_material; ?>"
                                        class="construction_materials form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['construction_materials'] ) ): echo in_array( $construction_material, $property_data['home_features']['construction_materials'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="roofs">Roofs <span>(1 or more boxes required to be
                                    checked)</span></div>
                            <?php

                                foreach ( $roofs as $key => $roof ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[roofs][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $roof; ?></label>

                                    <input type="checkbox" id="home_features[roofs][<?php echo $key; ?>]"
                                        name="home_features[roofs][<?php echo $key; ?>]" value="<?php echo $roof; ?>"
                                        class="roofs form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['roofs'] ) ): echo in_array( $roof, $property_data['home_features']['roofs'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="foundation_details">Foundation Details (*require at least 1
                                box checked)</div>
                            <?php

                                foreach ( $foundation_details as $key => $foundation_detail ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[foundation_details][<?php echo $key; ?>]"
                                        data-error="wrong"
                                        data-success="right"><?php echo $foundation_detail; ?></label>

                                    <input type="checkbox" id="home_features[foundation_details][<?php echo $key; ?>]"
                                        name="home_features[foundation_details][<?php echo $key; ?>]"
                                        value="<?php echo $foundation_detail; ?>"
                                        class="foundation_details form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['foundation_details'] ) ): echo in_array( $foundation_detail, $property_data['home_features']['foundation_details'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="waterfront_features">Waterfront Features</div>
                            <?php

                                foreach ( $waterfront_features as $key => $waterfront_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[waterfront_features][<?php echo $key; ?>]"
                                        data-error="wrong"
                                        data-success="right"><?php echo $waterfront_feature; ?></label>

                                    <input type="checkbox" id="home_features[waterfront_features][<?php echo $key; ?>]"
                                        name="home_features[waterfront_features][<?php echo $key; ?>]"
                                        value="<?php echo $waterfront_feature; ?>"
                                        class="waterfront_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['waterfront_features'] ) ): echo in_array( $waterfront_feature, $property_data['home_features']['waterfront_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="patio_and_porch_features">Patio and Porch Features</div>
                            <?php

                                foreach ( $patio_and_porch_features as $key => $patio_and_porch_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[patio_and_porch_features][<?php echo $key; ?>]"
                                        data-error="wrong"
                                        data-success="right"><?php echo $patio_and_porch_feature; ?></label>

                                    <input type="checkbox"
                                        id="home_features[patio_and_porch_features][<?php echo $key; ?>]"
                                        name="home_features[patio_and_porch_features][<?php echo $key; ?>]"
                                        value="<?php echo $patio_and_porch_feature; ?>"
                                        class="patio_and_porch_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['patio_and_porch_features'] ) ): echo in_array( $patio_and_porch_feature, $property_data['home_features']['patio_and_porch_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="lot_features">Lot Features <span>(1 or more boxes required to
                                    be checked)</span>
                            </div>
                            <?php

                                foreach ( $lot_features as $key => $lot_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[lot_features][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $lot_feature; ?></label>

                                    <input type="checkbox" id="home_features[lot_features][<?php echo $key; ?>]"
                                        name="home_features[lot_features][<?php echo $key; ?>]"
                                        value="<?php echo $lot_feature; ?>"
                                        class="lot_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['lot_features'] ) ): echo in_array( $lot_feature, $property_data['home_features']['lot_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="property_conditions">Property Conditions (*require at least 1
                                box checked)</div>
                            <?php

                                foreach ( $property_conditions as $key => $property_condition ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[property_conditions][<?php echo $key; ?>]"
                                        data-error="wrong"
                                        data-success="right"><?php echo $property_condition; ?></label>

                                    <input type="checkbox" id="home_features[property_conditions][<?php echo $key; ?>]"
                                        name="home_features[property_conditions][<?php echo $key; ?>]"
                                        value="<?php echo $property_condition; ?>"
                                        class="property_conditions form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['property_conditions'] ) ): echo in_array( $property_condition, $property_data['home_features']['property_conditions'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="sewers">Sewers <span>(1 or more boxes required to be
                                    checked)</span></div>
                            <?php

                                foreach ( $sewers as $key => $sewer ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[sewers][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $sewer; ?></label>

                                    <input type="checkbox" id="home_features[sewers][<?php echo $key; ?>]"
                                        name="home_features[sewers][<?php echo $key; ?>]" value="<?php echo $sewer; ?>"
                                        class="sewers form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['sewers'] ) ): echo in_array( $sewer, $property_data['home_features']['sewers'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="water_sources">Water Sources <span>(1 or more boxes required
                                    to be checked)</span>
                            </div>
                            <?php

                                foreach ( $water_sources as $key => $water_source ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[water_sources][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $water_source; ?></label>

                                    <input type="checkbox" id="home_features[water_sources][<?php echo $key; ?>]"
                                        name="home_features[water_sources][<?php echo $key; ?>]"
                                        value="<?php echo $water_source; ?>"
                                        class="water_sources form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['water_sources'] ) ): echo in_array( $water_source, $property_data['home_features']['water_sources'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="architectural_styles">Architectural Styles</div>
                            <?php

                                foreach ( $architectural_styles as $key => $architectural_style ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[architectural_styles][<?php echo $key; ?>]"
                                        data-error="wrong"
                                        data-success="right"><?php echo $architectural_style; ?></label>

                                    <input type="checkbox" id="home_features[architectural_styles][<?php echo $key; ?>]"
                                        name="home_features[architectural_styles][<?php echo $key; ?>]"
                                        value="<?php echo $architectural_style; ?>"
                                        class="architectural_styles form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['architectural_styles'] ) ): echo in_array( $architectural_style, $property_data['home_features']['architectural_styles'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="community_features">Community Features (*require at least 1
                                box checked)</div>
                            <?php

                                foreach ( $community_features as $key => $community_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[community_features][<?php echo $key; ?>]"
                                        data-error="wrong"
                                        data-success="right"><?php echo $community_feature; ?></label>

                                    <input type="checkbox" id="home_features[community_features][<?php echo $key; ?>]"
                                        name="home_features[community_features][<?php echo $key; ?>]"
                                        value="<?php echo $community_feature; ?>"
                                        class="community_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['community_features'] ) ): echo in_array( $community_feature, $property_data['home_features']['community_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="road_frontage_types">Road Frontage Types</div>
                            <?php

                                foreach ( $road_frontage_types as $key => $road_frontage_type ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[road_frontage_types][<?php echo $key; ?>]"
                                        data-error="wrong"
                                        data-success="right"><?php echo $road_frontage_type; ?></label>

                                    <input type="checkbox" id="home_features[road_frontage_types][<?php echo $key; ?>]"
                                        name="home_features[road_frontage_types][<?php echo $key; ?>]"
                                        value="<?php echo $road_frontage_type; ?>"
                                        class="road_frontage_types form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['road_frontage_types'] ) ): echo in_array( $road_frontage_type, $property_data['home_features']['road_frontage_types'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="road_surface_types">Road Surface Types</div>
                            <?php

                                foreach ( $road_surface_types as $key => $road_surface_type ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[road_surface_types][<?php echo $key; ?>]"
                                        data-error="wrong"
                                        data-success="right"><?php echo $road_surface_type; ?></label>

                                    <input type="checkbox" id="home_features[road_surface_types][<?php echo $key; ?>]"
                                        name="home_features[road_surface_types][<?php echo $key; ?>]"
                                        value="<?php echo $road_surface_type; ?>"
                                        class="road_surface_types form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['road_surface_types'] ) ): echo in_array( $road_surface_type, $property_data['home_features']['road_surface_types'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="disclosures">Disclosures</div>
                            <?php

                                foreach ( $disclosures as $key => $disclosure ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[disclosures][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $disclosure; ?></label>

                                    <input type="checkbox" id="home_features[disclosures][<?php echo $key; ?>]"
                                        name="home_features[disclosures][<?php echo $key; ?>]"
                                        value="<?php echo $disclosure; ?>" class="disclosures form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['disclosures'] ) ): echo in_array( $disclosure, $property_data['home_features']['disclosures'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="exterior_features">Exterior Features</div>
                            <?php

                                foreach ( $exterior_features as $key => $exterior_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[exterior_features][<?php echo $key; ?>]"
                                        data-error="wrong" data-success="right"><?php echo $exterior_feature; ?></label>

                                    <input type="checkbox" id="home_features[exterior_features][<?php echo $key; ?>]"
                                        name="home_features[exterior_features][<?php echo $key; ?>]"
                                        value="<?php echo $exterior_feature; ?>"
                                        class="exterior_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['exterior_features'] ) ): echo in_array( $exterior_feature, $property_data['home_features']['exterior_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="other_structures">Other Structures</div>
                            <?php

                                foreach ( $other_structures as $key => $other_structure ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[other_structures][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $other_structure; ?></label>

                                    <input type="checkbox" id="home_features[other_structures][<?php echo $key; ?>]"
                                        name="home_features[other_structures][<?php echo $key; ?>]"
                                        value="<?php echo $other_structure; ?>"
                                        class="other_structures form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['other_structures'] ) ): echo in_array( $other_structure, $property_data['home_features']['other_structures'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>
                        <div class="row">
                            <div class="font-display" id="window_features">Window Features</div>
                            <?php

                                foreach ( $window_features as $key => $window_feature ) {?>
                            <div class="col-md-4">
                                <div class="form-check md-form mt-3">
                                    <label for="home_features[window_features][<?php echo $key; ?>]" data-error="wrong"
                                        data-success="right"><?php echo $window_feature; ?></label>

                                    <input type="checkbox" id="home_features[window_features][<?php echo $key; ?>]"
                                        name="home_features[window_features][<?php echo $key; ?>]"
                                        value="<?php echo $window_feature; ?>"
                                        class="window_features form-check-input validate"
                                        <?php

                                                if ( ! is_null( $property_data['home_features']['window_features'] ) ): echo in_array( $window_feature, $property_data['home_features']['window_features'] ) ? 'checked' : '';endif;?>>

                                </div>
                            </div>

                            <?php }

                                ?>
                        </div>



                        <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                        <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update features-tab"
                            value="Next" />
                    </div>
                </div>

                <!-- Fifth Step Upload Your Home Photos-->
                <div class="row setup-content-3" id="step-5">
                    <div class="col-md-12">
                        <h3 class="font-weight-bold pl-0 my-4"><strong>Upload Your Home Photos</strong></h3>
                        <div class="product-edit-container">

                            <div class="featured">
                                <div class="dokan-feat-image-upload">
                                    <?php
                                        $wrap_class        = ' dokan-hide';
                                            $instruction_class = '';
                                            $feat_image_id     = 0;

                                            if ( has_post_thumbnail( $post_id ) ) {
                                                $wrap_class        = '';
                                                $instruction_class = ' dokan-hide';
                                                $feat_image_id     = get_post_thumbnail_id( $post_id );
                                            }

                                        ?>

                                    <div class="instruction-inside<?php echo $instruction_class; ?>">
                                        <input type="hidden" name="feat_image_id" class="dokan-feat-image-id"
                                            value="<?php echo $feat_image_id; ?>">

                                        <i class="fa fa-cloud-upload"></i>
                                        <a href="#"
                                            class="dokan-feat-image-btn btn btn-sm"><?php _e( 'Upload a product cover image', 'dokan' );?></a>
                                    </div>

                                    <div class="image-wrap<?php echo $wrap_class; ?>">
                                        <a class="close dokan-remove-feat-image">&times;</a>
                                        <?php

                                            if ( $feat_image_id ) {?>
                                        <?php echo get_the_post_thumbnail( $post_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array( 'height' => '', 'width' => '' ) ); ?>
                                        <?php } else {?>
                                        <img height="" width="" src="" alt="">
                                        <?php }

                                            ?>
                                    </div>
                                </div>
                                <div class="dokan-product-gallery">
                                    <div class="dokan-side-body" id="dokan-product-images">
                                        <div id="product_images_container">
                                            <ul class="product_images dokan-clearfix">
                                                <?php
                                                    $product_images = get_post_meta( $post_id, '_product_image_gallery', true );
                                                        $gallery        = explode( ',', $product_images );

                                                        if ( $gallery ) {

                                                            foreach ( $gallery as $image_id ) {

                                                                if ( empty( $image_id ) ) {
                                                                    continue;
                                                                }

                                                                $attachment_image = wp_get_attachment_image_src( $image_id, 'thumbnail' );
                                                            ?>
                                                <li class="image" data-attachment_id="<?php echo $image_id; ?>">
                                                    <img src="<?php echo $attachment_image[0]; ?>" alt="">
                                                    <a href="#" class="action-delete"
                                                        title="<?php esc_attr_e( 'Delete image', 'dokan' );?>">&times;</a>
                                                </li>
                                                <?php
                                                    }

                                                        }

                                                    ?>
                                                <li class="add-image add-product-images tips"
                                                    data-title="<?php _e( 'Add gallery image', 'dokan' );?>">
                                                    <a href="#" class="add-product-images"><i class="fa fa-plus"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                            </ul>

                                            <input type="hidden" id="product_image_gallery" name="product_image_gallery"
                                                value="<?php echo esc_attr( $product_images ); ?>">
                                        </div>
                                    </div>
                                </div> <!-- .product-gallery -->

                                <button class="btn dokan-btn-theme dokan-btn-lg prevBtn-3"
                                    type="button">Previous</button>
                                <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update"
                                    value="Next" />
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Sixth Step -->
                <div class="row setup-content-3" id="step-6">
                    <div class="col-md-12">
                        <h3 class="font-weight-bold pl-0 my-4"><strong>Add a Video Tour</strong></h3>
                        <div class="form-group md-form">
                            <label for="video" data-error="wrong" data-success="right">Include a Video of Your
                                Listing</label>
                            <input id="video" type="text" name="video"
                                placeholder="https://www.youtube.com/watch?v=ffMfvsejBoo" class="form-control validate"
                                value="<?php echo $property_data['video'] ?>">
                        </div>

                        <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                        <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                    </div>
                </div>




                <div class="row setup-content-3" id="step-7">
                    <div class="col-md-12">
                        <h3 class="font-weight-bold pl-0 my-4"><strong>Description</strong></h3>

                        <div class="dokan-form-group dokan-auction-post-excerpt">
                            <?php dokan_post_input_box( $post_id, 'post_excerpt', array( 'placeholder' => 'Short description about the product...', 'value' => $post->post_excerpt ), 'textarea' );?>
                        </div>


                        <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                        <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                    </div>
                </div>


                <div class="row setup-content-3" id="step-8">
                    <div class="col-md-12">
                        <h3 class="font-weight-bold pl-0 my-4"><strong>Asking Price</strong></h3>

                        <div class="form-group">
                            <label for="_regular_price" data-error="wrong"
                                data-success="right"><?php _e( 'Final Offer', 'dokan' );?></label>
                            <div class="dokan-form-group">
                                <div class="dokan-input-group">
                                    <span
                                        class="dokan-input-group-addon"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                    <input id="_regular_price" type="number" name="_regular_price"
                                        placeholder="$404,999" class="wc_input_price form-control validate" "
                                            value=" <?php echo isset( $_regular_price ) ? $_regular_price : ''; ?>">
                                </div>
                            </div>

                            <div id="final_price_popup">Help me to determine price <i class="fas fa-info-circle"></i>
                            </div>
                        </div>


                        <div class="dokan-auction-start-price">
                            <div class="dokan-form-group">
                                <label class="dokan-control-label"
                                    for="_auction_start_price"><?php _e( 'Start Price', 'dokan' );?></label>
                                <div class="dokan-form-group">
                                    <div class="dokan-input-group">
                                        <span
                                            class="dokan-input-group-addon"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                        <input class="wc_input_price dokan-form-control" name="_auction_start_price"
                                            id="_auction_start_price" type="text"
                                            placeholder="<?php echo wc_format_localized_price( '9.99' ); ?>"
                                            value="<?php echo wc_format_localized_price( $_auction_start_price ); ?>"
                                            style="width: 97%;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dokan-auction-bid-increment">
                            <div class="dokan-form-group">
                                <div class="dokan-form-group">
                                    <div class="dokan-input-group">

                                        <input class="wc_input_price dokan-form-control" name="_auction_bid_increment"
                                            id="_auction_bid_increment" type="hidden"
                                            placeholder="<?php echo wc_format_localized_price( '9.99' ) ?>"
                                            value="<?php echo wc_format_localized_price( '1000' ) ?>">
                                        <!-- value="//echo wc_format_localized_price( $_auction_bid_increment );"
                                            Commented because we need to input 1000$ auto increment - we don't want to get this
                                            input from the user -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dokan-auction-dates-from">
                            <label class="dokan-control-label"
                                for="_auction_dates_from"><?php _e( 'Auction Start date', 'dokan' );?></label>
                            <div class="dokan-form-group">
                                <input class="dokan-form-control auction-datepicker" name="_auction_dates_from"
                                    id="_auction_dates_from" type="text" value="<?php echo $_auction_dates_from; ?>"
                                    style="width: 97%;" readonly>
                            </div>
                        </div>

                        <div class="dokan-auction-dates-to">
                            <label class="dokan-control-label"
                                for="_auction_dates_to"><?php _e( 'Auction End date', 'dokan' );?></label>
                            <div class="dokan-form-group">
                                <input class="dokan-form-control auction-datepicker" name="_auction_dates_to"
                                    id="_auction_dates_to" type="text" value="<?php echo $_auction_dates_to; ?>"
                                    readonly>
                            </div>
                        </div>

                        <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                        <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                    </div>
                </div>

                <!-- Final Step -->
                <div class="row setup-content-3" id="step-9">
                    <div class="col-md-12">

                        <h3 class="font-weight-bold pl-0 my-4"><strong>Finish</strong></h3>
                        <h4 class="font-weight-bold my-4">Listing completed!</h4>



                        <div class="dokan-form-group">
                            <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                            <input type="hidden" name="dokan_product_id" id="dokan-edit-product-id"
                                value="<?php echo $post_id; ?>" />
                            <input type="hidden" name="product-type" value="auction">
                            <input type="hidden" name="action" value="update_product_meta">
                            <input type="submit" name="update_auction_product"
                                class="btn dokan-btn-theme dokan-btn-lg nextBtn-3"
                                value="<?php esc_attr_e( 'Update auction', 'dokan' );?>" />
                        </div>
                    </div>
                </div>

            </div>

            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>


    <script type="text/javascript">
    ;
    (function($) {
        var auction_submit = $('.dokan-auction-product-form');
        var submit_first_button = $('#submit-first-btn');

        var ajax_submit = $('.ajax_update_form');
        var product_id = $('#dokan-edit-product-id');

        console.log(submit_first_button);

        ajax_submit.on('submit', function(e) {

            e.preventDefault();

            var address_1 = $('#address_1').val() != '' ? $('#address_1').val() + ', ' : '';
            var address_2 = $('#address_2').val() != '' ? $('#address_2').val() + ', ' : '';
            var city = $('#city').val() != '' ? $('#city').val() + ', ' : '';
            var state = $('#state').val() != '' ? $('#state').val() + ', ' : '';
            var zip_code = $('#zip_code').val() != '' ? $('#zip_code').val() : '';
            var edit_id = $('#dokan-edit-product-id');
            //var featureBtn = $(this).find("input[type=submit]:focus");


            var curStep = $(this).closest(".setup-content-3"),
                curStepBtn = curStep.attr("id"),
                nextStepStep = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().next()
                .children("a");

            var title = address_1 + address_2 + city + state + zip_code;
            var post_title = $('#post_title');
            post_title.val(title);

            var data = $(this).serialize();

            //btn.attr('disabled', true);
            //nextBtn.attr('disabled', true);

            $.ajax({
                url: RIS_Notify.ajaxurl,
                method: 'POST',
                beforeSend: function(xhr) {
                    // Set nonce here
                    xhr.setRequestHeader('X-WP-Nonce', RIS_Notify.nonce);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Updating records...',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    });
                },
                // Build post data.
                // If method is "delete", data should be passed as query params.
                data: data
            }).done(function(response) {

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your home details has been updated',
                    showConfirmButton: false,
                    timer: 2000
                });

                //submitNext.removeClass('btn dokan-btn-theme dokan-btn-lg ajax-update');
                //submitNext.addClass('btn dokan-btn-theme dokan-btn-lg nextBtn-3');
                //submitNext.prop('type', 'button');

                edit_id.val(response.data.id);
                console.log(response.data.id);
                nextStepStep.trigger('click');


                //window.location.reload(true);
            }).fail(function(response) {


            }).always(function() {

            });


        });



        $('input[type="checkbox"]').click(function() {
            var showBtn = false;
            var featureTab = $('#step-4 .features-tab');
            var coolings = $('.coolings:checked').length; // 3
            var accessibility_features = $('.accessibility_features:checked').length; // 1
            var kitchen_features = $('.kitchen_features:checked').length; // 1
            var appliances = $('.appliances:checked').length; // 3
            var bathroom_features = $('.bathroom_features:checked').length; // 1
            var fencings = $('.fencings:checked').length; // 1
            var parkings = $('.parkings:checked').length; // 1
            var electrics = $('.electrics:checked').length; // 1
            var laundries = $('.laundries:checked').length; // 1
            var room_types = $('.room_types:checked').length; // 2
            var utilities = $('.utilities:checked').length; // 1
            var common_walls = $('.common_walls:checked').length; // 1
            var construction_materials = $('.construction_materials:checked').length; // 1
            var roofs = $('.roofs:checked').length; // 1
            var foundation_details = $('.foundation_details:checked').length; // 1
            var lot_features = $('.lot_features:checked').length; // 1
            var property_conditions = $('.property_conditions:checked').length; // 1
            var sewers = $('.sewers:checked').length; // 1
            var water_sources = $('.water_sources:checked').length; // 1
            var community_features = $('.community_features:checked').length; // 1


            if (coolings >= 1 && accessibility_features >= 3 && room_types >= 2 && accessibility_features >=
                1 && kitchen_features >= 1 && appliances >= 1 && bathroom_features >= 1 && fencings >= 1 &&
                parkings >= 1 && electrics >= 1 && laundries >= 1 && utilities >= 1 && common_walls >= 1 &&
                construction_materials >= 1 && roofs >= 1 && foundation_details >= 1 && lot_features >= 1 &&
                property_conditions >= 1 && sewers >= 1 && water_sources >= 1 && community_features >= 1) {

                console.log(this);
                showBtn = true;
            }

            if (showBtn) {
                featureTab.attr('disabled', false);
            } else {
                featureTab.attr('disabled', true);
            }
            console.log(showBtn);
        });



        $(function() {

            var featureTab = $('#step-4 .features-tab');

            var coolings = $('.coolings:checked').length; // 3
            var accessibility_features = $('.accessibility_features:checked').length; // 1
            var kitchen_features = $('.kitchen_features:checked').length; // 1
            var appliances = $('.appliances:checked').length; // 3
            var bathroom_features = $('.bathroom_features:checked').length; // 3
            var fencings = $('.fencings:checked').length; // 1
            var parkings = $('.parkings:checked').length; // 1
            var electrics = $('.electrics:checked').length; // 1
            var laundries = $('.laundries:checked').length; // 1
            var room_types = $('.room_types:checked').length; // 2
            var utilities = $('.utilities:checked').length; // 1
            var common_walls = $('.common_walls:checked').length; // 1
            var construction_materials = $('.construction_materials:checked').length; // 1
            var roofs = $('.roofs:checked').length; // 1
            var foundation_details = $('.foundation_details:checked').length; // 1
            var lot_features = $('.lot_features:checked').length; // 1
            var property_conditions = $('.property_conditions:checked').length; // 1
            var sewers = $('.sewers:checked').length; // 1
            var water_sources = $('.water_sources:checked').length; // 1
            var community_features = $('.community_features:checked').length; // 1


            featureTab.attr('disabled', false);
        });




        $(function() {
            $('.auction-datepicker').datetimepicker({
                format: 'd-m-Y H:i',
            });

            $('#_auction_dates_from').datetimepicker({
                minDate: 0
            });

            $('#_auction_dates_from').datepicker("setDate", new Date());

        });

        var final_price_popup = $('#final_price_popup');

        final_price_popup.on('click', function(e) {

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Get My Price Now',
                html: 'Use Home Value tool to determine home value, <a href="/dashboard/tools" target="_blank">Go to the tool page</a>',
                showConfirmButton: true,
                confirmButtonColor: '#FF6600',
                confirmButtonText: 'Get Your Value',
                timerProgressBar: false,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.open('/dashboard/tools');
                };

            });
        });

    })(jQuery);
    </script>



    <?php

        }

        /**
         * Showing product description tab
         */
        add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 99 );

        function woo_custom_description_tab( $tabs ) {

        //echo '<pre>';
            //var_dump($tabs);
            $tabs['home_features']['title']    = 'Home Features';
            $tabs['description']['title']      = 'Description';
            $tabs['home_features']['callback'] = 'home_features_tab_content'; // Custom description callback        $tabs['description']['title']    = 'Description';
            $tabs['description']['callback']   = 'woo_custom_description_tab_content'; // Custom description callback

            $tabs['description']['priority']   = 15;
            $tabs['home_features']['priority'] = 90;

            return $tabs;
        }

        function rentometer_tab_content() {
        ?>
    <div class="container description-wraper">
        <div class="row online-wraper">
            <div class="col-md-6">
                <script async src="https://www.rentometer.com/leadgen/load.js?api_key=iSSremRbhRb-xnjrFI112w">
                </script>
                <div class="rentometer-leadgen" data-button-text="FREE Rent Analysis"></div>
            </div>
        </div>

    </div>
    <!-- <script async src="https://www.rentometer.com/leadgen/load.js?api_key=iSSremRbhRb-xnjrFI112w"></script>
            <div class="rentometer-leadgen" data-button-text="FREE Rent Analysis"></div> -->
    <?php
        }

        function home_features_tab_content() {
            global $product;

            if ( empty( $product ) ) {
                return;
            }

            $post = get_post( $product->get_id() );

            $property_data  = get_post_meta( $product->get_id(), 'property_data', true );
            $_regular_price = get_post_meta( $product->get_id(), '_regular_price', true );

        //echo '<pre>';

        //var_dump($property_data, $post);

            if ( ! empty( $property_data ) ) {
            ?>
    <div class="features-container">
        <div class="row">
            <div class="features">
                <h1 class="heading">Home Features</h1>
                <div class="features-slides" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>

                    <?php foreach ( $property_data['home_features'] as $key => $features ): ?>
                    <div class="HomeFeaturesCard">
                        <div class="HomeFeaturesCard__Head">
                            <span
                                class="icon                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo $key; ?>"></span>
                            <h3><?php echo str_replace( '_', ' ', ucwords( $key, '_' ) ); ?></h3>
                        </div>
                        <div class="HomeFeaturesCard__Body">
                            <ul class="list-disc py-0 px-6 m-0">
                                <?php foreach ( $features as $list ): ?>
                                <li>
                                    <h4><?php echo $list; ?></h4>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach;?>

                </div>
            </div>
        </div>
    </div>
    <?php
        }

        }

        function woo_custom_description_tab_content() {

            global $product;

            if ( empty( $product ) ) {
                return;
            }

            $post = get_post( $product->get_id() );

            $property_data  = get_post_meta( $product->get_id(), 'property_data', true );
            $_regular_price = get_post_meta( $product->get_id(), '_regular_price', true );
            $_lot_unit      = get_post_meta( $product->get_id(), '_lot_unit', true );

        //echo '<pre>';

        //var_dump($_lot_unit);

            if ( ! empty( $property_data ) ) {
            ?>

    <div class="description-wraper">
        <div class="row online-wraper">
            <div class="col-md-6">
                <div class="online">
                    <span class="rounded"
                        style="background-color: rgb(52, 209, 186); box-shadow: rgb(52, 209, 186) 1px 1px 3px;"></span>
                    <h1 class="sub-title">Home For Sale</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="des-price">
                    <h1 class="sub-title text-right">
                        <?php echo get_product_published_time( $product ) == 'pending' ? 'Not published' : 'Listed ' . get_product_published_time( $product ); ?>
                    </h1>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <h1 class="title"><?php echo $post->post_title; ?></h1>
                <div class="address">
                    <p><?php echo isset( $property_data['address']['city'] ) ? $property_data['address']['city'] : ''; ?>,
                        <?php echo isset( $property_data['address']['state'] ) ? $property_data['address']['state'] : ''; ?>,
                        <?php echo isset( $property_data['address']['zip_code'] ) ? $property_data['address']['zip_code'] : ''; ?>
                    </p>
                    <p>Listing ID #<?php echo isset( $post->ID ) ? $post->ID : ''; ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="des-price">
                    <h1 class="title text-right">
                        <?php echo isset( $_regular_price ) ? '$ ' . number_format( $_regular_price, 2 ) : ''; ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if ( isset( $property_data['home_details']['bedrooms'] ) && ! empty( $property_data['home_details']['bedrooms'] ) ): ?>
            <div class="col-md-2">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28.334" height="25.088" viewBox="0 0 28.334 25.088">
                        <g id="_4beds" data-name="4beds" transform="translate(-0.518 -0.407)">
                            <g id="Group_5" data-name="Group 5" transform="translate(-59 -493)">
                                <g id="Group_4" data-name="Group 4" transform="translate(16 296)">
                                    <g id="Group_3" data-name="Group 3" transform="translate(1 185)">
                                        <g id="Group_2" data-name="Group 2" transform="translate(40 8)">
                                            <g id="Group_1" data-name="Group 1">
                                                <rect id="Rectangle_1" data-name="Rectangle 1" width="21.202"
                                                    height="7.391" rx="1.209" transform="translate(6.084 5.509)"
                                                    fill="#fff" stroke="#ff4900" stroke-width="2.204" />
                                                <path id="Path_1" data-name="Path 1"
                                                    d="M27.532,12.7H5.838l-1.9,7.44h25.5l-1.9-7.44Z" fill="#fff"
                                                    stroke="#ff4900" stroke-width="2.204" fill-rule="evenodd" />
                                                <rect id="Rectangle_2" data-name="Rectangle 2" width="10.731"
                                                    height="4.992" rx="1.33" transform="translate(4.852 9.107)"
                                                    fill="#fff" stroke="#ff4900" stroke-width="2.204" />
                                                <rect id="Rectangle_3" data-name="Rectangle 3" width="10.731"
                                                    height="4.992" rx="1.33" transform="translate(17.787 9.107)"
                                                    fill="#fff" stroke="#ff4900" stroke-width="2.204" />
                                                <path id="Path_2" data-name="Path 2" d="M6.258,26.235v2.158" fill="none"
                                                    stroke="#ff4900" stroke-linecap="round" stroke-width="2.204"
                                                    fill-rule="evenodd" />
                                                <path id="Path_3" data-name="Path 3" d="M26.54,26.235v2.158" fill="none"
                                                    stroke="#ff4900" stroke-linecap="round" stroke-width="2.204"
                                                    fill-rule="evenodd" />
                                                <rect id="Rectangle_4" data-name="Rectangle 4" width="26.13"
                                                    height="4.992" rx="1.209" transform="translate(3.62 21.1)"
                                                    fill="#fff" stroke="#ff4900" stroke-width="2.204" />
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <p><?php echo $property_data['home_details']['bedrooms'] ?> Beds</p>
                </div>

            </div>
            <?php endif;?>


            <?php if ( isset( $property_data['home_details']['bathrooms'] ) && ! empty( $property_data['home_details']['bathrooms'] ) ): ?>
            <div class="col-md-2">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28.334" height="25.088" viewBox="0 0 28.334 25.088">
                        <g id="_4beds" data-name="4beds" transform="translate(-0.518 -0.407)">
                            <g id="Group_5" data-name="Group 5" transform="translate(-59 -493)">
                                <g id="Group_4" data-name="Group 4" transform="translate(16 296)">
                                    <g id="Group_3" data-name="Group 3" transform="translate(1 185)">
                                        <g id="Group_2" data-name="Group 2" transform="translate(40 8)">
                                            <g id="Group_1" data-name="Group 1">
                                                <rect id="Rectangle_1" data-name="Rectangle 1" width="21.202"
                                                    height="7.391" rx="1.209" transform="translate(6.084 5.509)"
                                                    fill="#fff" stroke="#ff4900" stroke-width="2.204" />
                                                <path id="Path_1" data-name="Path 1"
                                                    d="M27.532,12.7H5.838l-1.9,7.44h25.5l-1.9-7.44Z" fill="#fff"
                                                    stroke="#ff4900" stroke-width="2.204" fill-rule="evenodd" />
                                                <rect id="Rectangle_2" data-name="Rectangle 2" width="10.731"
                                                    height="4.992" rx="1.33" transform="translate(4.852 9.107)"
                                                    fill="#fff" stroke="#ff4900" stroke-width="2.204" />
                                                <rect id="Rectangle_3" data-name="Rectangle 3" width="10.731"
                                                    height="4.992" rx="1.33" transform="translate(17.787 9.107)"
                                                    fill="#fff" stroke="#ff4900" stroke-width="2.204" />
                                                <path id="Path_2" data-name="Path 2" d="M6.258,26.235v2.158" fill="none"
                                                    stroke="#ff4900" stroke-linecap="round" stroke-width="2.204"
                                                    fill-rule="evenodd" />
                                                <path id="Path_3" data-name="Path 3" d="M26.54,26.235v2.158" fill="none"
                                                    stroke="#ff4900" stroke-linecap="round" stroke-width="2.204"
                                                    fill-rule="evenodd" />
                                                <rect id="Rectangle_4" data-name="Rectangle 4" width="26.13"
                                                    height="4.992" rx="1.209" transform="translate(3.62 21.1)"
                                                    fill="#fff" stroke="#ff4900" stroke-width="2.204" />
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <p><?php echo $property_data['home_details']['bathrooms'] ?> Baths</p>
                </div>
            </div>
            <?php endif;?>

            <?php if ( isset( $property_data['home_details']['property_type'] ) && ! empty( $property_data['home_details']['property_type'] ) ): ?>
            <div class="col-md-2">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30.759" height="27.7" viewBox="0 0 30.759 27.7">
                        <g id="Single_Family" data-name="Single Family" transform="translate(0.378 -0.084)">
                            <g id="Group_18" data-name="Group 18" transform="translate(-286 -492)">
                                <g id="Group_17" data-name="Group 17" transform="translate(16 296)">
                                    <g id="Group_16" data-name="Group 16" transform="translate(1 185)">
                                        <g id="Group_15" data-name="Group 15" transform="translate(267 8)">
                                            <g id="Group_14" data-name="Group 14">
                                                <g id="Group_13" data-name="Group 13"
                                                    transform="translate(3.148 4.407)">
                                                    <path id="Path_8" data-name="Path 8"
                                                        d="M0,9.121,13.852,0,27.7,9.281" fill="none" stroke="#ff4900"
                                                        stroke-linecap="round" stroke-width="2.204"
                                                        fill-rule="evenodd" />
                                                    <path id="Path_9" data-name="Path 9"
                                                        d="M24.24,7.376v16.6a1.3,1.3,0,0,1-1.294,1.3H4.758a1.3,1.3,0,0,1-1.3-1.3V7.376h0"
                                                        fill="none" stroke="#ff4900" stroke-width="2.204"
                                                        fill-rule="evenodd" />
                                                    <path id="Path_10" data-name="Path 10"
                                                        d="M9.253,25.815v-14.2h9.2v14.2" fill="none" stroke="#ff4900"
                                                        stroke-linejoin="round" stroke-width="2.204"
                                                        fill-rule="evenodd" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <p><?php echo $property_data['home_details']['property_type'] ?></p>
                </div>
            </div>
            <?php endif;?>

            <?php if ( isset( $property_data['home_details']['year_built'] ) && ! empty( $property_data['home_details']['year_built'] ) ): ?>
            <div class="col-md-2">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="29.244" height="23.659" viewBox="0 0 29.244 23.659">
                        <g id="Built_In_1996" data-name="Built In 1996" transform="translate(-0.166 -0.207)">
                            <g id="Group_25" data-name="Group 25" transform="translate(-59 -577)">
                                <g id="Group_24" data-name="Group 24" transform="translate(16 296)">
                                    <g id="Group_23" data-name="Group 23" transform="translate(1 185)">
                                        <g id="Group_22" data-name="Group 22" transform="translate(39 91)">
                                            <g id="Group_21" data-name="Group 21">
                                                <g id="Group_20" data-name="Group 20"
                                                    transform="translate(3.148 6.296)">
                                                    <path id="Path_11" data-name="Path 11" d="M27.7.469,21.886,6.643"
                                                        fill="none" stroke="#ff4900" stroke-linecap="round"
                                                        stroke-width="2.204" fill-rule="evenodd" />
                                                    <path id="Path_12" data-name="Path 12"
                                                        d="M14.8,13.35l5.015,7.5a1.139,1.139,0,0,0,2.059-.878L19.623,9.756h0"
                                                        fill="none" stroke="#ff4900" stroke-linecap="round"
                                                        stroke-width="2.204" fill-rule="evenodd" />
                                                    <path id="Path_13" data-name="Path 13"
                                                        d="M21.99,6.338,1.543,6.38l2.715,8.186,11.373-.014L21.99,6.337Z"
                                                        fill="#fff" stroke="#ff4900" stroke-width="2.204"
                                                        fill-rule="evenodd" />
                                                    <ellipse id="Ellipse_1" data-name="Ellipse 1" cx="4.04" cy="4.059"
                                                        rx="4.04" ry="4.059" transform="translate(2.309 13.35)"
                                                        fill="#fff" stroke="#ff4900" stroke-width="2.204" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <p>Built In <?php echo $property_data['home_details']['year_built'] ?></p>
                </div>
            </div>
            <?php endif;?>

            <?php if ( isset( $property_data['home_details']['home_size'] ) && ! empty( $property_data['home_details']['home_size'] ) ): ?>
            <div class="col-md-2">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="29.178" height="26.763" viewBox="0 0 29.178 26.763">
                        <g id="_3376_SqFt" data-name="3376 SqFt" transform="translate(-0.21 -0.055)">
                            <g id="Group_32" data-name="Group 32" transform="translate(-173 -576)">
                                <g id="Group_31" data-name="Group 31" transform="translate(16 296)">
                                    <g id="Group_30" data-name="Group 30" transform="translate(1 185)">
                                        <g id="Group_29" data-name="Group 29" transform="translate(154 91)">
                                            <g id="Group_28" data-name="Group 28">
                                                <g id="Group_27" data-name="Group 27"
                                                    transform="translate(3.148 4.407)">
                                                    <path id="Path_14" data-name="Path 14"
                                                        d="M8.432,15.993l9.636-6.606L27.7,16.094" fill="none"
                                                        stroke="#ff4900" stroke-width="1.877" fill-rule="evenodd" />
                                                    <path id="Path_15" data-name="Path 15"
                                                        d="M1.18.587H24.115a1.18,1.18,0,0,1,1.18,1.18V4.1a1.18,1.18,0,0,1-1.18,1.18H4.818V24.048a1.18,1.18,0,0,1-1.18,1.18H1.18A1.18,1.18,0,0,1,0,24.048V1.766A1.18,1.18,0,0,1,1.18.586Z"
                                                        fill="none" stroke="#ff4900" stroke-width="1.877"
                                                        fill-rule="evenodd" />
                                                    <path id="Path_16" data-name="Path 16" d="M6.625,2.934V5.253"
                                                        fill="none" stroke="#ff4900" stroke-linecap="round"
                                                        stroke-width="1.877" fill-rule="evenodd" />
                                                    <path id="Path_17" data-name="Path 17" d="M10.238,2.934V5.253"
                                                        fill="none" stroke="#ff4900" stroke-linecap="round"
                                                        stroke-width="1.877" fill-rule="evenodd" />
                                                    <path id="Path_18" data-name="Path 18" d="M13.852,2.934V5.253"
                                                        fill="none" stroke="#ff4900" stroke-linecap="round"
                                                        stroke-width="1.877" fill-rule="evenodd" />
                                                    <path id="Path_19" data-name="Path 19" d="M17.465,2.934V5.253"
                                                        fill="none" stroke="#ff4900" stroke-linecap="round"
                                                        stroke-width="1.877" fill-rule="evenodd" />
                                                    <path id="Path_20" data-name="Path 20" d="M21.079,2.934V5.253"
                                                        fill="none" stroke="#ff4900" stroke-linecap="round"
                                                        stroke-width="1.877" fill-rule="evenodd" />
                                                    <path id="Path_21" data-name="Path 21" d="M3.6,5.85V8.231"
                                                        transform="translate(10.64 3.44) rotate(90)" fill="none"
                                                        stroke="#ff4900" stroke-linecap="round" stroke-width="1.877"
                                                        fill-rule="evenodd" />
                                                    <path id="Path_22" data-name="Path 22" d="M3.6,9.37v2.381"
                                                        transform="translate(14.16 6.96) rotate(90)" fill="none"
                                                        stroke="#ff4900" stroke-linecap="round" stroke-width="1.877"
                                                        fill-rule="evenodd" />
                                                    <path id="Path_23" data-name="Path 23" d="M3.6,12.89v2.381"
                                                        transform="translate(17.68 10.48) rotate(90)" fill="none"
                                                        stroke="#ff4900" stroke-linecap="round" stroke-width="1.877"
                                                        fill-rule="evenodd" />
                                                    <path id="Path_24" data-name="Path 24" d="M3.6,16.411v2.38"
                                                        transform="translate(21.201 14.001) rotate(90)" fill="none"
                                                        stroke="#ff4900" stroke-linecap="round" stroke-width="1.877"
                                                        fill-rule="evenodd" />
                                                    <path id="Path_25" data-name="Path 25" d="M3.6,19.931v2.381"
                                                        transform="translate(24.721 17.521) rotate(90)" fill="none"
                                                        stroke="#ff4900" stroke-linecap="round" stroke-width="1.877"
                                                        fill-rule="evenodd" />
                                                    <path id="Path_26" data-name="Path 26"
                                                        d="M24.692,14.08V24.292a1.18,1.18,0,0,1-1.18,1.18H12.622a1.18,1.18,0,0,1-1.18-1.18V14.081h0"
                                                        fill="none" stroke="#ff4900" stroke-width="1.877"
                                                        fill-rule="evenodd" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <p><?php echo $property_data['home_details']['home_size'] ?> SqFt</p>
                </div>
            </div>
            <?php endif;?>

            <?php if ( isset( $property_data['home_details']['lot_size'] ) && ! empty( $property_data['home_details']['lot_size'] ) ): ?>
            <div class="col-md-2">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28.704" height="26.76" viewBox="0 0 28.704 26.76">
                        <g id="_7_828_Acres" data-name="7,828 Acres" transform="translate(-0.046 -0.935)">
                            <g id="Group_39" data-name="Group 39" transform="translate(-287 -575)">
                                <g id="Group_38" data-name="Group 38" transform="translate(16 296)">
                                    <g id="Group_37" data-name="Group 37" transform="translate(1 185)">
                                        <g id="Group_36" data-name="Group 36" transform="translate(268 91)">
                                            <g id="Group_35" data-name="Group 35">
                                                <g id="Group_34" data-name="Group 34"
                                                    transform="translate(3.148 5.037)">
                                                    <path id="Path_27" data-name="Path 27" d="M3.614,0V24.556"
                                                        fill="none" stroke="#ff4900" stroke-linecap="round"
                                                        stroke-width="2.204" fill-rule="evenodd" />
                                                    <path id="Path_28" data-name="Path 28" d="M22.886,0V24.556"
                                                        fill="none" stroke="#ff4900" stroke-linecap="round"
                                                        stroke-width="2.204" fill-rule="evenodd" />
                                                    <path id="Path_29" data-name="Path 29" d="M13.25,7.8V34.3"
                                                        transform="translate(-7.798 34.298) rotate(-90)" fill="none"
                                                        stroke="#ff4900" stroke-linecap="round" stroke-width="2.204"
                                                        fill-rule="evenodd" />
                                                    <path id="Path_30" data-name="Path 30" d="M13.25-9.742v26.5"
                                                        transform="translate(9.742 16.758) rotate(-90)" fill="none"
                                                        stroke="#ff4900" stroke-linecap="round" stroke-width="2.204"
                                                        fill-rule="evenodd" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <p><?php echo $property_data['home_details']['lot_size'] ?>
                        <?php echo ( $_lot_unit == 'sqft' ) ? 'SqFt' : 'Acres'; ?></p>
                </div>
            </div>
            <?php endif;?>


        </div>
        <div class="row map-wraper">
            <div class="h4">You'd Be Living Here</div>
            <div class="map">
                <?php
                    $address_1 = get_post_meta( $post->ID, '_address_1', true ) != '' ? get_post_meta( $post->ID, '_address_1', true ) . ',+' : '';
                            $address_2 = get_post_meta( $post->ID, '_address_2', true ) != '' ? get_post_meta( $post->ID, '_address_2', true ) . ',+' : '';
                            $city      = get_post_meta( $post->ID, '_city', true ) != '' ? get_post_meta( $post->ID, '_city', true ) . ',+' : '';
                            $state     = get_post_meta( $post->ID, '_state', true ) != '' ? get_post_meta( $post->ID, '_state', true ) . ',+' : '';
                            $zip       = get_post_meta( $post->ID, '_zip_code', true ) != '' ? get_post_meta( $post->ID, '_zip_code', true ) : '';

                            $property_location = $address_1 . $address_2 . $city . $state . $zip;
                        ?>
                <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAiikwR2cFcbFLKjpPM8zdPhG3JNgKUXRQ
        &q=<?php echo $property_location; ?>">
                </iframe>


            </div>
        </div>
        <div class="row">
            <div class="description">
                <h1 class="heading">Property Description</h1>
                <p><?php echo isset( $post->post_excerpt ) ? $post->post_excerpt : ''; ?></p>
            </div>
        </div>

    </div>

    <?php if ( isset( $property_data['video'] ) && ! empty( isset( $property_data['video'] ) ) ):

                    $url = preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $property_data['video'], $matches );
                ?>
    <div class="video-container">
        <div class="row">
            <h1 class="heading">Home Tour</h1>
            <iframe id="player" type="text/html" width="100%" height="600PX"
                src="https://www.youtube.com/embed/<?php echo $matches[0]; ?>" frameborder="0"></iframe>

        </div>
    </div>
    <?php endif;?>


    <!-- <strong><?php //echo esc_attr( $property_data ); ?></strong></span> -->


    <script type="text/javascript">
    jQuery(document).ready(function($) {

        // $('.features-slides').slick({
        //     dots: true,
        //     infinite: false,
        //     speed: 300,
        //     slidesToShow: 4,
        //     slidesToScroll: 4,
        //     responsive: [{
        //             breakpoint: 1024,
        //             settings: {
        //                 slidesToShow: 3,
        //                 slidesToScroll: 3,
        //                 infinite: true,
        //                 dots: true
        //             }
        //         },
        //         {
        //             breakpoint: 600,
        //             settings: {
        //                 slidesToShow: 2,
        //                 slidesToScroll: 2
        //             }
        //         },
        //         {
        //             breakpoint: 480,
        //             settings: {
        //                 slidesToShow: 1,
        //                 slidesToScroll: 1
        //             }
        //         }
        //         // You can unslick at a given breakpoint now by adding:
        //         // settings: "unslick"
        //         // instead of a settings object
        //     ]
        // });




    });
    </script>





    <?php }

        }

    ?>


    <?php

        function get_product_published_time( $product ) {

            $datetime = $product->get_date_created() != NULL ? $product->get_date_created() : 'pending';

            if ( $datetime != 'pending' ) {
                $timezone = $datetime->getTimezone();
                $now_time = new WC_DateTime();

                $now_time->setTimezone( $timezone );

                $timestamp_diff = $now_time->getTimestamp() - $datetime->getTimestamp();

                $data = timestamp_to_array( $timestamp_diff );

                if ( $data['d'] != '00' ) {
                    return $data['d'] . ' ' . _n( 'day', 'days', $data['d'], 'woocommerce' ) . ' ago';

                } else

                if ( $data['d'] != '00' ) {
                    return $data['h'] . ' ' . _n( 'hour', 'hours', $data['h'], 'woocommerce' ) . ' ago';
                } else {
                    return $data['m'] . ' ' . _n( 'minute', 'minutes', $data['m'], 'woocommerce' ) . ' ago';
                }

                return $data['s'] . ' ' . _n( 'second', 'seconds', $data['s'], 'woocommerce' ) . ' ago';
            } else {
                return 'pending';
            }

        }

        function timestamp_to_array( $timestamp ) {
            $d  = floor( $timestamp / 86400 );
            $_d = ( $d < 10 ? '0' : '' ) . $d;

            $h  = floor(  ( $timestamp - $d * 86400 ) / 3600 );
            $_h = ( $h < 10 ? '0' : '' ) . $h;

            $m  = floor(  ( $timestamp - ( $d * 86400 + $h * 3600 ) ) / 60 );
            $_m = ( $m < 10 ? '0' : '' ) . $m;

            $s  = $timestamp - ( $d * 86400 + $h * 3600 + $m * 60 );
            $_s = ( $s < 10 ? '0' : '' ) . $s;

            return array( 'd' => $_d, 'h' => $_h, 'm' => $_m, 's' => $_s );
        }

        add_filter( 'init', 'remove_dokan_widgets', 99 );

        function remove_dokan_widgets() {

        // if ( is_vendor_subscribed_pack( 6793 ) ) {

        //     remove_action( 'dokan_dashboard_left_widgets', array( dokan()->dashboard->templates->dashboard, 'get_big_counter_widgets' ), 10 );

            //     remove_action( 'dokan_dashboard_left_widgets', array( dokan()->dashboard->templates->dashboard, 'get_orders_widgets' ), 15 );

            remove_action( 'dokan_dashboard_left_widgets', array( dokan()->dashboard->templates->dashboard, 'get_products_widgets' ), 20 );

        //     remove_action( 'dokan_dashboard_right_widgets', array( dokan()->dashboard->templates->dashboard, 'get_sales_report_chart_widget' ), 10 );

            //     dokan_remove_hook_for_anonymous_class( 'dokan_dashboard_before_widgets', \WeDevs\DokanPro\Dashboard::class, 'show_profile_progressbar', 10 );

            dokan_remove_hook_for_anonymous_class( 'dokan_dashboard_left_widgets', \WeDevs\DokanPro\Dashboard::class, 'get_review_widget', 16 );

        //     dokan_remove_hook_for_anonymous_class( 'dokan_dashboard_right_widgets', \WeDevs\DokanPro\Dashboard::class, 'get_announcement_widget', 12 );

            // }

        }

        function is_vendor_subscribed_pack( $product_id ) {

            $user_id              = get_current_user_id();
            $date                 = date( 'Y-m-d', strtotime( current_time( 'mysql' ) ) );
            $product_pack_enddate = get_pack_end_date( $user_id );
            $validation_date      = date( 'Y-m-d', strtotime( $product_pack_enddate ) );
            $product_package_id   = get_user_meta( $user_id, 'product_package_id', true );

            if ( $product_pack_enddate == 'unlimited' && $product_package_id == $product_id ) {
                return true;
            }

            if ( $date < $validation_date && $product_package_id == $product_id ) {
                return true;
            }

            return false;
        }

        function get_pack_end_date( $vendor_id ) {
            return get_user_meta( $vendor_id, 'product_pack_enddate', true );
        }

        if ( ! is_vendor_subscribed_pack( 6793 ) || is_vendor_subscribed_pack( 6792 ) || is_vendor_subscribed_pack( 6795 ) ) {
            add_action( 'dokan_dashboard_before_widgets', 'product_listing', 99 );
        }

        function product_listing() {
        ?>
    <h1 class="entry-title">
        Add New Listing </h1>
    <form class="ajax_update_form" method="post">

        <div class="product-edit-container dokan-clearfix">
        </div>
        <?php do_action( 'dokan_new_listing_form' );?>
    </form>

    <?php
        }

        if ( is_vendor_subscribed_pack( 6793 ) ) {

            add_action( 'dokan_dashboard_before_widgets', 'investor_dashboard', 99 );

        }

        function investor_dashboard() {
            global $all_states;
            $user_id  = get_current_user_id();
            $searches = get_user_meta( $user_id, 'notification_settings' );
            $user     = get_user_meta( $user_id, 'notification_settings', true );

            if ( $user == '' ) {
                $user = [
                    'notification' => [
                        'city'          => '',
                        'property_type' => [],
                        'state'         => '',

                    ],
                ];
            }

            $states = array_keys( $all_states );
            array_unshift( $states, 'Any' );
            $property_types = ['Any', 'Condo', 'Single Family', 'Townhome', 'Other'];

        ?>

    <header class="dokan-dashboard-header dokan-clearfix">
        <h1 class="entry-title">Dashboard</h1>
    </header>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <div class="investor_dashboard">
        <!-- Grid row -->
        <div class="row pt-5 d-flex justify-content-center step-card">

            <!-- Grid column -->
            <div class="col-md-3 pl-5 pl-md-0 pb-5 step-nav">
                <!-- Stepper -->
                <div class="steps-form-3">
                    <div class="steps-row-3 setup-panel-3 d-flex justify-content-between">
                        <div class="steps-step-3">
                            <a href="#step-1" type="button" class="btn btn-info btn-circle-3 waves-effect ml-0"
                                data-toggle="tooltip" data-placement="top" title="Location"><i class="fa fa-street-view"
                                    aria-hidden="true"></i><span class="nav">Location</span></a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-2" type="button" class="btn btn-pink btn-circle-3 waves-effect p-3"
                                data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-home"
                                    aria-hidden="true"></i><span class="nav">Details</span></a>

                        </div>
                        <div class="steps-step-3">
                            <a href="#step-3" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Asking Price"><i
                                    class="fas fa-file-invoice-dollar" aria-hidden="true"></i><span class="nav">Price
                                    Range</span></a>
                        </div>
                        <div class="steps-step-3 no-height">
                            <a href="#step-4" type="button" class="btn btn-pink btn-circle-3 waves-effect p-3"
                                data-toggle="tooltip" data-placement="top" title="Post Your Listing"><i
                                    class="fa fa-laptop" aria-hidden="true"></i><span class="nav">Save Your
                                    Settings</span></a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-6">
                <form id="notification-form">
                    <!-- First Step -->
                    <div class="row setup-content-3" id="step-1">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold pl-0 my-4"><strong>Property Search</strong>
                            </h3>

                            <div class="form-group md-form mt-3">
                                <label for="city" data-error="wrong" data-success="right">City</label>
                                <input id="city" type="text" name="notification[city]" placeholder="Any"
                                    class="form-control" value="">

                            </div>

                            <div class="row">
                                <div class="col-md-6 state-input">
                                    <div class="form-group md-form mt-3">
                                        <label for="state" data-error="wrong" data-success="right">State</label>
                                        <select id="state" name="notification[state]" class="form-control">

                                            <?php

                                                foreach ( $states as $key => $state ) {?>


                                            <option value="<?php echo $state; ?>"><?php echo $state; ?></option>

                                            <?php }

                                                ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group md-form mt-3">
                                        <label for="zip_code" data-error="wrong" data-success="right">Zip
                                            Code</label>
                                        <input id="zip_code" type="text" name="notification[zip_code]" placeholder="Any"
                                            class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <button class="btn dokan-btn-theme dokan-btn-lg nextBtn-3" type="button">Next</button>
                        </div>
                    </div>


                    <!-- Second Step -->
                    <div class="row setup-content-3" id="step-2">
                        <div class="col-md-12">

                            <h3 class="font-weight-bold pl-0 my-4"><strong>Home Details</strong></h3>

                            <div class="form-group md-form">
                            </div>
                            <div class="form-group md-form">
                                <label for="property_type" data-error="wrong" data-success="right">Property
                                    Type</label>
                                <select id="property_type" name="notification[property_type]" class="form-control">

                                    <?php

                                        foreach ( $property_types as $key => $property_type ) {?>

                                    <option value="<?php echo $property_type; ?>"><?php echo $property_type; ?>
                                    </option>

                                    <?php }

                                        ?>

                                </select>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="home_size" data-error="wrong" data-success="right">Home Size (SqFt)</label>
                                        <input step="any" id="home_size" type="number" name="notification[home_size]" placeholder="Any"
                                        class="form-control" value="
                                        ">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="lot_size" data-error="wrong" data-success="right">Lot Size (Acres)</label>
                                        <input step="any" id="lot_size" type="number" name="notification[lot_size]" placeholder="Any"
                                        class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="year_built" data-error="wrong" data-success="right">Year Built</label>
                                        <input step="any" id="year_built" type="number" name="notification[year_built]" placeholder="Any"
                                        class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="bedrooms" data-error="wrong" data-success="right">Bedrooms</label>
                                        <input step="any" id="bedrooms" type="number" name="notification[bedrooms]" placeholder="Any"
                                        class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="bathrooms" data-error="wrong" data-success="right">Bathrooms</label>
                                        <input step="any" id="bathrooms" type="number" name="notification[bathrooms]" placeholder="Any"
                                        class="form-control" value="">
                                    </div>
                                </div>
                            </div> -->

                            <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                            <button class="btn dokan-btn-theme dokan-btn-lg nextBtn-3" type="button">Next</button>
                        </div>
                    </div>


                    <div class="row setup-content-3" id="step-3">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold pl-0 my-4"><strong>Final Offer</strong></h3>
                        </div>
                        <div class="col-md-6">

                            <div class="half form-group md-form">
                                <label for="min-price" data-error="wrong" data-success="right">Min price</label>
                                <div class="dokan-form-group">
                                    <div class="dokan-input-group">
                                        <span
                                            class="dokan-input-group-addon"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                        <input id="min-price" type="number" name="notification[min_price]"
                                            placeholder="Any" class="wc_input_price form-control validate" value="">
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="half form-group md-form">
                                <label for="min-price" data-error="wrong" data-success="right">Max price</label>
                                <div class="dokan-form-group">
                                    <div class="dokan-input-group">
                                        <span
                                            class="dokan-input-group-addon"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                        <input id="max-price" type="number" name="notification[max_price]"
                                            placeholder="Any" class="wc_input_price form-control validate" value="">
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="col-md-12">
                            <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                            <button class="btn dokan-btn-theme dokan-btn-lg nextBtn-3" type="button">Next</button>
                        </div>

                    </div>

                    <!-- Final Step -->
                    <div class="row setup-content-3" id="step-4">
                        <div class="col-md-12">

                            <h3 class="font-weight-bold pl-0 my-4"><strong>All set!</strong></h3>
                            <h4 class="font-weight-bold my-4">Please name this search</h4>



                            <div class="form-group md-form mt-3">
                                <label for="search_name" data-error="wrong" data-success="right">Search name</label>
                                <input id="search_name" type="text" name="notification[search_name]"
                                    placeholder="Search name" class="form-control" value="">
                            </div>

                            <div class="form-check md-form mt-3">
                                <label for="notification[notification_check]" data-error="wrong" data-success="right">If
                                    You
                                    Get Email Notifications When a New Property Arrives in That Search</label>
                                <input type="checkbox" name="notification[notification_check]" value="true"
                                    class="form-check-input validate">
                            </div>


                            <div class="dokan-form-group">
                                <button class="btn dokan-btn-theme dokan-btn-lg prevBtn-3"
                                    type="button">Previous</button>
                                <input type="hidden" name="action" value="notification_settings" />
                                <?php wp_nonce_field( 'product_notification_nonce', 'product_notification_nonce' );?>
                                <input type="submit" id="add_notification" name="add_notification"
                                    class="submit-btn btn dokan-btn-theme dokan-btn-lg nextBtn-3"
                                    value="<?php esc_attr_e( 'Save settings', 'dokan' );?>" />
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>


    <div class="container-xl">
        <div class="row pt-5 d-flex justify-content-center step-card">
            <div class="col-md-12">
                <div class="table-responsive">
                    <div class="table">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2>Your saved <b>searches</b></h2>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Property Type</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                        foreach ( $searches as $key => $search ):
                                            $property_type = isset( $search['property_type'] ) ? $search['property_type'] : 'Any';
                                            $home_size     = isset( $search['home_size'] ) ? $search['home_size'] : 'Any';
                                            $lot_size      = isset( $search['lot_size'] ) ? $search['lot_size'] : 'Any';
                                            $year_built    = isset( $search['year_built'] ) ? $search['year_built'] : 'Any';
                                            $bedrooms      = isset( $search['bedrooms'] ) ? $search['bedrooms'] : 'Any';
                                            $bathrooms     = isset( $search['bathrooms'] ) ? $search['bathrooms'] : 'Any';
                                            $min_price     = isset( $search['min_price'] ) && ! empty( $search['min_price'] ) ? $search['min_price'] : 'Any';
                                            $max_price     = isset( $search['max_price'] ) && ! empty( $search['max_price'] ) ? $search['max_price'] : 'Any';

                                            $city     = isset( $search['city'] ) && ! empty( $search['city'] ) ? $search['city'] : 'Any';
                                            $state    = isset( $search['state'] ) && ! empty( $search['state'] ) ? $search['state'] : 'Any';
                                            $zip_code = isset( $search['zip_code'] ) && ! empty( $search['zip_code'] ) ? $search['zip_code'] : 'Any';
                                            $address  = $city . ', ' . $state . ', ' . $zip_code;
                                            $query    = '/auctions/filter?city=' . $city . '&state=' . $state . '&zip_code=' . $zip_code . '&property_type=' . $property_type . '&min_price=' . $min_price . '&max_price=' . $max_price;

                                            // $query = '/auctions/filter?city=' . $city . '&state=' . $state . '&zip_code=' . $zip_code . '&property_type=' . $property_type . '&home_size=' . $home_size . '&lot_size=' . $lot_size . '&year_built=' . $year_built . '&bedrooms=' . $bedrooms . '&bathrooms=' . $bathrooms . '&min_price=' . $min_price . '&max_price=' . $max_price;
                                        ?>


                                <tr>
                                    <td class="col-md-3">
                                        <?php echo isset( $search['search_name'] ) ? $search['search_name'] : '' ?>
                                    </td>
                                    <td class="col-md-3">
                                        <?php echo isset( $search['property_type'] ) ? $search['property_type'] : '' ?>
                                    </td>
                                    <td><?php echo isset( $address ) ? $address : '' ?></td>
                                    <td class="col-md-2">
                                        <a target="_blank" href="<?php echo $query; ?>" class="filter"
                                            data-toggle="modal"><i class="fas fa-eye" data-toggle="tooltip"
                                                title="View"></i></a>
                                        <a href="#viewSearch" data-id="<?php echo $key ?>" class="edit"
                                            data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                                title="Full View">&#xE254;</i></a>
                                        <a href="#" data-id="<?php echo $key ?>" class="delete" data-toggle="modal"><i
                                                class="material-icons" data-toggle="tooltip"
                                                title="Delete">&#xE872;</i></a>
                                    </td>
                                </tr>
                                <?php endforeach;?>



                            </tbody>
                        </table>
                        <!-- <div class="clearfix">
                            <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                            <ul class="pagination">
                                <li class="page-item disabled"><a href="#">Previous</a></li>
                                <li class="page-item"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                <li class="page-item"><a href="#" class="page-link">5</a></li>
                                <li class="page-item"><a href="#" class="page-link">Next</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="viewSearch" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content clearfix">
                <form id="notification-form-modal">
                    <!-- First Step -->

                    <div class="col-md-12">
                        <h3 class="font-weight-bold pl-0 my-4"><strong>Property Search</strong>
                        </h3>

                        <div class="form-group md-form mt-3">
                            <label for="city" data-error="wrong" data-success="right">City</label>
                            <input id="city" type="text" name="notification[city]" placeholder="Any"
                                class="form-control" value="">

                        </div>

                        <div class="row">
                            <div class="col-md-6 state-input">
                                <div class="form-group md-form mt-3">
                                    <label for="state" data-error="wrong" data-success="right">State</label>
                                    <select id="state" name="notification[state]" class="form-control">

                                        <?php

                                            foreach ( $states as $key => $state ) {?>


                                        <option value="<?php echo $state; ?>"><?php echo $state; ?></option>

                                        <?php }

                                            ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group md-form mt-3">
                                    <label for="zip_code" data-error="wrong" data-success="right">Zip Code</label>
                                    <input id="zip_code" type="text" name="notification[zip_code]" placeholder="Any"
                                        class="form-control" value="">
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Second Step -->

                    <div class="col-md-12">

                        <h3 class="font-weight-bold pl-0 my-4"><strong>Home Details</strong></h3>

                        <div class="form-group md-form">
                        </div>
                        <div class="form-group md-form">
                            <label for="property_type" data-error="wrong" data-success="right">Property Type</label>
                            <select id="property_type" name="notification[property_type]" class="form-control">

                                <?php

                                    foreach ( $property_types as $key => $property_type ) {?>

                                <option value="<?php echo $property_type; ?>"><?php echo $property_type; ?></option>

                                <?php }

                                    ?>

                            </select>
                        </div>
                        <!-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="home_size" data-error="wrong" data-success="right">Home Size (SqFt)</label>
                                        <input step="any" id="home_size" type="number" name="notification[home_size]" placeholder="Any"
                                        class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="lot_size" data-error="wrong" data-success="right">Lot Size (Acres)</label>
                                        <input step="any" id="lot_size" type="number" name="notification[lot_size]" placeholder="Any"
                                        class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="year_built" data-error="wrong" data-success="right">Year Built</label>
                                        <input step="any" id="year_built" type="number" name="notification[year_built]" placeholder="Any"
                                        class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="bedrooms" data-error="wrong" data-success="right">Bedrooms</label>
                                        <input step="any" id="bedrooms" type="number" name="notification[bedrooms]" placeholder="Any"
                                        class="form-control" value="Any">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="bathrooms" data-error="wrong" data-success="right">Bathrooms</label>
                                        <input step="any" id="bathrooms" type="number" name="notification[bathrooms]" placeholder="Any"
                                        class="form-control" value="">
                                    </div>
                                </div>
                            </div> -->

                    </div>




                    <div class="col-md-12">
                        <h3 class="font-weight-bold pl-0 my-4"><strong>Final Offer</strong></h3>
                    </div>
                    <div class="col-md-6">

                        <div class="half form-group md-form">
                            <label for="min-price" data-error="wrong" data-success="right">Min price</label>
                            <div class="dokan-form-group">
                                <div class="dokan-input-group">
                                    <span
                                        class="dokan-input-group-addon"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                    <input id="min-price" type="number" name="notification[min_price]" placeholder="Any"
                                        class="wc_input_price form-control validate" value="">
                                </div>
                            </div>


                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="half form-group md-form">
                            <label for="min-price" data-error="wrong" data-success="right">Max price</label>
                            <div class="dokan-form-group">
                                <div class="dokan-input-group">
                                    <span
                                        class="dokan-input-group-addon"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                    <input id="max-price" type="number" name="notification[max_price]" placeholder="Any"
                                        class="wc_input_price form-control validate" value="">
                                </div>
                            </div>


                        </div>

                    </div>


                    <!-- Final Step -->
                    <div class="col-md-12">

                        <div class="form-group md-form mt-3">
                            <label for="search_name" data-error="wrong" data-success="right">Search name</label>
                            <input id="search_name" type="text" name="notification[search_name]"
                                placeholder="Search name" class="form-control" value="">
                        </div>

                        <div class="form-check md-form mt-3">
                            <label for="notification[notification_check]" data-error="wrong" data-success="right">If
                                You Get
                                Email Notifications When a New Property Arrives in That Search</label>
                            <input id="checkbox" type="checkbox" name="notification[notification_check]" value="true"
                                class="form-check-input validate">
                        </div>


                        <div class="dokan-form-group">

                            <input type="hidden" name="action" value="update_search" />
                            <input type="hidden" id="id" name="id" value="" />
                            <?php wp_nonce_field( 'update_notification_nonce', 'update_search_nonce' );?>
                            <input type="submit" id="update_btn" name="update_btn"
                                class="btn dokan-btn-theme dokan-btn-lg"
                                value="<?php esc_attr_e( 'Update settings', 'dokan' );?>" />
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    (function($) {

        var add_notification = $('#notification-form');
        var update_notification = $('#notification-form-modal');
        var delete_search = $('.delete');
        var edit_search = $('.edit');

        delete_search.on('click', function(e) {

            e.preventDefault();

            var id = $(this).data('id');

            console.log(id);

            wp.ajax.send('delete_search', {
                beforeSend: function(xhr) {
                    // Set nonce here
                    xhr.setRequestHeader('X-WP-Nonce', RIS_Notify.nonce);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Being delete...',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                    });
                },
                // Build post data.
                // If method is "delete", data should be passed as query params.
                data: {
                    id: id
                }
            }).done(function(response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your settings has been removed',
                    showConfirmButton: false,
                    timer: 2000
                });

                window.location.reload(true);
            }).fail(function(response) {

                console.log(response);

            }).always(function() {

            });

        });

        edit_search.on('click', function(e) {
            var edit_form = $('#notification-form-modal');
            // form fields

            var input_id = $('input#id');
            var city = $('input#city');
            var state = $('select#state');
            var zip_code = $('input#zip_code');
            var property_type = $('select#property_type');
            var home_size = $('input#home_size');
            var lot_size = $('input#lot_size');
            var year_built = $('input#year_built');
            var bedrooms = $('input#bedrooms');
            var bathrooms = $('input#bathrooms');
            var min_price = $('input#min-price');
            var max_price = $('input#max-price');
            var search_name = $('input#search_name');
            var checkbox = $('input#checkbox');

            e.preventDefault();

            var id = $(this).data('id');
            console.log(id);
            wp.ajax.send('edit_search', {
                beforeSend: function(xhr) {
                    // Set nonce here
                    xhr.setRequestHeader('X-WP-Nonce', RIS_Notify.nonce);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Opening edit form...',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true,
                    });
                },
                // Build post data.
                // If method is "delete", data should be passed as query params.
                data: {
                    id: id
                }
            }).done(function(response) {
                var notify = response.edited_data;
                console.log(notify);
                console.log(city);

                input_id.val(notify.id);
                bathrooms.val(notify.bathrooms);
                bedrooms.val(notify.bedrooms);
                city.val(notify.city);
                home_size.val(notify.home_size);
                lot_size.val(notify.lot_size);
                max_price.val(notify.max_price);
                min_price.val(notify.min_price);
                property_type.val(notify.property_type).change();
                search_name.val(notify.search_name);
                state.val(notify.state).change();
                year_built.val(notify.year_built);
                zip_code.val(notify.zip_code);
                checkbox.prop('checked', notify.notification_check);

            }).fail(function(response) {

                console.log(response);

            }).always(function() {

            });

        });

        add_notification.on('submit', function(e) {

            e.preventDefault();

            var city = $('input#city');
            var state = $('select#state');
            var valid = true;

            if (city.val() != '' && state.val() == 'Any') {
                console.log(city.val());
                console.log(state.val());
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'State is required with city',
                    showConfirmButton: false,
                    timer: 2000
                });

                //$(":submit").attr("disabled", true);
                valid = false;


            } else {
                // $(":submit").removeAttr("disabled");
                valid = true;
            }

            console.log(valid);

            var data = $(this).serialize();



            if (valid) {
                $.ajax({
                    url: RIS_Notify.ajaxurl,
                    method: 'POST',
                    beforeSend: function(xhr) {
                        // Set nonce here
                        xhr.setRequestHeader('X-WP-Nonce', RIS_Notify.nonce);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Being saved...',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                        });
                    },
                    // Build post data.
                    // If method is "delete", data should be passed as query params.
                    data: data
                }).done(function(response) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Your settings has been saved',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    console.log(response);
                    window.location.reload(true);
                }).fail(function(response) {


                }).always(function() {

                });
            }

        });

        update_notification.on('submit', function(e) {

            e.preventDefault();

            var data = $(this).serialize();

            $.ajax({
                url: RIS_Notify.ajaxurl,
                method: 'POST',
                beforeSend: function(xhr) {
                    // Set nonce here
                    xhr.setRequestHeader('X-WP-Nonce', RIS_Notify.nonce);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Being saved...',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                    });
                },
                // Build post data.
                // If method is "delete", data should be passed as query params.
                data: data
            }).done(function(response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your settings has been saved',
                    showConfirmButton: false,
                    timer: 2000
                });
                console.log(response);
                window.location.reload(true);
            }).fail(function(response) {


            }).always(function() {

            });

        });





    })(jQuery);
    </script>

    <?php

        }

        add_action( 'wp_ajax_notification_settings', 'notification_settings' );

        function notification_settings() {

            $user_id = get_current_user_id();

        // if ( ! wp_verify_nonce( $_REQUEST['product_notification_nonce'], 'product_notification_nonce' ) ) {

        //     wp_send_json_error([

        //         'message' => 'Verification failed'

        //     ],400);
            // }

            $notification_settings                                       = isset( $_REQUEST ) ? $_REQUEST : '';
            $notification_check                                          = isset( $_REQUEST['notification']['notification_check'] ) ? $_REQUEST['notification']['notification_check'] : false;
            $notification_settings['notification']['notification_check'] = $notification_check;

            add_user_meta( $user_id, 'notification_settings', $notification_settings['notification'], false );
            add_user_meta( $user_id, '_user_role', 'investor', true );

            $user = get_user_meta( $user_id, 'notification_settings' );

            wp_send_json_success( [
                'message' => 'Notification settings updated',
                'notify'  => $user,
            ] );

            exit;
        }

        add_action( 'wp_ajax_delete_search', 'delete_search' );

        function delete_search() {

            $user_id = get_current_user_id();

        // if ( ! wp_verify_nonce( $_REQUEST['product_notification_nonce'], 'product_notification_nonce' ) ) {

        //     wp_send_json_error([

        //         'message' => 'Verification failed'

        //     ],400);
            // }

            $id       = isset( $_REQUEST['id'] ) ? $_REQUEST['id'] : '';
            $searches = get_user_meta( $user_id, 'notification_settings', false );

            $deleted_search = $searches[$id];

            delete_user_meta( $user_id, 'notification_settings', $searches[$id] );

            wp_send_json_success( [
                'message'      => 'Search settings removed',
                'deleted_data' => $deleted_search,
            ] );

            exit;
        }

        add_action( 'wp_ajax_edit_search', 'edit_search' );

        function edit_search() {

            $user_id = get_current_user_id();

        // if ( ! wp_verify_nonce( $_REQUEST['product_notification_nonce'], 'product_notification_nonce' ) ) {

        //     wp_send_json_error([

        //         'message' => 'Verification failed'

        //     ],400);
            // }

            $id       = isset( $_REQUEST['id'] ) ? $_REQUEST['id'] : '';
            $searches = get_user_meta( $user_id, 'notification_settings', false );

            $edit_search       = $searches[$id];
            $edit_search['id'] = $id;

            if ( is_vendor_subscribed_pack( 6793 ) ) {
                //delete_user_meta($user_id, 'notification_settings', $searches[$id]);

            }

            wp_send_json_success( [
                'message'     => 'Search settings fetched',
                'edited_data' => $edit_search,
            ] );

            exit;
        }

        add_action( 'wp_ajax_update_search', 'update_search' );

        function update_search() {

            $user_id = get_current_user_id();

        // if ( ! wp_verify_nonce( $_REQUEST['product_notification_nonce'], 'product_notification_nonce' ) ) {

        //     wp_send_json_error([

        //         'message' => 'Verification failed'

        //     ],400);
            // }

            $id           = isset( $_REQUEST['id'] ) ? $_REQUEST['id'] : '';
            $updated_data = isset( $_REQUEST['id'] ) ? $_REQUEST['notification'] : '';

            $searches = get_user_meta( $user_id, 'notification_settings', false );

            //delete_user_meta($user_id, 'notification_settings', $searches[$id]);
            update_user_meta( $user_id, 'notification_settings', $updated_data, $searches[$id] );

            wp_send_json_success( [
                'message'      => 'Search settings updated',
                'updated_data' => $searches,
            ] );

            exit;
        }

        add_action( 'wp_ajax_filter_search', 'filter_search' );

        function filter_search() {

            $_city          = isset( $_REQUEST['_city'] ) ? $_REQUEST['_city'] : '';
            $_state         = isset( $_REQUEST['_state'] ) && $_REQUEST['_state'] != 'Any' ? $_REQUEST['_state'] : '';
            $_zip_code      = isset( $_REQUEST['_zip_code'] ) ? $_REQUEST['_zip_code'] : '';
            $_property_type = isset( $_REQUEST['_property_type'] ) && $_REQUEST['_property_type'] != 'Any' ? $_REQUEST['_property_type'] : '';
            $_min_price     = isset( $_REQUEST['_min_price'] ) ? $_REQUEST['_min_price'] : '';
            $_max_price     = isset( $_REQUEST['_max_price'] ) ? $_REQUEST['_max_price'] : '';

            $args = array(
                'posts_per_page' => -1,
                'orderby'        => 'post_date',
                'order'          => 'DESC',
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'tax_query'      => array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug', // Or 'name' or 'term_id'
                    'terms' => array( 'Subscription' ),
                    'operator' => 'NOT IN', // Excluded
                ),
                'meta_query'     => array(
                    array(
                        'key'     => '_zip_code',
                        'value'   => $_zip_code,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_city',
                        'value'   => $_city,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_state',
                        'value'   => $_state,
                        'compare' => 'LIKE',
                    ),
                    array(
                        'key'     => '_price',
                        'value'   => [$_min_price, $_max_price],
                        'compare' => 'BETWEEN',
                        'type'    => 'NUMERIC',
                    ),
                    array(
                        'key'     => '_property_type',
                        'value'   => $_property_type,
                        'compare' => 'LIKE',
                    ),

                ),
            );

            $query     = new WP_Query( $args );
            $count     = $query->post_count;
            $blogposts = $query->posts;

            $html = '';

            if ( $count ) {
                $html .= '<ul>';

                // ALL WOOCOMMERCE AVAILABLE ATTRIBUTES
                $all_available_attributes = array();
                $taxonomy_terms           = array();
                $attribute_taxonomies     = wc_get_attribute_taxonomies();

                if ( $attribute_taxonomies ) {

                    foreach ( $attribute_taxonomies as $tax ) {
                        array_push( $all_available_attributes, $tax->attribute_name );
                    }

                }

                $attributes_to_list = array();

                if ( $attribute ) {
                    $attributes_to_list = explode( ',', $attribute );
                }

        // echo '<pre>' . var_export($attributes_to_list, true) . '</pre>';

                foreach ( $blogposts as $blogpost ) {
                    $url = is_user_logged_in() ? esc_url( get_permalink( $blogpost->ID ) ) : '';

                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ), 'ibid_portfolio_pic400x400' );

                    $categories_list = wp_get_post_terms( $blogpost->ID, 'product_cat' );
                    $cat_slugs       = implode( ' ', wp_list_pluck( $categories_list, 'slug' ) );

                    $tags_list  = wp_get_post_terms( $blogpost->ID, 'product_tag' );
                    $tags_slugs = implode( ' ', wp_list_pluck( $tags_list, 'slug' ) );

                    if ( $thumbnail_src ) {
                        $post_img = '<img class="portfolio_post_image" src="' . esc_url( $thumbnail_src[0] ) . '" alt="' . $blogpost->post_title . '" />';
                        $post_col = 'col-md-12';
                    } else {
                        $post_col = 'col-md-12 no-featured-image';
                        $post_img = '';
                    }

                    global $product;
                    $attributes_final = '';
                    $all_product_attr = get_post_meta( $blogpost->ID, '_product_attributes', true );
                    if ( $all_product_attr ) {
                        foreach ( $all_product_attr as $attr ) {
                            $attributes = wc_get_product_terms( $blogpost->ID, $attr['name'], array( 'fields' => 'all' ) );
                            if ( $attributes ) {
                                foreach ( $attributes as $single_attr_value ) {
                                    $attributes_final .= $single_attr_value->slug . ' ';
                                }

                            }

                        }

                    }

                    $html .= '<li id="product-id-' . esc_attr( $blogpost->ID ) . '" class="mix ' . esc_attr( $blogpost->post_title ) . '" style="display: inline-block;">
                            <div class="col-md-12 post ">
                            <div class="product-wrapper">
                            <div class="thumbnail-and-details">
                                <a class="woo_catalog_media_images" title="' . esc_attr( $blogpost->post_title ) . '" href="' . $url . '"> ' . $post_img . '</a>
                            </div>
                            <div class="woocommerce-title-metas">
                                <h3 class="archive-product-title">
                                <a href="' . $url . '" title="' . $blogpost->post_title . '">' . $blogpost->post_title . '</a>
                                </h3>';

                    if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                        $product = wc_get_product( $blogpost->ID );
                        // metas
                        $meta_auction_current_bid = get_post_meta( $blogpost->ID, '_auction_current_bid', true );
                        $meta_auction_start_price = get_post_meta( $blogpost->ID, '_auction_start_price', true );
                        $meta_auction_closed      = get_post_meta( $blogpost->ID, '_auction_closed', true );

                        if ( $product->post_type !== 'auction' ) {

                            if ( $meta_auction_closed == '' ) {

                                if ( $meta_auction_current_bid ) {
                                    $html .= '<p>' . esc_html__( 'Current bid: ', 'modeltheme' ) . '' . wc_price( $meta_auction_current_bid ) . '</p>';
                                    $html .= '<p>' . esc_html__( 'Expires on: ', 'modeltheme' ) . ' <span class="end_date_prod">' . date_i18n( get_option( 'date_format' ), strtotime( $product->get_auction_end_time() ) ) . '</span></p>';
                                    $html .= '<div class="button-bid text-center">
                                                    <a href ="' . $url . '">' . esc_html__( 'Bid Now', 'modeltheme' ) . '</a>
                                                </div>';
                                } else

                                if ( $meta_auction_start_price ) {
                                    $html .= '<p>' . esc_html__( 'Starting bid: ', 'modeltheme' ) . '' . wc_price( $meta_auction_start_price ) . '</p>';
                                    $html .= '<p>' . esc_html__( 'Expires on: ', 'modeltheme' ) . ' <span class="end_date_prod">' . date_i18n( get_option( 'date_format' ), strtotime( $product->get_auction_end_time() ) ) . '</span></p>';
                                    $html .= '<div class="button-bid text-center">
                                                    <a href ="' . $url . '">' . esc_html__( 'Bid Now', 'modeltheme' ) . '</a>
                                                </div>';
                                }

                            } else {
                                $html .= '<p class="price">' . esc_html__( 'Auction closed', 'modeltheme' ) . '</p>';
                            }

                        }

                    }

                    $html .= '</div>

                            </div>
                            </div>
                        </li>';
                }

                $html .= '</ul>';
            } else {

                $html .= '<div class="cd-fail-message" style="font-size: 20px;display: flex;justify-content: center;align-items: center;height: 50vh;">No results found <i style="margin-left:10px" class="far fa-sad-tear"></i></div>';
            }

            wp_send_json_success( [
                'message' => 'Filter updated',
                'data'    => "$html",
                'count'   => $count,
            ] );

            exit;
        }

        function hide_menu_item_depending_packages() {

            if ( is_vendor_subscribed_pack( 6792 ) ) { // seller
            ?>
    <style type="text/css">
    form.auction_form.cart {
        display: none !important;
    }

    form.buy-now.cart {
        display: none !important;
    }

    .elementor-nav-menu li:nth-child(1) {
        display: block;
    }

    .elementor-nav-menu li:nth-child(2) {
        display: none;
    }

    .elementor-nav-menu li:nth-child(3) {
        display: none;
    }


    .subscription:nth-child(1) {
        display: block;
    }

    .subscription:nth-child(2) {
        display: none;
    }

    .subscription:nth-child(3) {
        display: none;
    }
    </style>
    <?php
        }

            if ( is_vendor_subscribed_pack( 6793 ) ) { // investor
            ?>
    <style type="text/css">
    .elementor-nav-menu li:nth-child(1) {
        display: none;
    }

    .elementor-nav-menu li:nth-child(2) {
        display: block;
    }

    .elementor-nav-menu li:nth-child(3) {
        display: none;
    }



    .subscription:nth-child(1) {
        display: none;
    }

    .subscription:nth-child(2) {
        display: none;
    }

    .subscription:nth-child(3) {
        display: block;
    }
    </style>
    <?php
        }

            if ( is_vendor_subscribed_pack( 6795 ) ) { // realtor
            ?>
    <style type="text/css">
    li.settings {
        display: none;
    }

    li.orders {
        display: none;
    }

    li.store {
        display: none;
    }

    ul.dokan-dashboard-menu li.dokan-common-links {
        display: none !important;
    }

    li.dokan-common-link {
        display: none !important;
    }



    li.subscription {
        display: none !important;
    }

    li.reports {
        display: none !important;
    }

    .menu-item-7941 {
        display: none !important;
    }

    form.auction_form.cart {
        display: none !important;
    }

    form.buy-now.cart {
        display: none !important;
    }

    .elementor-nav-menu li:nth-child(1) {
        display: none;
    }

    .elementor-nav-menu li:nth-child(2) {
        display: none;
    }

    .elementor-nav-menu li:nth-child(3) {
        display: block;
    }



    .subscription:nth-child(1) {
        display: none;
    }

    .subscription:nth-child(2) {
        display: block;
    }

    .subscription:nth-child(3) {
        display: none;
    }
    </style>
    <?php
        }

            if ( is_vendor_subscribed_pack( 7952 ) ) { // home buyer
            ?>
    <style type="text/css">
    .elementor-nav-menu li:nth-child(1) {
        display: none;
    }

    .elementor-nav-menu li:nth-child(2) {
        display: none;
    }

    .elementor-nav-menu li:nth-child(3) {
        display: none;
    }

    .elementor-nav-menu li:nth-child(3) {
        display: block;
    }
    </style>
    <?php
        }

        }

        add_action( 'wp_head', 'hide_menu_item_depending_packages' );

        add_filter( 'wc_order_statuses', 'wc_renaming_order_status', 15 );
        function wc_renaming_order_status( $order_statuses ) {

            foreach ( $order_statuses as $key => $status ) {

                if ( 'wc-completed' === $key ) {
                    $order_statuses['wc-processing'] = _x( 'Active', 'Order status', 'woocommerce' );
                }

            }

            return $order_statuses;
        }

        function update_dokan_dashboard_wrap_start() {
        ?>
    <?php
    $args = array(
            'posts_per_page' => 1,
            'orderby'        => 'post_date',
            'order'          => 'DESC',
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id', // Or 'name' or 'term_id'
                    'terms' => array( 245 ),
                    'operator' => 'NOT IN', // Excluded
                ),
            ),

        );
        $query     = new WP_Query( $args );
        $blogposts = $query->posts;

        foreach ( $blogposts as $blogpost ) {

            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ), 'ibid_portfolio_pic400x400' );

            if ( $thumbnail_src ) {
                $post_img = '<img class="portfolio_post_image" src="' . esc_url( $thumbnail_src[0] ) . '" alt="' . $blogpost->post_title . '" />';
                $post_col = 'col-md-12';
            } else {
                $post_col = 'col-md-12 no-featured-image';
                $post_img = '';
            }

        ?>



    <div class="banner_ad right">

        <div class="col-md-12 post ">
            <div class="product-wrapper">
                <div class="thumbnail-and-details">
                    <a class="woo_catalog_media_images" title="<?php echo esc_attr( $blogpost->post_title ) ?>"
                        href="<?php echo is_user_logged_in() ? esc_url( get_permalink( $blogpost->ID ) ) : '' ?>">
                        <?php echo $post_img ?></a>
                </div>
                <div class="woocommerce-title-metas">
                    <h3 class="archive-product-title">
                        <a href="<?php echo is_user_logged_in() ? esc_url( get_permalink( $blogpost->ID ) ) : '' ?>"
                            title="<?php echo $blogpost->post_title ?>"><?php echo $blogpost->post_title ?></a>
                    </h3>


                    <?php

                                if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                                    $product = wc_get_product( $blogpost->ID );
                                    // metas
                                    $meta_auction_current_bid = get_post_meta( $blogpost->ID, '_auction_current_bid', true );
                                    $meta_auction_start_price = get_post_meta( $blogpost->ID, '_auction_start_price', true );
                                    $meta_auction_closed      = get_post_meta( $blogpost->ID, '_auction_closed', true );

                                    if ( $product->post_type !== 'auction' ) {

                                        if ( $meta_auction_closed == '' ) {

                                            if ( $meta_auction_current_bid ) {
                                            ?>

                    <p><?php echo esc_html__( 'Current bid: ', 'modeltheme' ) . '' . wc_price( $meta_auction_current_bid ) ?>
                    </p>
                    <p><?php echo esc_html__( 'Expires on: ', 'modeltheme' ) ?> <span
                            class="end_date_prod"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $product->get_auction_end_time() ) ) ?></span>
                    </p>
                    <div class="button-bid">
                        <a class="octf-btn"
                            href="<?php echo esc_url( get_permalink( $blogpost->ID ) ); ?>"><?php echo esc_html__( 'More Details', 'modeltheme' ) ?></a>
                    </div>
                    <?php
                        } else

                                            if ( $meta_auction_start_price ) {
                                            ?>

                    <p><?php echo esc_html__( 'Starting bid: ', 'modeltheme' ) . '' . wc_price( $meta_auction_start_price ) ?>
                    </p>
                    <p><?php echo esc_html__( 'Expires on: ', 'modeltheme' ) ?> <span
                            class="end_date_prod"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $product->get_auction_end_time() ) ) ?>
                        </span></p>
                    <div class="button-bid">
                        <a class="octf-btn"
                            href="<?php echo is_user_logged_in() ? esc_url( get_permalink( $blogpost->ID ) ) : '' ?>"><?php echo esc_html__( 'More Details', 'modeltheme' ) ?></a>
                    </div>
                    <?php
                        }

                                        } else {
                                        ?>
                    <p class="price"><?php echo esc_html__( 'Auction closed', 'modeltheme' ) ?></p>
                    <?php
                        }

                                    }

                                }

                            ?>
                </div>

            </div>
        </div>
    </div>

    <!-- id="product-id-<?php //echo esc_attr( $blogpost->ID ) ?>"  -->

    <div class="banner_ad left">

        <div class="col-md-12 post ">
            <div class="product-wrapper">
                <div class="thumbnail-and-details">
                    <a class="woo_catalog_media_images" title="<?php echo esc_attr( $blogpost->post_title ) ?>"
                        href="<?php echo is_user_logged_in() ? esc_url( get_permalink( $blogpost->ID ) ) : '' ?>">
                        <?php echo $post_img ?></a>
                </div>
                <div class="woocommerce-title-metas">
                    <h3 class="archive-product-title">
                        <a href="<?php echo is_user_logged_in() ? esc_url( get_permalink( $blogpost->ID ) ) : '' ?>"
                            title="<?php echo $blogpost->post_title ?>"><?php echo $blogpost->post_title ?></a>
                    </h3>


                    <?php

                                if ( class_exists( 'WooCommerce_simple_auction' ) ) {
                                    $product = wc_get_product( $blogpost->ID );
                                    // metas
                                    $meta_auction_current_bid = get_post_meta( $blogpost->ID, '_auction_current_bid', true );
                                    $meta_auction_start_price = get_post_meta( $blogpost->ID, '_auction_start_price', true );
                                    $meta_auction_closed      = get_post_meta( $blogpost->ID, '_auction_closed', true );

                                    if ( $product->post_type !== 'auction' ) {

                                        if ( $meta_auction_closed == '' ) {

                                            if ( $meta_auction_current_bid ) {
                                            ?>

                    <p><?php echo esc_html__( 'Current bid: ', 'modeltheme' ) . '' . wc_price( $meta_auction_current_bid ) ?>
                    </p>
                    <p><?php echo esc_html__( 'Expires on: ', 'modeltheme' ) ?> <span
                            class="end_date_prod"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $product->get_auction_end_time() ) ) ?></span>
                    </p>
                    <div class="button-bid">
                        <a class="octf-btn"
                            href="<?php echo esc_url( get_permalink( $blogpost->ID ) ); ?>"><?php echo esc_html__( 'More Details', 'modeltheme' ) ?></a>
                    </div>
                    <?php
                        } else

                                            if ( $meta_auction_start_price ) {
                                            ?>

                    <p><?php echo esc_html__( 'Starting bid: ', 'modeltheme' ) . '' . wc_price( $meta_auction_start_price ) ?>
                    </p>
                    <p><?php echo esc_html__( 'Expires on: ', 'modeltheme' ) ?> <span
                            class="end_date_prod"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $product->get_auction_end_time() ) ) ?>
                        </span></p>
                    <div class="button-bid">
                        <a class="octf-btn"
                            href="<?php echo is_user_logged_in() ? esc_url( get_permalink( $blogpost->ID ) ) : '' ?>"><?php echo esc_html__( 'More Details', 'modeltheme' ) ?></a>
                    </div>
                    <?php
                        }

                                        } else {
                                        ?>
                    <p class="price"><?php echo esc_html__( 'Auction closed', 'modeltheme' ) ?></p>
                    <?php
                        }

                                    }

                                }

                            ?>
                </div>

            </div>
        </div>
    </div>


    <?php }

        ?>

    <?php

        }

        function paid_ads() {
        ?>

    <?php
    if ( is_vendor_subscribed_pack( 6793 ) ) { // investor ?>
    <a href="https://www.bcgreferralgroup.com/real-estate-attorney-conway-law/" target="_blank" class="top_banner"><img
            src="https://wordpress-582935-1887470.cloudwaysapps.com/wp-content/uploads/2021/04/Group-3.jpg" /></a>
    <?php }
        ?>

    <?php
    if ( is_vendor_subscribed_pack( 6792 ) ) { // seller ?>
    <a href="https://www.mattsmoving.com/" target="_blank" class="top_banner"><img
            src="https://wordpress-582935-1887470.cloudwaysapps.com/wp-content/uploads/2021/04/seller.jpg" /></a>
    <?php }
        ?>

    <?php
    if ( is_vendor_subscribed_pack( 6795 ) ) { // realtor ?>
    <a href="http://bluecrabinspections.com/" target="_blank" class="top_banner"><img
            src="https://wordpress-582935-1887470.cloudwaysapps.com/wp-content/uploads/2021/04/inspection.png" /></a>
    <?php }
        ?>

    <?php
        }

        add_action( 'dokan_dashboard_wrap_start', 'update_dokan_dashboard_wrap_start' );
        add_action( 'dokan_dashboard_wrap_start', 'paid_ads' );
        //add_action( 'dokan_dashboard_wrap_end', 'update_dokan_dashboard_wrap_start' );

        function accept_offer() {
            $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : '';

            update_post_meta( $id, 'offer_accepted_by_seller', 'yes' );
            ob_start();
        ?>
    <div class="ot-button">
        <a href="#" class="octf-btn octf-btn-primary octf-btn-icon">Offer accepted by you.<span> <i
                    class="flaticon-right-arrow-1"></i></span>
        </a>
    </div>
    <?php

            $accepted = ob_get_clean();

            wp_send_json_success( $accepted );
        }

        add_action( 'wp_ajax_accept_offer', 'accept_offer' );

        function reject_offer() {
            $id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : '';

            update_post_meta( $id, 'offer_accepted_by_seller', 'no' );

            ob_start();
        ?>
    <div class="ot-button">
        <a href="#" class="octf-btn octf-btn-primary octf-btn-icon">Offer rejected by you.<span> <i
                    class="flaticon-right-arrow-1"></i></span>
        </a>
    </div>
    <?php

            $rejected = ob_get_clean();

            wp_send_json_success( $rejected );
        }

        add_action( 'wp_ajax_reject_offer', 'reject_offer' );

        add_filter( 'dokan_query_var_filter', 'dokan_load_document_menu', 99 );

        function dokan_load_document_menu( $query_vars ) {

            $query_vars['tools']             = 'tools';
            $query_vars['store']             = 'store';
            $query_vars['referral']          = 'referral';
            $query_vars['affiliatesettings'] = 'affiliatesettings';
            $query_vars['commissions']       = 'commissions';
            $query_vars['clicks']            = 'clicks';
            $query_vars['generate']          = 'generate';

            return $query_vars;
        }

        add_filter( 'dokan_get_dashboard_nav', 'dokan_add_help_menu' );

        function dokan_add_help_menu( $urls ) {

            $urls['tools'] = array(
                'title' => __( 'Tools', 'dokan' ),
                'icon'  => '<i class="fas fa-tools"></i>',
                'url'   => dokan_get_navigation_url( 'tools' ),
                'pos'   => 51,
            );

            $urls['store'] = array(
                'title' => __( 'Store', 'dokan' ),
                'icon'  => '<i class="fas fa-shopping-cart"></i>',
                'url'   => dokan_get_navigation_url( 'store' ),
                'pos'   => 51,
            );

            if ( is_vendor_subscribed_pack( 6795 ) ) {
                $urls['referral'] = array(
                    'title' => __( 'Referral', 'dokan' ),
                    'icon'  => '<i class="fa fa-handshake-o"></i>',
                    'url'   => dokan_get_navigation_url( 'referral' ),
                    'pos'   => 52,
                );

            }

            return $urls;

        }

        function dokan_load_template( $query_vars ) {

            if ( isset( $query_vars['tools'] ) ) {
                require_once dirname( __FILE__ ) . '/tools.php';
            }

            if ( isset( $query_vars['store'] ) ) {
                require_once dirname( __FILE__ ) . '/store.php';
            }

            if ( isset( $query_vars['referral'] ) ) {
                require_once dirname( __FILE__ ) . '/affiliate/affiliate.php';
            }

            if ( isset( $query_vars['commissions'] ) ) {
                require_once dirname( __FILE__ ) . '/affiliate/commissions.php';
            }

            if ( isset( $query_vars['clicks'] ) ) {
                require_once dirname( __FILE__ ) . '/affiliate/clicks.php';
            }

            if ( isset( $query_vars['generate'] ) ) {
                require_once dirname( __FILE__ ) . '/affiliate/generate_link.php';
            }

            if ( isset( $query_vars['payments'] ) ) {
                require_once dirname( __FILE__ ) . '/affiliate/payments.php';
            }

            if ( isset( $query_vars['affiliatesettings'] ) ) {
                require_once dirname( __FILE__ ) . '/affiliate/settings.php';
            }

        }

        add_action( 'dokan_load_custom_template', 'dokan_load_template' );

        function ajax_save_add_product_meta() {

            global $woocommerce_auctions;

            $product_id = isset( $_POST['dokan_product_id'] ) && ! empty( $_POST['dokan_product_id'] ) ? absint( $_POST['dokan_product_id'] ) : 0;

            $seller_id = dokan_get_current_user_id();

            if ( empty( $product_id ) ) {

                $post_title   = isset( $_POST['post_title'] ) ? trim( $_POST['post_title'] ) : '';
                $post_content = isset( $_POST['post_content'] ) ? trim( $_POST['post_content'] ) : '';
                $post_excerpt = isset( $_POST['post_excerpt'] ) ? trim( $_POST['post_excerpt'] ) : '';
                //$product_cat    = isset( $_POST['product_cat'] ) ? absint( $_POST['product_cat'] ) : '';
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
                }

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

                    //'post_content'   => $_POST['post_content'],
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

        add_action( 'wp_ajax_update_product_meta', 'ajax_save_add_product_meta' );

        function ajax_investor_purchase_history( $start_date, $end_date ) {

        }

        function ajax_filter_report() {

            /** Response  */
            global $wpdb;
            global $post;

            $start_date = date( 'Y-m-d', strtotime( $_REQUEST['start_date'] ) );
            $end_date   = date( 'Y-m-d', strtotime( $_REQUEST['end_date'] ) );

            ob_start();

            if ( is_vendor_subscribed_pack( 6793 ) ) {

                $args = array(
                    'numberposts' => -1,
                    'meta_key'    => '_customer_user',
                    'meta_value'  => dokan_get_current_user_id(),
                    'post_type'   => wc_get_order_types(),
                    'post_status' => array_keys( wc_get_is_paid_statuses() ),
                    'date_query'  => array(
                        array(
                            'after'     => $start_date,
                            'before'    => $end_date,
                            'inclusive' => true,
                        ),
                    ),
                );

                // Pass the $args to get_posts() function
                $customer_orders = get_posts( $args );

                // loop through the orders and return the IDs
                $product_ids = array();

                foreach ( $customer_orders as $customer_order ) {
                    $order = wc_get_order( $customer_order->ID );
                    $items = $order->get_items();

                    foreach ( $items as $item ) {
                        $product_id = $item->get_product_id();
                        array_push( $product_ids, absint( $product_id ) );
                    }

                }

        //var_dump( $product_ids );
                if ( ! empty( $product_ids ) ) {
                ?>
    <article class="dokan-product-listing-area">


        <table class="dokan-table table-striped product-listing-table">
            <thead>
                <tr style="background:#FF4900 !important;color:#ffffff !important">
                    <th><?php _e( 'Image', 'dokan' );?></th>
                    <th><?php _e( 'Address', 'dokan' );?></th>
                    <th><?php _e( 'Status', 'dokan' );?></th>
                    <th><?php _e( 'Listing Number', 'dokan' );?></th>

                    <th><?php _e( 'Price', 'dokan' );?></th>
                    <th><?php _e( 'Type', 'dokan' );?></th>
                    <th><?php _e( 'Views', 'dokan' );?></th>
                    <th><?php _e( 'Date', 'dokan' );?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //$product_ids = [];
                                //var_dump( $product_ids );

                                $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;

                                $args = [
                                    'orderby'            => 'post_date',
                                    'order'              => 'DESC',
                                    'post__not_in'       => array( 6793 ),
                                    'posts_per_page'     => -1,
                                    'tax_query'          => [['taxonomy' => 'product_type', 'field' => 'slug', 'terms' => 'auction']],
                                    'auction_archive'    => true,
                                    'show_past_auctions' => true,
                                    'paged'              => $pagenum,
                                    'post__in'           => $product_ids,
                                ];

                    //$auctions = new WP_Query( $args );
                                //get_posts($args)
                                $product_query = new WP_Query( $args );

                    //echo '<pre>';

                    //var_dump( $product_query );

                    //var_dump($product_query);
                                if ( $product_query->have_posts() ) {
                                    while ( $product_query->have_posts() ) {
                                        $product_query->the_post();

                                        $tr_class = ( $post->post_status == 'pending' ) ? ' class="danger"' : '';
                                        $product  = dokan_wc_get_product( $post->ID );
                                    $edit_url = add_query_arg( ['product_id' => $post->ID, 'action' => 'edit'], dokan_get_navigation_url( 'auction' ) );?>
                <tr<?php echo $tr_class; ?>>
                    <td data-title="<?php esc_attr_e( 'Image', 'dokan' );?>" class="column-thumb">
                        <?php

                                            if ( current_user_can( 'dokan_edit_auction_product' ) ) {?>
                        <a href="<?php echo $edit_url; ?>"><?php echo $product->get_image(); ?></a>
                        <?php } else {?>
                        <a href="#"><?php echo $product->get_image(); ?></a>
                        <?php }

                                            ?>
                    </td>

                    <td class="column-primary">
                        <?php

                                            if ( current_user_can( 'dokan_edit_auction_product' ) ) {?>
                        <p><a href=""><?php
    $address_1 = get_post_meta( $post->ID, '_address_1', true ) != '' ? get_post_meta( $post->ID, '_address_1', true ) . ', ' : '';
                            $address_2 = get_post_meta( $post->ID, '_address_2', true ) != '' ? get_post_meta( $post->ID, '_address_2', true ) . ', ' : '';
                            $city      = get_post_meta( $post->ID, '_city', true ) != '' ? get_post_meta( $post->ID, '_city', true ) . ', ' : '';
                            $state     = get_post_meta( $post->ID, '_state', true ) != '' ? get_post_meta( $post->ID, '_state', true ) . ', ' : '';
                            $zip       = get_post_meta( $post->ID, '_zip_code', true ) != '' ? get_post_meta( $post->ID, '_zip_code', true ) : '';

                            echo $address_1 . $address_2 . $city . $state . $zip;

                        ?></a></p>
                        <?php }

                                            ?>

                        <div class="row-actions">
                            <?php

                                                if ( current_user_can( 'dokan_edit_auction_product' ) && ! is_vendor_subscribed_pack( 6793 ) ) {?>
                            <span class="edit"><a href="<?php echo $edit_url; ?>"><?php _e( 'Edit', 'dokan' );?></a>
                                | </span>
                            <?php }

                                                ?>

                            <?php

                                                if ( current_user_can( 'dokan_delete_auction_product' ) && ! is_vendor_subscribed_pack( 6793 ) ) {?>
                            <span class="delete"><a
                                    onclick="return confirm('<?php esc_attr_e( 'Are you sure want to delete?', 'dokan' );?>');"
                                    href="<?php echo wp_nonce_url( add_query_arg( ['action' => 'dokan-delete-auction-product', 'product_id' => $post->ID], dokan_get_navigation_url( 'auction' ) ), 'dokan-delete-auction-product' ); ?>"><?php _e( 'Delete Permanently', 'dokan' );?></a>
                                | </span>
                            <?php }

                                                ?>

                            <span class="view"><a href="<?php echo get_permalink( $product->get_id() ); ?>"
                                    rel="permalink"><?php _e( 'View', 'dokan' );?></a></span>
                        </div>

                        <button type="button" class="toggle-row"></button>
                    </td>

                    <td class="post-status" data-title="<?php esc_attr_e( 'Status', 'dokan' );?>">
                        <p style="color:#FF4900 !important" class="dokan-label">
                            <?php echo date_i18n( get_option( 'date_format' ), strtotime( $product->get_auction_end_time() ) ); ?>
                        </p>
                    </td>

                    <td data-title="<?php esc_attr_e( 'Listing Number', 'dokan' );?>">
                        <?php

                                            echo '#' . $product->get_id(); ?>
                    </td>


                    <td data-title="<?php esc_attr_e( 'Price', 'dokan' );?>">
                        <?php

                                                if ( $product->get_price_html() ) {
                                                    echo $product->get_price_html();
                                                } else {
                                                    echo '<span class="na">&ndash;</span>';
                                                }

                                            ?>
                    </td>

                    <td data-title="<?php esc_attr_e( 'Type', 'dokan' );?>">
                        <?php
                        $property_type = get_post_meta( $post->ID, '_property_type', true ) != '' ? get_post_meta( $post->ID, '_property_type', true ) : '';?>
                        <p style="color:#FF4900 !important" class="dokan-label"><?php echo $property_type; ?></p>


                    </td>

                    <td data-title="<?php esc_attr_e( 'Views', 'dokan' );?>">
                        <?php echo (int) get_post_meta( $post->ID, 'pageview', true ); ?>
                    </td>

                    <td class="post-date" data-title="<?php esc_attr_e( 'Date', 'dokan' );?>">
                        <?php

                                                if ( '0000-00-00 00:00:00' == $post->post_date ) {
                                                    $t_time    = $h_time    = __( 'Unpublished', 'dokan' );
                                                    $time_diff = 0;
                                                } else {
                                                    $t_time = get_the_time( __( 'Y/m/d g:i:s A', 'dokan' ) );
                                                    $m_time = $post->post_date;
                                                    $time   = get_post_time( 'G', true, $post );

                                                    $time_diff = time() - $time;

                                                    if ( $time_diff > 0 && $time_diff < 24 * 60 * 60 ) {
                                                        $h_time = sprintf( __( '%s ago', 'dokan' ), human_time_diff( $time ) );
                                                    } else {
                                                        $h_time = mysql2date( __( 'Y/m/d', 'dokan' ), $m_time );
                                                    }

                                                }

                                                echo '<abbr title="' . $t_time . '">' . apply_filters( 'post_date_column_time', $h_time, $post, 'date', 'all' ) . '</abbr>';
                                                echo '<br />';

                                                if ( 'publish' == $post->post_status ) {
                                                    _e( 'Published', 'dokan' );
                                                } elseif ( 'future' == $post->post_status ) {
                                                    if ( $time_diff > 0 ) {
                                                        echo '<strong class="attention">' . __( 'Missed schedule', 'dokan' ) . '</strong>';
                                                    } else {
                                                        _e( 'Scheduled', 'dokan' );
                                                    }

                                                } else {
                                                    _e( 'Last Modified', 'dokan' );
                                                }

                                            ?>
                    </td>
                    </tr>

                    <?php
                        }

                                    ?>

                    <?php
                    } else {?>
                    <tr>
                        <td colspan="9"><?php _e( 'No product found', 'dokan' );?></td>
                    </tr>
                    <?php }

                                ?>

            </tbody>

        </table>

        <?php
            wp_reset_postdata();

                        $pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;

                        if ( $product_query->max_num_pages > 1 ) {
                            echo '<div class="pagination-wrap">';
                            $page_links = paginate_links( [
                                'current'   => $pagenum,
                                'total'     => $product_query->max_num_pages,
                                'base'      => add_query_arg( 'pagenum', '%#%' ),
                                'format'    => '',
                                'type'      => 'array',
                                'prev_text' => __( '&laquo; Previous', 'dokan' ),
                                'next_text' => __( 'Next &raquo;', 'dokan' ),
                            ] );

                            echo '<ul class="pagination"><li>';
                            echo join( "</li>\n\t<li>", $page_links );
                            echo "</li>\n</ul>\n";
                            echo '</div>';
                        }

                    ?>
    </article>

    <?php
        } else {
                ?>
    <tr>
        <td colspan="9"><?php _e( 'No purchase found', 'dokan' );?></td>
    </tr>
    <?php
        }

                $response = ob_get_clean();
                wp_send_json_success( [
                    'filter'     => 2,
                    'start_date' => $start_date,
                    'end_date'   => $end_date,
                    'data'       => $response,
                ] );

            } else {
                $vendor          = dokan()->vendor->get( dokan_get_current_user_id() );
                $opening_balance = $vendor->get_balance( false, date( 'Y-m-d', strtotime( $start_date . ' -1 days' ) ) );
                $status          = implode( "', '", dokan_withdraw_get_active_order_status() );

                $sql = "SELECT * from {$wpdb->prefix}dokan_vendor_balance WHERE vendor_id = %d AND DATE(balance_date) >= %s AND
    DATE(balance_date) <= %s AND ( ( trn_type='dokan_orders' AND status IN ('{$status}') ) OR trn_type IN ( 'dokan_withdraw'
        , 'dokan_refund' ) ) ORDER BY balance_date";
                $statements = $wpdb->get_results( $wpdb->prepare(
                    $sql,
                    $vendor->id,
                    $start_date,
                    $end_date
            ) );?>

    <table class="table table-striped">
        <thead>
            <tr style="color:#fff">
                <th><?php _e( 'Balance Date', 'dokan' );?></th>
                <th><?php _e( 'Trn Date', 'dokan' );?></th>
                <th><?php _e( 'ID', 'dokan' );?></th>
                <th><?php _e( 'Type', 'dokan' );?></th>
                <th><?php _e( 'Debit', 'dokan' );?></th>
                <th><?php _e( 'Credit', 'dokan' );?></th>
                <th><?php _e( 'Balance', 'dokan' );?></th>
            </tr>
        </thead>
        <tbody>
            <?php

                    if ( $opening_balance ) {?>
            <tr>
                <td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $start_date ) ); ?></td>
                <td><?php echo '--'; ?></td>
                <td><?php echo '--'; ?></td>
                <td><?php _e( 'Opening Balance', 'dokan' );?></td>
                <td><?php echo '--'; ?></td>
                <td><?php echo '--'; ?></td>
                <td><?php echo wc_price( $opening_balance ); ?></td>
            </tr>
            <?php }

                        if ( count( $statements ) ) {
                            $total_debit  = 0;
                            $total_credit = 0;
                            $balance      = $opening_balance;

                            foreach ( $statements as $statement ) {
                                $total_debit += $statement->debit;
                                $total_credit += $statement->credit;
                                $balance += $statement->debit - $statement->credit;

                                switch ( $statement->trn_type ) {
                                case 'dokan_orders':
                                    $type = __( 'Order', 'dokan' );
                                    $url  = wp_nonce_url( add_query_arg( ['order_id' => $statement->trn_id], dokan_get_navigation_url( 'orders' ) ), 'dokan_view_order' );
                                    break;

                                case 'dokan_withdraw':
                                    $type = __( 'Withdraw', 'dokan' );
                                    $url  = add_query_arg( ['type' => 'approved'], dokan_get_navigation_url( 'withdraw' ) );
                                    break;

                                case 'dokan_refund':
                                    $type = __( 'Refund', 'dokan' );
                                    $url  = wp_nonce_url( add_query_arg( ['order_id' => $statement->trn_id], dokan_get_navigation_url( 'orders' ) ), 'dokan_view_order' );
                                    break;
                                }

                            ?>
            <tr>
                <td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $statement->balance_date ) ); ?></td>
                <td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $statement->trn_date ) ); ?></td>
                <td><a href="<?php echo $url; ?>">#<?php echo $statement->trn_id; ?></a></td>
                <td><?php echo $type; ?></td>
                <td><?php echo wc_price( $statement->debit ); ?></td>
                <td><?php echo wc_price( $statement->credit ); ?></td>
                <td><?php echo wc_price( $balance ); ?></td>
            </tr>
            <?php
                }

                        ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b><?php _e( 'Total :', 'dokan' );?></b></td>
                <td><b><?php echo wc_price( $total_debit ); ?></b></td>
                <td><b><?php echo wc_price( $total_credit ); ?></b></td>
                <td><b><?php echo wc_price( $balance ); ?></b></td>
            </tr>
            <?php
                } else {
                        ?>
            <tr>
                <td colspan="6"><?php _e( 'No Result found!', 'dokan' );?></td>
            </tr>

            <?php
                }

                    ?>

        </tbody>
    </table>

    <?php

                $response = ob_get_clean();
                wp_send_json_success( [
                    'filter'     => 1,
                    'start_date' => $start_date,
                    'end_date'   => $end_date,
                    'data'       => $response,
                ] );

            }

            die(); // this is required to return a proper result

        }

        add_action( 'wp_ajax_filter_report', 'ajax_filter_report' );

        function remove_order_statuses( $wc_statuses_arr ) {

        // Processing
            if ( isset( $wc_statuses_arr['wc-processing'] ) ) { // if exists
                unset( $wc_statuses_arr['wc-processing'] ); // remove it from array
            }

        // Refunded
            if ( isset( $wc_statuses_arr['wc-refunded'] ) ) {
                unset( $wc_statuses_arr['wc-refunded'] );
            }

        // On Hold
            if ( isset( $wc_statuses_arr['wc-on-hold'] ) ) {
                unset( $wc_statuses_arr['wc-on-hold'] );
            }

        // Failed
            if ( isset( $wc_statuses_arr['wc-failed'] ) ) {
                unset( $wc_statuses_arr['wc-failed'] );
            }

        // Pending payment
            if ( isset( $wc_statuses_arr['wc-pending'] ) ) {
                unset( $wc_statuses_arr['wc-pending'] );
            }

        // Completed

        //if( isset( $wc_statuses_arr['wc-completed'] ) ){

        //    unset( $wc_statuses_arr['wc-completed'] );

        //}

        // Cancelled

        //if( isset( $wc_statuses_arr['wc-cancelled'] ) ){

        //    unset( $wc_statuses_arr['wc-cancelled'] );
            //}
            return $wc_statuses_arr; // return result statuses
        }

        add_filter( 'wc_order_statuses', 'remove_order_statuses' );

        add_action( 'init', 'my_remove_schedule_delete' );
        function my_remove_schedule_delete() {
            remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
        }

        // disable delete entirely
        function restrict_post_deletion( $post_ID ) {
            $type = get_post_type( $post_ID );

            if ( $post_ID == 6792 || $post_ID == 6793 || $post_ID == 6795 ) {
                echo 'You are not authorized to delete this product.';
                exit;
            }

        }

    add_action( 'wp_trash_post', 'restrict_post_deletion', 10, 1 );
    add_action( 'before_delete_post', 'restrict_post_deletion', 10, 1 );