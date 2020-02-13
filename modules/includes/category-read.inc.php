<?php 
	require_once( '../../autoload.php' );
	
	$database = new Database( HOST, USER, PASS, DBNAME );
	
	$sql = "SELECT * FROM cates;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$query -> execute();
	while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ) {
		echo '<option value="' . $r['cate_id'] . '">' . $r['cate_name'] . '</option>';
	}
?>