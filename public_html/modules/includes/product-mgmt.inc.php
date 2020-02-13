<?php
	require_once( '../../autoload.php' );
	$database = new Database( HOST, USER, PASS, DBNAME );

	$sql = "SELECT * FROM products;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$query -> execute();

	$html = '';
	while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ) {
		$image = json_decode($r['product_images']);

		//Get cate by id
		$sql2 = "SELECT * FROM product_cates WHERE cate_id = :cate_id;";
		$query2 = $conn -> prepare($sql2);
		$query2 -> execute(array(
			':cate_id' => $r['product_cate']
		));
		$cate = $query2 -> fetch(PDO::FETCH_ASSOC);
		$cate = $cate['cate_name'];

		$html .= '
			<tr>
				<td><input type="text" value="' . $r['product_name'] . '" readonly /></td>
				<td width="20%">' . $cate . '</td>
				<td><img width="100px" src="/uploads/' . $image[0] . '" height="20%" /></td>
				<td><input type="text" value="' . number_format($r['product_price'], 0, ',', '.') . 'đ" readonly /></td>
				<td><input type="text" value="' . substr($r['product_short_des'], 0, 50) . '" readonly /></td>
				<td><input type="text" value="' . substr($r['product_long_des'], 0, 50) . '" readonly /></td>
				<td width=35%>
				<button class="dp-product-edit-btn js_edit-btn" data-tpl="product-edit" data-inc="product-edit?id=' . $r['product_id'] . '" data-magic="{@name},{@cates},{@images},{@image},{@price},{@id},{@short_des},{@des}">Sửa</button>
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewAllKeys" name="viewAllKeys" value="'. $r['product_id'] .'">Xem key đã xuất</button>
				<button class="dp-cate-edit-btn js_edit-btn js_product-generate-key-btn" data-tpl="product-generate-key" data-inc="product-generate-key?id=' . $r['product_id'] . '&name=' . $r['product_name'] . '" data-magic="{@product_name},{@product_id},{@order_id}" style="width:55px">Tạo key</button>
				<button class="dp-cate-delete-btn js_product-delete-btn" data-id="' . $r['product_id'] . '">Xóa</button>
				</td>
			</tr>
		';
	}
	echo $html;
?>
