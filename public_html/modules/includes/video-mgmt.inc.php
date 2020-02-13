<?php
	require_once( '../../autoload.php' );
	$database = new Database( HOST, USER, PASS, DBNAME );

	$sql = "SELECT * FROM videos ORDER BY video_id DESC;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$query -> execute();

	$html = '';
	/*
	while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ) {

		//Get product name by id
		$sql2 = "SELECT product_name FROM products WHERE product_id = :id;";
		$query2 = $conn -> prepare($sql2);
		$query2 -> execute(array(
			':id' => $r['video_product']
		));
		$product = $query2 -> fetch(PDO::FETCH_ASSOC);
		$productName = $product['product_name'];

		//Get video source
		$source = json_decode($r['video_source']);

		$video_id=$r["video_id"];
		$key=$r["keyss"];
		$html .= '
			<tr>
				<td>' . $r['video_name'] . '</td>
				<td>' . $productName . '</td>
				<td>
					<video preload="none" controlsList="nodownload" style="width: 300px; height: 250px;" controls>
						<source src="/blockdonwload/donwload.php?key='.$key.'&video_id='.$video_id.'"></source>
					</video>
				</td>
				<td>' . substr($r['video_des'], 0, 100) . '...</td>
				<td>
					<button class="dp-video-edit-btn js_edit-btn" data-tpl="video-edit" data-inc="video-edit?id=' . $r['video_id'] . '" data-magic="{@name},{@products},{@videos},{@video},{@id},{@des}">Sửa</button>
					<button class="dp-video-delete-btn" id="js_delete-video-btn" data-id="' . $r['video_id'] . '">Xóa</button>
				</td>
			</tr>
		';
	}
	echo $html;
	*/

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
			$('#select_product_video').html(\"".$select."\")
		});
	</script>";
?>
