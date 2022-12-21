<?php
namespace inc;
class EnqueueFiles{
    public static function enqueueCSS(){
        wp_enqueue_style('myStyle', plugins_url('../assets/style.css',__FILE__));
    }
}