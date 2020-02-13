<?php

	include("../../apps/libs/Dbconn.php");
	require('../../autoload.php');



	if(isset($_POST['product_id'])) {

		//Lay bien
		$productId = $_POST['product_id'];

		$database = new Database( HOST, USER, PASS, DBNAME );
		$conn = $database -> get_connection();


		//Update orders table
									//Insert into product_codes table

			for ($i = 0; $i < 10; $i ++){
				$sql = 'INSERT INTO product_codes(product_code_product_id, product_code_string) VALUES(:product_code_product_id, :product_code_string);';
					$query = $conn -> prepare( $sql );
					$db = new apps_libs_Dbconn();
					$key = $db->CreateID("product_codes","product_code_string",9);
					$r = $query -> execute(array(
						':product_code_product_id' => $productId,
						':product_code_string' => $key
					));
				};
			
				print_r('Đã tạo thành công 10 key cho khóa học!');
};