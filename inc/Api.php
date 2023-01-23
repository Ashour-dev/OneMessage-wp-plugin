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

		return array(
			'key_id'          => $wpdb->insert_id,
			'user_id'         => $user->ID,
			'consumer_key'    => $consumer_key,
			'consumer_secret' => $consumer_secret,
			'key_permissions' => $permissions,
		);
	}
}