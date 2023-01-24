<?php

namespace inc;

final class Init{
    public static function db_initiazlization(){
        global $wpdb;
        $tbName= $wpdb->prefix . 'One';
        // $charset=$wpdb->get_charset_collate;
        $query="CREATE TABLE $tbName (
            `WSName` VARCHAR(31) PRIMARY KEY,
            `ApiK` VARCHAR(30),
            `AllSet` Boolean
        );";
        require_once(UPGRADE);
        dbDelta($query);
    }
    public static function get_services(){
        return[
            DefaultFuncs::class,
            AdminPages::class,
            EnqueueFiles::class,
            // WC_Integration_One::class
        ];
    }
    public static function register_services(){
        foreach(self::get_services() as $class){
            $service= self::instantiate($class);
            if(method_exists($service,'register'))
                $service->register();
        }
    }
    /***
     * instantiate
     * @param class $class class
     * @return class instance desc
     */
    private static function instantiate($class){
        $service=new $class();
        return $service;
    }


}