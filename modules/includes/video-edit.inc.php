<?php
	require_once( '../../autoload.php' );
	$database = new Database( HOST, USER, PASS, DBNAME );
	$conn = $database -> get_connection();
	$video_id = $_GET['id'];

	//Lấy thông tin khóa học
	$sql = "SELECT * FROM videos WHERE video_id = :id";
	$query = $conn -> prepare($sql);
	$query -> execute(array(
		':id' => $video_id
	));
	$video = $query -> fetch(PDO::FETCH_ASSOC);

	//Lấy danh mục
	$sql = "SELECT * FROM products;";
	$query = $conn -> prepare( $sql );
	$query -> execute();

	$products = '';
	while($product = $query -> fetch(PDO::FETCH_ASSOC)) {
		if($product['product_id'] == $video['video_product']) {
			$products .= '<option value="' . $product['product_id'] . '" selected>' . $product['product_name'] . '</option>';
		}
		else {
			$products .= '<option value="' . $product['product_id'] . '">' . $product['product_name'] . '</option>';
		}
	}

	//Get video
	$videos = '<div>
		<video controls style="margin-left: 25%; width: 300px;">
			<source src="/uploads/' . json_decode($video['video_source'])[0] . '"></source>
		</video>
	</div>';

	$data = array(
		$video['video_name'],
		$products,
		$videos,
		htmlentities($video['video_source']),
		$video_id,
		$video['video_des']
	);

	echo json_encode($data);
?>
