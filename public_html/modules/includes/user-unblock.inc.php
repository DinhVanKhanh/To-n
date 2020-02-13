<?php 
	require_once( '../../autoload.php' );
	
	$database = new Database( HOST, USER, PASS, DBNAME );
	
	if( isset( $_POST['user_id'] ) ) {
		
		/*Delete post 
		==============================================*/
		$sql = "UPDATE users SET user_active = 1 WHERE user_id = :id ;";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array( 
			':id' => (int)$_POST['user_id']
		) );
		
		$r ? print( 'Thành công' ) : print( 'Thất bại' );
	}
?>