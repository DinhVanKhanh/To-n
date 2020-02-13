<?php
	require_once( 'autoload.php' );

	$view = new View();

	/*Session_start
	===========================================*/
	$security = new Security();
	$security -> sec_session_start();

	/*Check session
	============================================*/
	require_once( 'checksession.php' );
	if($_SESSION['dp_user_type'] != 1)
		header("location:/quanly");

	/*Rendering
	===========================================*/

	//Head
	$html = $view -> get_admin_tpl( 'head' );

	//Header
	$html .= $view -> get_admin_tpl( 'header' );

	//Sidebar
	$html .= $_SESSION['dp_user_type'] == 1 ? $view -> get_admin_tpl( 'sidebar' ) : $view -> get_admin_tpl( 'less-sidebar' );

	//Main
	$html .= $view -> get_admin_tpl( 'main' );

	//Foot
	$html .= $view -> get_admin_tpl( 'foot' );

	/*Routing
	==========================================*/
	if( isset( $_GET['mod'] ) && $_GET['mod'] ) {
		$mod = $view -> get_mod_tpl( $_GET['mod'] );
	}
	else {
		$mod = $view -> get_mod_tpl( 'home' ); //Get template homepage and replace this
	}

	/*Profile
	==========================================*/
	ob_start();
	$view -> get_admin_inc( 'profile' );
	$profile = ob_get_contents();
	ob_end_clean();

	//Magic keyword
	$html = str_replace( '{@mod}', $mod, $html );
	$html = str_replace( '{@profile}', $profile, $html );

	//Echo html
	echo $html;

?>
