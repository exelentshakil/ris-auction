<?php
namespace RIS\Auction;

class Installer {

    public function run() {
        $this->update_version();
    }

    public function update_version() {

        $installed = get_option( 'ris_auction_installed' );

        if ( $installed ) {
            update_option( 'ris_auction_installed', time() );
        }

        update_option( 'ris_auction_version', RIS_AUCTION_VERSION );

    }

}