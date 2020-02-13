<?php
	require_once( '../../autoload.php' );

	$database = new Database( HOST, USER, PASS, DBNAME );

	$id = $_POST['id'];

	$sql = "DELETE FROM videos WHERE video_id = :id;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$r = $query -> execute( array(
		':id' => $id
	) );
	$r ? print( 'Thành công' ) : print( 'Thất bại' );
?>
