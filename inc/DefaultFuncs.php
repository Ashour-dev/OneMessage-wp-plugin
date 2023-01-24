<?php

namespace inc;


class DefaultFuncs{
    public static function activate(){
        flush_rewrite_rules();
    }

    public static function deactivate(){
        flush_rewrite_rules();
    }
}