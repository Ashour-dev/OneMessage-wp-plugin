<?php

namespace inc;


class DefaultFuncs{
    // public $ApiK=null,$WSName,$AllSet;
    public function register(){
        register_activation_hook(__FILE__, array($this,'activate'));

        register_deactivation_hook(__FILE__, array($this,'deactivate'));
    }
    
    public static function activate(){
        flush_rewrite_rules();
    }

    public static function deactivate(){
        flush_rewrite_rules();
    }
    public static function StoreSessionVars(){
        if(isset($_SESSION["AllSet"])){
            $ApiK= $_SESSION["ApiK"];
            $AllSet= $_SESSION["AllSet"];
            $WSName=$_SESSION["WSName"];
            // echo "+++++++++++++++++++++" .  $_SESSION["WSName"];
            // echo "+++++++++++++++++++++" .  $_SESSION["ApiK"];
            // echo "+++++++++++++++++++++" .  $_SESSION["AllSet"];
            global $wpdb;
            $wpdb->query( "CREATE TABLE One (
                WSName VARCHAR,
                AllSet Boolean,
            );" );
        }
        if(isset($AllSet)){
            echo "+++++++++++++++++++++" .  $WSName;
            echo "+++++++++++++++++++++" .  $ApiK;
            echo "+++++++++++++++++++++" .  $AllSet;
        }
        else
            echo "+++++++++++++++++++++all set doesn't exist";
    
    }
}