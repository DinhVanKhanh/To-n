<?php
	require_once( '../../autoload.php' );
    $database = new Database( HOST, USER, PASS, DBNAME );
    if(!isset($_POST["id"])) die();
    $id_product=$_POST["id"];
    if($id_product=="-2") die();
    $sql="";
    if($id_product=="-1")
    {
        $sql = "SELECT * FROM product_codes ORDER BY product_code_valid DESC,created_at ASC LIMIT 0, 30;";
    }
    else $sql = "SELECT * FROM product_codes WHERE product_code_product_id=$id_product ORDER BY product_code_valid DESC,created_at ASC";
    

	// $sql = "SELECT * FROM product_codes ORDER BY product_code_valid DESC;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$query -> execute();

	$html = '<tr>
    <td>STT</td>
    <td>Code</td>
    <td>Khóa học</td>
    <td>Tình trạng</td>
    <td>Ngày tạo</td>
    <td>Biên tập</td>
</tr>';
	$i = 0;
	while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ) {
		$i++;

		//Get product name by id
		$sql3 = "SELECT product_name FROM products WHERE product_id = :id;";
		$query3 = $conn -> prepare($sql3);
		$query3 -> execute(array(
			':id' => $r['product_code_product_id']
		));
		$product = $query3 -> fetch(PDO::FETCH_ASSOC);
		$productName = $product['product_name'];

		//State
		$state = $r['product_code_valid'] == 1 ? '<span style="padding: 3px; background-color: green; color: #fff; font-size: 12px;">Chưa sử dụng</span>' : '<span style="padding: 3px; background-color: grey; color: #fff; font-size: 12px;">Đã sử dụng</span>';

		$html .= '
			<tr>
				<td>' . $i . '</td>
				<td>' .$r["product_code_product_id"]."-". $r['product_code_string'] . '</td>
				<td>' . $product['product_name'] . '</td>
				<td>' . $state . '</td>
				<td>' . $r['created_at'] . '</td>
				<td>
					<button class="dp-cate-delete-btn js_key-delete-btn" data-id="' . $r['product_code_id'] . '">Xóa</button>
				</td>
			</tr>
		';
	}
	echo $html;
?>
