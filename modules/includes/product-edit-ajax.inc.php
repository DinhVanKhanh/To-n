<?php
	require('../../autoload.php');
	if(isset($_POST['product_name'])) {

		//Lay bien
		$productName = $_POST['product_name'];
		$productCate = $_POST['product_cate'];
		$productImage = $_POST['product_image'];
		$productPrice = $_POST['product_price'];
		$productId = $_POST['product_id'];
		$productShortDes = $_POST['product_short_des'];
		$productLongDes = $_POST['product_long_des'];

		//Luu vo db
		$database = new Database( HOST, USER, PASS, DBNAME );

		$conn = $database -> get_connection();
		$sql = "UPDATE products SET product_name = :product_name, product_cate = :product_cate, product_images = :product_images, product_price = :product_price, product_short_des = :product_short_des, product_long_des = :product_long_des WHERE product_id = :product_id;";
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array(
			':product_name' => $productName,
			':product_cate' => $productCate,
			':product_images' => $productImage,
			':product_price' => (int)$productPrice,
			':product_short_des' => $productShortDes,
			':product_long_des' => $productLongDes,
			':product_id' => $productId
		) );
		$r ? print( 'Thành công' ) : print( 'Thất bại' );
	}
?>
