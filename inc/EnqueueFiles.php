<?php
namespace inc;
class EnqueueFiles{
    public function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueueCSS'));
    }

    public static function enqueueCSS(){
        wp_enqueue_style('myStyle', PLUGIN_URL .'assets/style.css');
    }
}