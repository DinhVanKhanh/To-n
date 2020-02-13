<?php
	require_once('../../autoload.php');
	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database -> get_connection();

	$security = new Security();
	$security -> sec_session_start();


	if(isset($_POST['donHang'])) {
		if ($_POST['paymentTerms'] == 'true'){
			$userId = unserialize($_SESSION['data'])['end_user_id'];

		foreach ( $_POST['donHang'] as $donHang){
			$sql = "INSERT INTO orders(order_user, order_product, order_quantity) VALUES(:user, :product, :quantity);";
			$query = $conn -> prepare($sql);
			$query -> execute(array(
				':user' => $userId,
				':product' => $donHang['productID'],
				':quantity' => $donHang['soLuong']
			));
		};
			$_SESSION['userCart'] = [];
			$response = ['message' => 'Đã đặt hàng thành công!'];

			print_r(json_encode($response));
		} else {
			$response = ['message' => 'Bạn chưa chấp nhận điều khoản thanh toán. Vui lòng chấp nhận điều khoản và đặt hàng nhé.'];
			print_r(json_encode($response));
	}
} else {
	$response = ['message' => 'Đặt hàng thất bại'];
	print_r(json_encode($response));
};
?>
