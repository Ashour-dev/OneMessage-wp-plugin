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
            $WSName=$_SESSION["WSName"];
            $ApiK= $_SESSION["ApiK"];
            $AllSet= $_SESSION["AllSet"];
            // echo "+++++++++++++++++++++" .  $_SESSION["WSName"];
            // echo "+++++++++++++++++++++" .  $_SESSION["ApiK"];
            // echo "+++++++++++++++++++++" .  $_SESSION["AllSet"];
            // global $wpdb;
            // $tbName= $wpdb->prefix . 'One';
            // // $charset=$wpdb->get_charset_collate;
            // $wpdb->insert( $tbName,array(
            //     'WSName' => $WSName,
            //     'ApiK' => $ApiK,
            //     'AllSet' => $AllSet
            // ) );
            global $wpdb;
            $tbName= TBNAME;
            // $charset=$wpdb->get_charset_collate;
            $query="INSERT INTO $tbName (WSName, ApiK, AllSet)
            VALUES ('$WSName', '$ApiK', '$AllSet');";
            require_once(UPGRADE);
            dbDelta($query);
            // $results=$wpdb->get_results("SELECT * FROM $tbName");
            // dd($results);
            dd(ALLSET);
            // require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            // dbDelta($query);
            // define('ApiK',$ApiK);
            // define('WSName',$WSName);
            // define('AllSet',$AllSet);
            // echo "+++++++++++++++++++++ All Variables are defined";
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