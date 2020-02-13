<?php
	if( !isset( $_SESSION['dp_logged'] ) && $_SESSION["dp_user_type"]!="1" ) {
		header( "Location: /login.php" );
		exit;
	}
?>
