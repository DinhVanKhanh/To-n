<?php
  require('../../autoload.php');

	/*Session_start
	===========================================*/
	$security = new Security();
	$security -> sec_session_start();

	if(isset($_POST['key_string'])) {
		$key="";
		$t=explode("-",$_POST["key_string"]);
		if(count($t)>1)
			$key=$t[1];
		$database = new Database(HOST, USER, PASS, DBNAME);
		$conn = $database -> get_connection();
		$sql = "SELECT * FROM product_codes WHERE product_code_product_id = :product_id AND product_code_string = :string AND product_code_valid = 1;";
		$query = $conn -> prepare($sql);
		$query -> execute(
			array(
				':product_id' => (int)$_POST['product_id'],
				':string' => $key
			)
		);
		if($query -> rowCount() > 0) {
			//Update code valid
			$id = $query -> fetch(PDO::FETCH_ASSOC)['product_code_id'];
			$sql = "UPDATE product_codes SET product_code_valid = 0 WHERE product_code_id = :id;";
			$query = $conn -> prepare($sql);
			$query -> execute(array(
				':id' => $id
			));

			//Insert into bought products table
			$data = unserialize($_SESSION['data']);
			$userId = $data['end_user_id'];
			$sql = "INSERT INTO bought_products(product_id, user_id) VALUES (:product_id,:user_id);";
			$query = $conn -> prepare($sql);
			$query -> execute(array(
				':product_id' => (int)$_POST['product_id'],
				':user_id' => $userId
			));

		}
		else {
			$_SESSION['error'] = 'Key bạn nhập vào không chính xác';
		}

		header('Location: /index.php?view=video&course_id=' . (int)$_POST['product_id']);
	}
?>
