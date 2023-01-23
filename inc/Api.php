<?php
namespace inc;
class Api{
    public static function create_keys() {
		global $wpdb;

		// $description = sprintf(
		// 	'%s - API (%s)',
		// 	wc_trim_string( wc_clean( $app_name ), 170 ),
		// 	gmdate( 'Y-m-d H:i:s' )
		// );
        $description="OneMessage - API";
		$user        = wp_get_current_user();

		// Created API keys.
		$permissions     = 'read_write';
		$consumer_key    = 'ck_' . sha1( wp_rand() );
		$consumer_secret = 'cs_' . sha1( wp_rand() );
            // dd($consumer_key);
		$wpdb->insert(
			$wpdb->prefix . 'woocommerce_api_keys',
			array(
				'user_id'         => $user->ID,
				'description'     => $description,
				'permissions'     => $permissions,
				'consumer_key'    => hash_hmac( 'sha256', $consumer_key, 'wc-api' ),
				'consumer_secret' => $consumer_secret,
				'truncated_key'   => substr( $consumer_key, -7 ),
			),
			array(
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
			)
		);
		$results= array(
			'key_id'          => $wpdb->insert_id,
			'user_id'         => $user->ID,
			'consumer_key'    => $consumer_key,
			'consumer_secret' => $consumer_secret,
			'key_permissions' => $permissions,
		);
		self::send_keys($results);
		return $results;
	}
    public static function send_keys($results) {
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://eo3cjaap5ehm0cf.m.pipedream.net?domain_url=' . get_site_url(),
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => array('consumer_key' => $results['consumer_key'],'consumer_secret' => $results['consumer_secret'],
		'key_id'=>$results['key_id'],'key_permissions'=>$results['key_permissions'],'user_id'=>$results['user_id']),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		// echo $response;

	}
}