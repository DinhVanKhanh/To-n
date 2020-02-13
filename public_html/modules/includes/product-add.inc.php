<?php
	require_once( '../../autoload.php' );

	//KHI MỚI CLICK VÔ 2ND TAB
	$database = new Database( HOST, USER, PASS, DBNAME );
	$conn = $database -> get_connection();
	$sql = "SELECT * FROM product_cates;";
	$query = $conn -> prepare( $sql );
	$query -> execute();

	$html = '';
	while($cate = $query -> fetch(PDO::FETCH_ASSOC)) {
		$html .= '<option value="' . $cate['cate_id'] . '">' . $cate['cate_name'] . '</option>';
	}

	echo $html;
?>
