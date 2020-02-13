<?php
	require('../../autoload.php');
	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database -> get_connection();


if (isset($_POST['product_id'])){

	if( isset($_POST['allKeyPage']) ){
		$omitNumber = 10 * ($_POST['allKeyPage'] - 1);

		$sql = "SELECT * FROM product_codes WHERE product_code_product_id = :productId LIMIT $omitNumber, 10;";
	} else {
		$sql = "SELECT * FROM product_codes WHERE product_code_product_id = :productId LIMIT 0, 10;";
	};

	$query = $conn->prepare($sql);
	$query->execute(array(
		':productId' => $_POST['product_id']
	));

	$allKeys = $query->fetchAll();

	$html = '';

	foreach($allKeys as $key => $value) {
		if ( $value[2] == 1){
			$status = "Chưa sử dụng";
		} else {
			$status = 'Đã sử dụng';
		};

		$html .= '<tr>';
		$html .= '<td>'.($key + 1).'</td>';
		$html .= '<td>'.$value[1].'-'.$value[3].'</td>';
		$html .= '<td>'.$value[4].'</td>';
		$html .= '<td>'.$status.'</td>';
		$html .= '</tr>';
	};

	print_r($html);
};