<?php
	require_once( '../../autoload.php' );
	require_once( ROOT . '/admin/includes/btf.inc.php' );


	if( isset( $_POST['username'] ) ) {

		$database = new Database( HOST, USER, PASS, DBNAME );
		$conn = $database -> get_connection();
		$sql = "UPDATE users SET user_username = :username, user_email = :email, user_password = :pass, user_key = :key, user_type = :type WHERE user_id = :id;";
		$query = $conn -> prepare($sql);
		$encodePassword = btf_encode($_POST['password']);
		$r = $query -> execute(array(
			':username' => $_POST['username'],
			':email' => $_POST['email'],
			':pass' => $encodePassword[0],
			':key' => $encodePassword[1],
			':type' => $_POST['type'],
			':id' => $_POST['id']
		));

		$r ? print('Thành công') : print('Thất bại');
	}
?>
