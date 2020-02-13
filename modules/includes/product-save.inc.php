<?php
	require_once( '../../autoload.php' );

	if(isset($_POST['products'])) {
		$database = new Database( HOST, USER, PASS, DBNAME );
//Lấy biến
		$productName = $_POST['product_name'];
		$productId = $_POST['id'];
		$productPrice = $_POST['product_price'];
		$productShortDes = $_POST['product_short_des'];
		$productLongDes = $_POST['product_long_des'];

		$sql = "UPDATE products SET product_name = :product_name, product_price = :product_price, product_short_des = :product_short_des, product_long_des = :product_long_des WHERE product_id = :product_id;";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array(
			':product_name' => $productName,
			':product_id' => $productId,
			':product_price' => $productPrice,
			':product_short_des' => $productShortDes,
			':product_long_des' => $productLongDes
		) );
		$r ? print( 'Thành công' ) : print( 'Thất bại' );
	}
?>
