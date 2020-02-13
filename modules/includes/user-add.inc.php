<?php
	require_once( '../../autoload.php' );
	require_once( ROOT . '/admin/includes/btf.inc.php' );


	if( isset( $_POST['username'] ) ) {

		$database = new Database( HOST, USER, PASS, DBNAME );

		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$type = $_POST['type'];

		$EncodedPass = btf_encode( $password );
		$password = $EncodedPass[0];
		$key = $EncodedPass[1];

		$sql = "INSERT INTO users( user_username, user_password, user_key, user_email, user_type ) VALUES( :username, :password, :key, :email, :type );";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array(
			':username' => $username,
			':password' => $password,
			':key' => $key,
			':email' => $email,
			':type' => $type
		) );

		$r ? print( 'Thành công' ) : print( 'Thất bại' );
	}
?>
