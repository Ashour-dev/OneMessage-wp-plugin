<?php
namespace inc;
class Webhooks{
    public function register(){
    }

    public static function saving($options){
        global $wpdb;
        $tbName= $wpdb->prefix . 'wc_webhooks';                    
        require_once(UPGRADE);
        // dd();
        for($i=0;$i<count($options);$i++){
            $WHName='one_' . $options[$i][1];
            $options[$i][1]=str_replace("_",".",$options[$i][1]);
            // dd($options);
            $topic=$options[$i][1];
            $WHURL="https://eo3cjaap5ehm0cf.m.pipedream.net";
            $user_id=get_current_user_id();
            $dateTime=current_datetime();
            $dateTime=(array)$dateTime;
            $dateTime=$dateTime['date'];
            $secret=wp_generate_password( 50, true, true );
            // dd($dateTime);
            // var_dump($options[$i][2]);
            $WH=$wpdb->get_results("SELECT name FROM $tbName WHERE name='$WHName'");
            if($options[$i][2]=="true"){
                if(!$WH){
                    $query="INSERT INTO $tbName (user_id, name, delivery_url, secret, status, topic, api_version, date_created, date_created_gmt, pending_delivery)
                    VALUES ('$user_id','$WHName', '$WHURL', '$secret', 'active', '$topic','3','$dateTime','$dateTime', '1');";
                    dbDelta($query);
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://eo3cjaap5ehm0cf.m.pipedream.net/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    // CURLOPT_POSTFIELDS => array('webhook_id' => '9'),
                    CURLOPT_HTTPHEADER => array(
                        'user-agent: WooCommerce/7.3.0 Hookshot (WordPress/6.1.1)',
                        'referer: https://eo3cjaap5ehm0cf.m.pipedream.net/',
                        'content-type: application/x-www-form-urlencoded',
                    ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    // dd($response);
                }
                // var_dump($WHName);
            }
            else{
                if($WH){
                    // var_dump($WH);
                    // $query="DELETE FROM $tbName WHERE $tbName.name='$WHName'";
                    $wpdb->delete( $tbName, array( 'name' => $WHName ) );
                    // dbDelta($query);
                }
            }
        }
        // dd($options);
        // flush_rewrite_rules();
        wp_cache_flush();
    }

}