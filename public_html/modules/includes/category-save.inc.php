<?php 
	require_once( '../../autoload.php' );
	
	$database = new Database( HOST, USER, PASS, DBNAME );
	
	$cateName = $_POST['cate_name'];
	$cateUri = $_POST['cate_uri'];
	$cateId = $_POST['cate_id'];
	
	$sql = "UPDATE cates SET cate_name = :cate_name, cate_uri = :cate_uri WHERE cate_id = :cate_id;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$r = $query -> execute( array( 
		':cate_name' => $cateName,
		':cate_uri' => $cateUri,
		':cate_id' => $cateId
	) );
	$r ? print( 'Thành công' ) : print( 'Thất bại' );
?>