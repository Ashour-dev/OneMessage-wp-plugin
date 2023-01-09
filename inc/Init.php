<?php

namespace inc;

final class Init{

    public static function get_services(){
        return[
            DefaultFuncs::class,
            AdminPages::class,
            EnqueueFiles::class
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