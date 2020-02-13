<?php
	require_once( '../../autoload.php' );
	$database = new Database( HOST, USER, PASS, DBNAME );

	if( isset($_POST['mainKeyPage']) ){
		$omitNumber = 30 * ($_POST['mainKeyPage'] - 1);

		$sql = "SELECT * FROM product_codes ORDER BY product_code_valid DESC,created_at ASC LIMIT $omitNumber, 30;";
	} else {
		$sql = "SELECT * FROM product_codes ORDER BY product_code_valid DESC,created_at ASC LIMIT 0, 30;";
	};

	// $sql = "SELECT * FROM product_codes ORDER BY product_code_valid DESC;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$query -> execute();

	$html = '';
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

	$select="<option value='-2'>-- Chọn khóa học --</option><option value='-1'>-- Tất cả --</option>";
	$sql = "SELECT product_id,product_name FROM products ORDER BY product_id ASC;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$query -> execute();
	while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ) {
		$select.="<option value='".$r["product_id"]."'>".$r["product_name"]."</option>";
	}
	echo "<script>
		$(document).ready(function() {
			$('#select_product_key').html(\"".$select."\")
		});
	</script>";
?>
