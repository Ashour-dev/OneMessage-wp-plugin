<?php
/**
* Plugin Name: OneMessage
* Plugin URI: https://www.OneMessage.chat/
* Description: First Test.
* Version: 1.0
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

use inc\DefaultFuncs;
use inc\AdminPages;
use inc\EnqueueFiles;



if(! defined('ABSPATH')){
    die;
}


class OneMessage
{
    public $plugin,$WSName,$ApiK,$AllSet;
    public $fav;
    public $test=1;

    function activate(){
        DefaultFuncs::activate();
    }

    // function deactivate(){
    //     flush_rewrite_rules();
    // }
    function register(){
        session_start();
        $this->plugin = plugin_basename( __FILE__ );
        add_action('admin_enqueue_scripts', array(EnqueueFiles::class, 'enqueueCSS'));
        // DefaultFuncs::StoreSessionVars();
        add_action( 'admin_menu', array( AdminPages::class, 'add_admin_pages' ) );
        // add_action( 'admin_menu', array( $this, 'add_sub_menu' ) );
        // echo "++++++++++++++++++++++++" . $this->settings_link;
        add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );

    }
    public function settings_link( $links ) {
        $settings_link= '<a href="admin.php?page=one_message_setting">Preferences</a>';
        array_push( $links, $settings_link);
        // dd($links);
        return $links;
    }


    // function storing_session_variables(){
    //     if(isset($_SESSION["AllSet"])){
    //         // echo "+++++++++++++++++++++" .  $_SESSION["WSName"];
    //         $ApiK= $_SESSION["ApiK"];
    //         $AllSet= $_SESSION["AllSet"];
    //         $WSName=$_SESSION["WSName"];
    //     }
    // }

}



if ( class_exists('OneMessage')){
    $oneMessage= new OneMessage();
    $oneMessage->register();
}

// include plugin_dir_path(__FILE__) . 'assets/globals.php';
//     global $WSName ;
//     echo '++++++++++++++++++++++++++++' . $WSName;
//     // var_dump($GLOBALS["oneMessage"]);
//     var_dump($GLOBALS["WSName"]);



register_activation_hook(__FILE__, array($oneMessage, 'activate'));

register_deactivation_hook(__FILE__, array(DefaultFuncs::class, 'deactivate'));
