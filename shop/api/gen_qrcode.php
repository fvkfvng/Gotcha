<?php
	include('../../phpqrcode/qrlib.php'); 
	
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		$host = 'http://localhost/gotcha/';
	} else {
		$host = 'https://gotcha-eloyalty.com/';
	}

	if (isset($_GET['w'])) {
		$text = $host.'shop/qr/user-award.php?qr='.$_GET['w'];
	} elseif (isset($_GET['s'])) {
		$text = $host.'qr/shop-add.php?shop='.$_GET['s'];
	} else if (isset($_GET['p'])) {
		$text = $host.'qr/shop-points.php?qr='.$_GET['p'];
	} else {
		$text = 'QR Code ไม่ถูกต้อง';
	}

	QRcode::png($text);
?>