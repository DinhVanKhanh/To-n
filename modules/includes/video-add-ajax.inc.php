<?php
	require('../../autoload.php');
	if(isset($_POST['video_name'])) {

		//Lay bien
		$videoProduct = $_POST['video_product'];
		$videoSource = $_POST['video_source'];
		$videoName = $_POST['video_name'];
		$videoDes = $_POST['video_des'];

		//Luu vo db
		$database = new Database( HOST, USER, PASS, DBNAME );

		$conn = $database -> get_connection();
		$sql = "INSERT INTO videos(video_name, video_source, video_product, video_des) VALUES (:name, :source, :product, :des);";
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array(
			':name' => $videoName,
			':source' => $videoSource,
			':product' => $videoProduct,
			':des' => $videoDes
		) );
		$r ? print( 'Thành công' ) : print( 'Thất bại' );
	}
?>
