<?php 
	if(isset($_SESSION['dp_logged'])&&$_SESSION['dp_user_type']=="1")
		header("Location: admin.php");
	require_once( 'autoload.php' );
	
	$security = new Security();
	$view = new View();
	
	/*Session_start
	===========================================*/
	$security -> sec_session_start();
	
	/*Rendering
	===========================================*/
	
	//Head
	$html = $view -> get_admin_tpl( 'head' );
	
	//Header
	$html .= $view -> get_admin_tpl( 'header' );
	
	$html .= $view -> get_admin_tpl( 'login' );
	
	//Foot
	$html .= $view -> get_admin_tpl( 'foot' );

	//Echo html 
	echo $html;
?>