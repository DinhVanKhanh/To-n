<?php 
	require_once( '../../autoload.php' );
	
	$database = new Database( HOST, USER, PASS, DBNAME );
	
	if( isset( $_POST['post_id'] ) ) {
		
		/*Get post data 
		==============================================*/
		$sql = "SELECT * FROM posts WHERE post_id = :id ;";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$query -> execute( array( 
			':id' => (int)$_POST['post_id']
		) );
		$r = $query -> fetch( PDO::FETCH_ASSOC );
		
		/*Get post's cate
		==============================================*/
		$sql1 = "SELECT * FROM cates WHERE cate_id = :id ;";
		$query1 = $conn -> prepare( $sql1 );
		$query1 -> execute( array( 
			':id' => $r['cate_id']
		) );
		$r1 = $query1 -> fetch( PDO::FETCH_ASSOC );
		$postCate = '<option value="' . $r1['cate_id'] . '" selected>' . $r1['cate_name'] . '</option>';
		
		/*Get all cates
		==============================================*/
		$sql2 = "SELECT * FROM cates WHERE cate_id <> :id ;";
		$query2 = $conn -> prepare( $sql2 );
		$query2 -> execute( array( 
			':id' => $r['cate_id']
		) );
		$otherCates = '';
		while( $r2 = $query2 -> fetch( PDO::FETCH_ASSOC ) ) {
			$otherCates .= '
				<option value="' . $r2['cate_id'] . '">' . $r2['cate_name'] . '</option>
			';
		}
		
		/*Render html
		==============================================*/
		$cates = $postCate . $otherCates;
		$html = '
			<section class="dp-new-post">
				<form action="" method="post"> 
					<input type="text" name="post_title" placeholder="Tên bài viết" value="' . $r['post_title'] . '" />
					<select name="post_cate">
						<option>Danh mục</option>
						' . $cates . '
					</select>
					<input type="text" name="post_tags" placeholder="Từ khóa (phân cách bằng dấu phẩy)" value="' . $r['post_tags'] . '" />
					<input type="hidden" name="inserting" value="0" />
					<input type="hidden" name="post_id" value="' . (int)$_POST['post_id'] . '" />
					<input type="submit" name="post_btn" id="post-btn" value="Xuất bản" />
					<textarea name="post_content" id="dp-wysiwyg" class="dp-wysiwyg">' . $r['post_content'] . '</textarea>
				</form>
			</section>
		';
		echo $html;
	}
?>