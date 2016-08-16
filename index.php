<?php 
		//$url = 'http://socrpro.com/api/email';
		$url = 'http://socrpro.com/api/email';
		$data = array(
			'authuserid' => 2,
			'authuserpassword' => md5('$2y$10$LCYoYR01CKIHASgdy.Clr.BjuGmfAVsfWY0VVZjiQMSdQnE2d7uHq'),
			'toemail' =>  'asif@pwcart.com',
			'subject' => 'Mail Check From Socrpro.com',
			'bodymsg' => 'This is a simple test message, for checking API functionality.'
		);
		$postvalues = http_build_query($data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postvalues);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		echo '<pre>' . print_r($server_output, true) . '</pre>'; exit;
?>