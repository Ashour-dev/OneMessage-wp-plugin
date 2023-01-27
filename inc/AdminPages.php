<?php
namespace inc;

class AdminPages{
    public function register(){
        add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
        if(!ALLSET)
        add_filter( "plugin_action_links_" . PLUGIN , array( $this, 'login_link' ) );
        else
        add_filter( "plugin_action_links_" . PLUGIN , array( $this, 'logout_link' ) );
    }

    public function add_admin_pages(){
        add_menu_page( 'Getting Started', 'One Message', 'manage_options', 'one_message', array( $this,'gettingStarted_index' ),$icon_url =PLUGIN_URL . 'assets/fav.png',110);
        add_submenu_page(null,'logout', 'logout', 'manage_options', 'one_message_logout',array($this, 'logout'));
    }
    public function gettingStarted_index(){
        // echo $AllSet;
        if(ALLSET!=0)
        require_once PLUGIN_PATH . 'templates/preferences.php';
        else
        require_once PLUGIN_PATH . 'templates/gettingStarted.php';
    }
    public function login_link( $links ) {
        $settings_link= '<a href="admin.php?page=one_message">Login</a>';
        array_push( $links, $settings_link);
        return $links;
    }
    public function logout_link( $links ) {
        $settings_link= '<a href="admin.php?page=one_message_logout">Logout</a>';
        array_push( $links, $settings_link);
        return $links;
    }
    public static function logout(){
        require_once PLUGIN_PATH . '/inc/logout.php';
    }
}