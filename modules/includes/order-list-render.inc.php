<?php
	require('../../autoload.php');
	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database -> get_connection();

	if (isset($_POST['userID'])){

		$sql = 'SELECT products.product_name AS "Product_Name", orders.order_user AS "Order_User", orders.order_quantity AS "Order_Quantity", orders.created_at AS "Date", orders.order_completed AS "Completed" FROM orders JOIN products ON orders.order_product = products.product_id WHERE orders.order_user = :userID;';
		$query = $conn->prepare($sql);
		$query->execute(array(
			':userID' => $_POST['userID']
		));

		$result = $query->fetchAll();

		print_r(json_encode($result));
	}