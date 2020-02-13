<?php 
	if(!isset($_GET['course_id'])) {
	echo 'Khóa học không tồn tại';
	exit;
	}

	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database -> get_connection();


	//Get course
	$sql = "SELECT * FROM products WHERE product_id = :id;";
	$query = $conn -> prepare($sql);
	$query -> execute(array(
	':id' => (int)$_GET['course_id']
	));
	$course = $query -> fetch(PDO::FETCH_ASSOC);

	$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
	$html = '';

	//Check Had user bought this course before?
	$data = unserialize($_SESSION['data']);
	$userId = $data['end_user_id'];
	$sql = "SELECT * FROM bought_products WHERE user_id = :user_id AND product_id = :product_id;";
	$query = $conn -> prepare($sql);
	$query -> execute(array(
		':user_id' => $userId,
		':product_id' => $course['product_id']
	));
	if($query -> rowCount() > 0) {
		$sql1="";
		if(isset($_GET["video_id"]))
		{
			$sql1 = "SELECT * FROM videos WHERE video_id = :pro_id;";
		}
		else $sql1 = "SELECT * FROM videos WHERE video_product = :pro_id;";

		$query1 = $conn -> prepare($sql1);

		$pro_id= (isset($_GET["video_id"])?$_GET["video_id"]:(int)$_GET['course_id']);

		$query1 -> execute(array(
			':pro_id' =>$pro_id,
		));
		$html = ($query1 -> rowCount() > 0) ? '' : '<p>Khóa học này hiện không có video nào.</p>';
		$video = $query1 -> fetch(PDO::FETCH_ASSOC);

		$video_id="";
		if(isset($_GET["video_id"]))
			$video_id=$_GET["video_id"];
		else $video_id=$video["video_id"];
		$key=$video["keyss"];

		$html .= '
			<h3 id="video_show">' . $video['video_name'] . '</h3>
			<video controls style="width:300px;height:150px;" controlsList="nodownload">
				<source src="/blockdonwload/donwload.php?key=' .$key. '&video_id='.$video_id.'"></source>
			</video>
			<p>' . $video['video_des'] . '</p>
			<hr />    
			<script>
			$(document).bind("contextmenu",function(e){
			  e.preventDefault();
			});
			</script>
		';
		
	}
?>