<?php
	require_once( '../../autoload.php' );

	//KHI MỚI CLICK VÔ 2ND TAB
	$database = new Database( HOST, USER, PASS, DBNAME );
	$conn = $database -> get_connection();
	$sql = "SELECT * FROM products;";
	$query = $conn -> prepare( $sql );
	$query -> execute();

	$html = '';
	while($product = $query -> fetch(PDO::FETCH_ASSOC)) {
		$html .= '<option value="' . $product['product_id'] . '">' . $product['product_name'] . '</option>';
	}

	echo $html;
?>
