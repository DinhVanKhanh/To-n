<?php
	require('../../autoload.php');
	if(isset($_POST['video_name'])) {

		//Lay bien
		$videoProduct = $_POST['video_product'];
		$videoSource = $_POST['video_source'];
		$videoName = $_POST['video_name'];
		$videoDes = $_POST['video_des'];
		$videoId = $_POST['video_id'];

		//Luu vo db
		$database = new Database( HOST, USER, PASS, DBNAME );

		$conn = $database -> get_connection();
		$sql = "UPDATE videos SET video_name = :name, video_des = :des, video_source = :source, video_product = :product WHERE video_id = :id;";
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array(
			':name' => $videoName,
			':source' => $videoSource,
			':product' => $videoProduct,
			':des' => $videoDes,
			':id' => $videoId
		) );
		$r ? print( 'Thành công' ) : print( 'Thất bại' );
	}
?>
