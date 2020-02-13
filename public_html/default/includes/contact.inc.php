<?php
	require_once('../../autoload.php');

	/*Session_start
	===========================================*/
	$security = new Security();
	$security -> sec_session_start();


	if(isset($_POST['fullname'])) {

		$sub = strip_tags($_POST['subject']) . '- Smartbrain.edu.vn';
		$msg = 'Người gửi: ' . strip_tags($_POST['fullname']) . PHP_EOL;
		$msg .= 'Địa gửi: ' . strip_tags($_POST['address']) . PHP_EOL;
		$msg .= 'Điện thoại: ' . strip_tags($_POST['telephone']) . PHP_EOL;
		$msg .= 'Nội dung: ' . PHP_EOL . strip_tags($_POST['message']);

		$r = mail(ADMIN_MAIL, $sub, $msg);
		if (!$r) {
			$_SESSION['error'] = 'Gửi mail thất bại, vui lòng thử lại sau';
		}
		else {
			$_SESSION['error'] = 'Thư của bạn đã được gửi đi.';
		}

		header("Location: /index.php?view=contact");
	}
?>
