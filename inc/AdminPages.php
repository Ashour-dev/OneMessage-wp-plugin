<?php
namespace inc;

class AdminPages{
    public static function add_admin_pages(){
        add_menu_page( 'Getting Started', 'One Message', 'manage_options', 'one_message', array( AdminPages::class,'gettingStarted_index' ),'dashicons-admin-site',110);
        add_submenu_page('one_message','Preferences', 'Preferences', 'manage_options', 'one_message_setting',array(AdminPages::class, 'preferences_page'));
    }
    public static function gettingStarted_index(){
        require_once plugin_dir_path(__FILE__) . '../templates/gettingStarted.php';
    }
    public static function preferences_page(){
        require_once plugin_dir_path(__FILE__) . '../templates/preferences.php';
    }
}