<?php
	require_once( '../../autoload.php' );
	//require_once( ROOT . '/admin/includes/btf.inc.php' );

	$security = new Security();
	$database = new Database( HOST, USER, PASS, DBNAME );

	$security -> sec_session_start();

	if( isset( $_POST['username'] ) ) {

		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM users WHERE user_username = :username LIMIT 1;";
		$conn = $database -> get_connection();

		$query = $conn -> prepare( $sql );
		$query -> execute( array(
			':username' => $username
		) );

		$r = $query -> fetch( PDO::FETCH_ASSOC );
		if( $r ) {
			//$realPassword = btf_decode( $r['user_password'], $r['user_key'] );
			$realPassword = $r['user_password'];
			if( $realPassword == $password ) {
				session_start();
				$_SESSION["userID"] = (string)$r["user_id"];
				$_SESSION["userName"] = (string)$username;
				$_SESSION['typeAcc']=(string)$r['user_type'];
				$_SESSION['dp_logged'] = true;
				$_SESSION['dp_username'] = $username;
				$_SESSION['dp_user_type'] = $r['user_type'];
				header( "Location: ../../admin.php" );
				exit;
			}
			else {
				echo 'Sai thông tin, đăng nhập lại sau 1 giây... !!';
				header( "Refresh: 1; url=../../login.php" );
				exit;
			}
		}
		else {
			echo 'Sai thông tin, đăng nhập lại sau 1 giây... !!';
			header( "Refresh: 1; url=../../login.php" );
			exit;
		}
	}
?>
