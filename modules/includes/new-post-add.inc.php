<?php 
	require_once( '../../autoload.php' );
	
	$database = new Database( HOST, USER, PASS, DBNAME );
	
	$inserting = $_POST['inserting'] == '1' ? true : false;
	
	if( $inserting ) {
		$sql = "INSERT INTO posts( post_title, post_time, post_content, post_tags, cate_id, post_uri ) VALUES ( :post_title, :post_time, :post_content, :post_tags, :cate_id, :post_uri );";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array( 
			':post_title' => $_POST['post_title'],
			':post_time' => time(),
			':post_content' => $_POST['post_content'],
			':post_tags' => $_POST['post_tags'],
			':cate_id' => $_POST['post_cate'],
			':post_uri' => convert_utf8( $_POST['post_title'] ) . '-' . time() 
		) );
	}
	else {
		$sql = "UPDATE posts SET post_title = :post_title, post_time = :post_time, post_content = :post_content, post_tags = :post_tags, post_id = :post_id WHERE post_id = :post_id ;";
		$conn = $database -> get_connection();
		$query = $conn -> prepare( $sql );
		$r = $query -> execute( array( 
			':post_title' => $_POST['post_title'],
			':post_time' => time(),
			':post_content' => $_POST['post_content'],
			':post_tags' => $_POST['post_tags'],
			':cate_id' => $_POST['post_cate'],
			':post_id' => $_POST['post_id']
		) );
	}
	
	
	$r ? print( 'Thành công' ) : print( 'Thất bại' );
	
	
	//chuyển sang tiếng việt không dấu.
	function convert_utf8($str){
		if(!$str) return false;
		$unicode = array(
			'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ'),
			'A'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'),
			'd'=>array('đ'),
			'D'=>array('Đ'),
			'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ'),
			'E'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'),
			'i'=>array('í','ì','ỉ','ĩ','ị'),
			'I'=>array('Í','Ì','Ỉ','Ĩ','Ị'),
			'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ'),
			'O'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'),
			'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự'),
			'U'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'),
			'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),
			'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
			'-'=>array(' ','&quot;','.','-–-')
		);
		foreach($unicode as $nonUnicode=>$uni){
			foreach($uni as $value)
			$str = @str_replace($value,$nonUnicode,$str);
			$str = preg_replace("/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/","-",$str);
			$str = preg_replace("/-+-/","-",$str);
			$str = preg_replace("/^\-+|\-+$/","",$str);
		}
		return strtolower($str);
	}
?>