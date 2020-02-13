<?php 
	require_once( '../../autoload.php' );
	
	$database = new Database( HOST, USER, PASS, DBNAME );
	
	$sql = "SELECT * FROM posts LIMIT 50;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$query -> execute();
	
	$html = '';
	$i = 0;
	while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ) {
		$i++;
		
		$sql2 = "SELECT cate_name FROM cates WHERE cate_id= :cate_id LIMIT 1;";
		$query2 = $conn -> prepare( $sql2 );
		$query2 -> execute( array( 
			':cate_id' => $r['cate_id']
		) );
		
		$cate = $query2 -> fetchColumn();
		
		if( (int)$r['post_active'] == 0 ) {
			$button = '<button class="dp-post-publish-btn" data-id="' . $r['post_id'] . '">Xuất bản</button>';
		}
		else {
			$button = '<button class="dp-post-unpublish-btn" data-id="' . $r['post_id'] . '">Ngừng xuất bản</button>';
		}
		
		$html .= '
			<tr>
				<td>' . $i . '</td>
				<td>' . $r['post_title'] . '</td>
				<td>' . $r['post_author'] . '</td>
				<td>' . date( 'd/m/Y', $r['post_time'] ) . '</td>
				<td>' . $cate . '</td>
				<td>' . $r['post_uri'] . '</td>
				<td>
					<button class="dp-post-edit-btn" data-id="' . $r['post_id'] . '">Sửa</button>
					<button class="dp-post-delete-btn" data-id="' . $r['post_id'] . '">Xóa</button>
					' . $button . '
				</td>
			</tr> 
		';
	}
	echo $html;
?>