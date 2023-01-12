<?php
namespace inc;

class AdminPages{
    public function register(){
        add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
        add_filter( "plugin_action_links_" . PLUGIN , array( $this, 'settings_link' ) );
    }

    public function add_admin_pages(){
        add_menu_page( 'Getting Started', 'One Message', 'manage_options', 'one_message', array( $this,'gettingStarted_index' ),'dashicons-admin-site',110);
        // if(isset($_SESSION["AllSet"])){
        //     // add_submenu_page('one_message','Preferences', 'Preferences', 'manage_options', 'one_message_setting',array(AdminPages::class, 'preferences_page'));
        // }
    }
    public function gettingStarted_index(){
        // echo $AllSet;
        if(ALLSET!=0)
        require_once PLUGIN_PATH . 'templates/preferences.php';
        else
        require_once PLUGIN_PATH . 'templates/gettingStarted.php';
    }
    public function settings_link( $links ) {
        $settings_link= '<a href="admin.php?page=one_message">Preferences</a>';
        array_push( $links, $settings_link);
        // dd($links);
        return $links;
    }
    // public static function preferences_page(){
    //     require_once plugin_dir_path(__FILE__) . '../templates/preferences.php';
    // }
}