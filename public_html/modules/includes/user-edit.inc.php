<?php
	require_once( '../../autoload.php' );
	require_once( ROOT . '/admin/includes/btf.inc.php' );


	if( isset( $_GET['id'] ) ) {

		$database = new Database( HOST, USER, PASS, DBNAME );

		$sql = "SELECT * FROM users WHERE user_id = :id;";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$query -> execute( array(
			':id' => (int)$_GET['id']
		) );

		$r = $query -> fetch(PDO::FETCH_ASSOC);

		$password = btf_decode( $r['user_password'], $r['user_key'] );

		$selected1 = $r['user_type'] == 1 ? 'selected' : '';
		$selected2 = $r['user_type'] == 2 ? 'selected' : '';
		$types = '<option value="1" ' . $selected1 . '>Admin</option><option  ' . $selected2 . ' value="2">Đại lý</option>';

		$data = array(
			$r['user_username'],
			$r['user_email'],
			$types,
			$r['user_id'],
			$password,
		);

		echo json_encode($data);
	}
?>
