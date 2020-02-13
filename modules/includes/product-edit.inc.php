<?php
	require_once( '../../autoload.php' );
	$database = new Database( HOST, USER, PASS, DBNAME );
	$conn = $database -> get_connection();
	$product_id = $_GET['id'];

	//Lấy thông tin khóa học
	$sql = "SELECT * FROM products WHERE product_id = :id";
	$query = $conn -> prepare($sql);
	$query -> execute(array(
		':id' => $product_id
	));
	$product = $query -> fetch(PDO::FETCH_ASSOC);

	//Lấy danh mục
	$sql = "SELECT * FROM product_cates;";
	$query = $conn -> prepare( $sql );
	$query -> execute();

	$cates = '';
	while($cate = $query -> fetch(PDO::FETCH_ASSOC)) {
		if($cate['cate_id'] == $product['product_cate']) {
			$cates .= '<option value="' . $cate['cate_id'] . '" selected>' . $cate['cate_name'] . '</option>';
		}
		else {
			$cates .= '<option value="' . $cate['cate_id'] . '">' . $cate['cate_name'] . '</option>';
		}
	}

	//Get images
	$images = '<div>';
	foreach(json_decode($product['product_images']) as $image) {
		$images .= '<img class="dp-preview-image" src="/uploads/' . $image . '" />';
	}
	$images .= '</div>';

	$data = array(
		$product['product_name'],
		$cates,
		$images,
		htmlentities($product['product_images']),
		$product['product_price'],
		$product['product_id'],
		$product['product_short_des'],
		$product['product_long_des']
	);

	echo json_encode($data);
?>
