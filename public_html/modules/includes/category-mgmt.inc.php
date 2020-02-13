<?php
	require_once( '../../autoload.php' );
	$database = new Database( HOST, USER, PASS, DBNAME );

	$sql = "SELECT * FROM cates;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$query -> execute();

	$html = '';
	while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ) {
		$html .= '
			<tr>
				<td><input type="text" value="' . $r['cate_name'] . '" readonly /></td>
				<td><input type="text" value="' . $r['cate_uri'] . '" readonly /></td>
				<td>
					<button class="dp-cate-edit-btn">Sửa</button>
					<button class="dp-cate-save-btn js_cate-save-btn" data-id="' . $r['cate_id'] . '">Lưu</button>
					<button class="dp-cate-delete-btn js_cate-delete-btn" data-id="' . $r['cate_id'] . '">Xóa</button>
				</td>
			</tr>
		';
	}
	echo $html;
?>
