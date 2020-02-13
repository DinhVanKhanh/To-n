<?php
	require_once( '../../autoload.php' );

	$database = new Database( HOST, USER, PASS, DBNAME );

	$sql = "SELECT * FROM users ORDER BY created_at DESC;";
	$conn = $database -> get_connection();
	$query = $conn -> prepare( $sql );
	$query -> execute();

	$html = '';
	while( $r = $query -> fetch( PDO::FETCH_ASSOC ) ) {
		if( (int)$r['user_active'] == 1 ) {
			$button = '<button class="dp-user-block-btn" data-id="' . $r['user_id'] . '">Khóa</button>';
		}
		else {
			$button = '<button class="dp-user-unblock-btn" data-id="' . $r['user_id'] . '">Mở khóa</button>';
		}

		$type = $r['user_type'] == 1 ? 'Admin' : 'Đại lý';
		$html .= '
			<tr>
				<td>' . $r['user_username'] . '</td>
				<td>' . $r['user_email'] . '</td>
				<td>' . $type . '</td>
				<td>
					' . $button . '
					<button class="dp-user-edit-btn js_edit-btn" data-inc="user-edit?id=' . $r['user_id'] . '" data-tpl="user-edit" data-magic="{@username},{@email},{@types},{@id},{@password}">Sửa</button>
					<button class="dp-user-delete-btn" data-id="' . $r['user_id'] . '">Xóa</button>
				</td>
			</tr>
		';
	}
	echo $html;
?>
