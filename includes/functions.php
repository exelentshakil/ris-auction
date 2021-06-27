<?php

add_action( 'admin_init', 'allow_contributor_uploads' );

function allow_contributor_uploads() {
    $contributor = get_role( 'subscriber' );
    $contributor->add_cap( 'upload_files' );
}

add_action( 'pre_get_posts', 'users_own_attachments' );
function users_own_attachments( $wp_query_obj ) {

    global $current_user, $pagenow;

    $is_attachment_request = ( $wp_query_obj->get( 'post_type' ) == 'attachment' );

    if ( ! $is_attachment_request ) {
        return;
    }

    if ( ! is_a( $current_user, 'WP_User' ) ) {
        return;
    }

    if ( ! in_array( $pagenow, array( 'upload.php', 'admin-ajax.php' ) ) ) {
        return;
    }

    if ( ! current_user_can( 'delete_pages' ) ) {
        $wp_query_obj->set( 'author', $current_user->ID );
    }

    return;
}

add_filter( 'http_request_host_is_external', 'allow_localhost', 10, 3 );
function allow_localhost( $allow, $host, $url ) {

    if ( $host == 'localhost' ) {
        $allow = true;
    }

    return $allow;
}