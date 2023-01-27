<?php
global $wpdb;
$wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}One" );
$APIKsTb=$wpdb->prefix . 'woocommerce_api_keys';
$wpdb->delete( $APIKsTb, array( 'description' => 'OneMessage - API' ) );

wp_safe_redirect( admin_url('admin.php?page=one_message'));
