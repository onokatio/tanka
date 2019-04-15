<?php
	require 'TwistOAuth.phar';

	date_default_timezone_set('Asia/Tokyo');

	function h($str) {
		return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
	}
echo "read";

function tweet($str){
	try {
		$consumer_key = '';
		$consumer_secret = '';
		$access_token = '';
		$access_token_secret = '';
		echo "1";
		$tw = new TwistOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
		echo "2";
		echo $tw->post('statuses/update', array('status' => $str));
		echo "3";
	} catch(TwistException $e) {
		echo $e->getMessage();
		echo $e->getCode() ?: 500;
	}
}

//tweet("いつのまに ブームが過ぎ去り 廃BOT こっそり宣伝 使ってください♪");
?>
