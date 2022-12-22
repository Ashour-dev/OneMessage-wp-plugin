<?php


// if uninstall.php is not called by WordPress, die
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

// $option_name = 'wporg_option';

// delete_option( $option_name );

// for site options in Multisite
// delete_site_option( $option_name );

// drop a custom database table
// global $wpdb;
// $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mytable" );
$_SESSION["WSName"]=null;
$_SESSION["ApiK"]=null;
$_SESSION["AllSet"]=null;

session_reset();
// global $wpdb;
// $wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'OneM'" );
// $wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
// $wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
