<?php

namespace inc;


class DefaultFuncs{
    public static function activate(){
        flush_rewrite_rules();
    }

    public static function deactivate(){
        flush_rewrite_rules();
    }
    public static function StoreSessionVars(){
        // dd("Your are in default funcs");
        if(isset($_SESSION["AllSet"])){
            $WSName=$_SESSION["WSName"];
            $ApiK= $_SESSION["ApiK"];
            $AllSet= $_SESSION["AllSet"];
            global $wpdb;
            $tbName= TBNAME;
            $query="INSERT INTO $tbName (WSName, ApiK, AllSet)
            VALUES ('$WSName', '$ApiK', '$AllSet');";
            require_once(UPGRADE);
            dbDelta($query);
        }
    }
}