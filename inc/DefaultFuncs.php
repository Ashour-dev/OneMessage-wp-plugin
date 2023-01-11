<?php

namespace inc;


class DefaultFuncs{
    // public $ApiK=null,$WSName,$AllSet;
    
    public static function activate(){
        flush_rewrite_rules();
    }

    public static function deactivate(){
        flush_rewrite_rules();
    }
    public static function StoreSessionVars(){
        if(isset($_SESSION["AllSet"])){
            $ApiK= $_SESSION["ApiK"];
            $WSName=$_SESSION["WSName"];
            $AllSet= $_SESSION["AllSet"];
            // echo "+++++++++++++++++++++" .  $_SESSION["WSName"];
            // echo "+++++++++++++++++++++" .  $_SESSION["ApiK"];
            // echo "+++++++++++++++++++++" .  $_SESSION["AllSet"];
            // global $wpdb;
            // $wpdb->query( "CREATE TABLE One (
            //     WSName VARCHAR,
            //     AllSet Boolean,
            // );" );
            define('ApiK',$ApiK);
            define('WSName',$WSName);
            define('AllSet',$AllSet);
            echo "+++++++++++++++++++++ All Variables are defined";
            if(defined('AllSet'))
                echo "+++++++++++++++++++++ All Variables are really defined";
        }
        // if(isset($AllSet)){
        //     echo "+++++++++++++++++++++" .  $WSName;
        //     echo "+++++++++++++++++++++" .  $ApiK;
        //     echo "+++++++++++++++++++++" .  $AllSet;
        // }
        // else
        //     echo "+++++++++++++++++++++all set doesn't exist";
    
    }
}