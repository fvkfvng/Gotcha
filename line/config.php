<?php
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		$line_host = 'http://localhost/gotcha/api/';
		$shop_line_host = 'http://localhost/gotcha/shop/api/';

		$user_chanel = '1655567130';
		$user_secret = 'ea1628544d8fc92ffd3b995f3cacb26f';

		$shop_chanel = '1655567128';
		$shop_secret = '6b5dac453d651b67f40d298a61fc7b48';
	} else {
		$line_host = 'https://gotcha-eloyalty.com/api/';
		$shop_line_host = 'https://gotcha-eloyalty.com/shop/api/';

		$user_chanel = '1655534503';
		$user_secret = '925123037c05006ae5dca81d3af7cd1c';

		$shop_chanel = '1655534711';
		$shop_secret = '7bb7f5e6cffd766b1b1e42b29f6b94fd';
	}

	define('LINE_LOGIN_CHANNEL_ID',$user_chanel);
	define('LINE_LOGIN_CHANNEL_SECRET',$user_secret);
	define('LINE_LOGIN_CALLBACK_URL', $line_host.'line_login_callback.php');
	
	define('LINE_SHOP_LOGIN_CHANNEL_ID',$shop_chanel);
	define('LINE_SHOP_LOGIN_CHANNEL_SECRET',$shop_secret);
	define('LINE_SHOP_LOGIN_CALLBACK_URL', $shop_line_host.'line_login_callback.php');
?>