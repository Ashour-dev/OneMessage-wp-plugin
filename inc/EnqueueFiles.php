<?php
namespace inc;
class EnqueueFiles{
    public function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueueCSS'));
    }

    public static function enqueueCSS(){
        wp_enqueue_style('myStyle', plugins_url('../assets/style.css',__FILE__));
    }
}