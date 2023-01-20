<?php
/**
* Plugin Name: OneMessage
* Plugin URI: https://www.OneMessage.chat/
* Description: OneMessage is the App that allows you to communicate with customers or potential customers, using the most popular messaging channels, from within a single App.
* Version: 1.1.0
* Author: OneMessage
* Author URI: https://www.OneMessage.chat/
* Licence: GPLv2 or later
**/



/*
{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {URI to Plugin License}.
*/
require 'vendor/autoload.php';
require 'vendor/pear/http_request2/HTTP/Request2.php';
global $wpdb;


// if(! defined('ABSPATH')){
//     die;
// }

defined( 'ABSPATH' ) || exit;

define('PLUGIN_PATH',plugin_dir_path( __FILE__ ));
define('PLUGIN_URL',plugin_dir_url( __FILE__ ));
define('PLUGIN',plugin_basename( __FILE__ ));
define('TBNAME',$wpdb->prefix . 'One');
define('UPGRADE', ABSPATH . 'wp-admin/includes/upgrade.php');
$tbName=TBNAME;
define('ALLSET', count($wpdb->get_results("SELECT * FROM $tbName")));


use inc\DefaultFuncs;
$activate=fn()=>DefaultFuncs::activate();
$deactivate=fn()=>DefaultFuncs::deactivate();

register_activation_hook(__FILE__, $activate);
register_deactivation_hook(__FILE__, $deactivate);

if(class_exists('inc\\Init')){
    session_start();
    inc\Init::register_services();
    // inc\Init::db_initiazlization();
}