<?php
namespace RIS\Auction;

class Admin {

    /**
     * Class constructor.
     */
    public function __construct() {

        $auctionSettings = new Admin\AuctionSettings();
        new Admin\Menu( $auctionSettings );
    }
}