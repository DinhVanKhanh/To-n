<?php 
	require_once( '../../autoload.php' );
	if( isset( $_POST['cate_name'] ) ) {
		
		$database = new Database( HOST, USER, PASS, DBNAME );
		
		$conn = $database -> get_connection();
		$sql = "INSERT INTO cates( cate_name, cate_uri ) VALUES ( :cate_name, :cate_uri );";
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array( 
			':cate_name' => $_POST['cate_name'],
			':cate_uri' => $_POST['cate_uri']
		) );
		$r ? print( 'Thành công' ) : print( 'Thất bại' );
	}
?>