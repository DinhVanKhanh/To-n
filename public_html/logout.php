<?php
	require_once( 'autoload.php' );

	$security = new Security();

	$security -> sec_session_start();

	session_destroy();

	$redirection = isset($_GET['r']) ? $_GET['r'] : '/';
	header( "Location: " . $redirection );

	exit;
?>
