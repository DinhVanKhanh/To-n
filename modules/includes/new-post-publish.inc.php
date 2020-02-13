<?php 
	require_once( '../../autoload.php' );
	
	$database = new Database( HOST, USER, PASS, DBNAME );
	
	if( isset( $_POST['post_id'] ) ) {
		
		/*Delete post 
		==============================================*/
		$sql = "UPDATE posts SET post_active = 1 WHERE post_id = :id ;";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array( 
			':id' => (int)$_POST['post_id']
		) );
		
		$r ? print( 'Thành công' ) : print( 'Thất bại' );
	}
?>