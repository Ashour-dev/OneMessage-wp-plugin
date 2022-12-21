<?php

namespace inc;


class DefaultFuncs{

    public static function activate(){
        // $this->custom_post_type();
        // $this->fav = plugin_dir_path(__FILE__) . 'assets/fav.svg';
        // $this->register();
        flush_rewrite_rules();
    }

    public static function deactivate(){
        flush_rewrite_rules();
    }
}