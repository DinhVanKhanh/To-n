<?php
	require_once( '../../autoload.php' );
	$security = new Security();
	$database = new Database( HOST, USER, PASS, DBNAME );
	$security -> sec_session_start();
	$userID = $_SESSION['userID'];
	if(isset($_POST['orderPage'])){
		$omitNumber = 20 * ($_POST['orderPage'] - 1);

		$sql = "SELECT orders.* FROM `orders`,end_users WHERE order_user = end_users.end_user_id and end_users.adtudo_id = $userID ORDER BY order_completed ASC,created_at DESC LIMIT $omitNumber, 20 ;";
	} else {
		$sql = "SELECT orders.* FROM `orders`,end_users WHERE order_user = end_users.end_user_id and end_users.adtudo_id = $userID ORDER BY order_completed ASC,created_at DESC LIMIT 20;";
	};

	$conn = $database -> get_connection();
	$query1 = $conn -> prepare( $sql );
	$query1 -> execute();

	$html = '';
	$i = 0;

	while( $r = $query1 -> fetch( PDO::FETCH_ASSOC ) ) {
		$i++;

		//Email
		$sql = "SELECT * FROM end_users WHERE end_user_id = :id;";
		$query = $conn -> prepare( $sql );
		$query -> execute(array(
			':id' => $r['order_user']
		));
		$userInfo = $query -> fetch(PDO::FETCH_ASSOC);

		//Product
		$sql = "SELECT * FROM products WHERE product_id = :id;";
		$query = $conn -> prepare( $sql );
		$query -> execute(array(
			':id' => $r['order_product']
		));
		$product = $query -> fetch(PDO::FETCH_ASSOC);

		//Analyze order State
		($r['order_completed'] == 0) ? $state = 'Chưa xử lý' : $state = 'Đã xử lý';

				// Get User Ward
		  $sqlWard = 'SELECT * FROM devvn_xaphuongthitran WHERE xaid = :wardID;';

		  $queryWard = $conn->prepare($sqlWard);
		  $queryWard->execute([
		  	':wardID' => $userInfo['end_user_ward']
		  ]);

		  $userWard= $queryWard->fetch(PDO::FETCH_ASSOC);
		  // Get User District
		  $sqlDistrict = 'SELECT * FROM devvn_quanhuyen WHERE maqh = :districtID;';

		  $queryDistrict = $conn->prepare($sqlDistrict);
		  $queryDistrict->execute([
		  	':districtID' => $userInfo['end_user_district']
		  ]);

		  $userDistrict = $queryDistrict->fetch(PDO::FETCH_ASSOC);
		  // Get User City
		  $sqlCity = 'SELECT * FROM devvn_tinhthanhpho WHERE matp = :cityID;';

		  $queryCity = $conn->prepare($sqlCity);
		  $queryCity->execute([
		  	':cityID' => $userInfo['end_user_city']
		  ]);

		  $userCity = $queryCity->fetch(PDO::FETCH_ASSOC);

		  $userLocation = 'Số nhà '.$userInfo['end_user_address'].', '.$userWard['name'].', '.
		  					$userDistrict['name'].', '.$userCity['name'].'.';

		$html .= '
			<tr id="tr'.$r['order_id'].'">
				<td>' . $i . '</td>
				<td>' . $userInfo['end_user_email'] . '</td>
				<td>' . $userInfo['end_user_fullname'] . '</td>
				<td>' . $userLocation . '</td>
				<td>' . $userInfo['end_user_phone_number'] . '</td>
				<td>' . $product['product_name'] . ' mua ' . $r['order_quantity'] . ' Quyển' . '</td>
				<td>' . $r['created_at'] . '</td>
				<td>' . $state .'</td>
				<td>
					<button name="confirmOrder" class="btn btn-success" value="'.$r['order_id'].'">Đã xử lý</button>
					<button name="deleteOrder" class="btn btn-danger" value="'.$r['order_id'].'">Xóa</button>
				</td>
			</tr>
		';
		$info = array(
			'r' => $r,
			'userInfo'	=> $userInfo,
			'userLocation'	=>	$userLocation,
			'product'	=>	$product,
			'state'		=>	$state,
		);
		$return[$userInfo['end_user_email']][] = $info;
	}
	echo '<pre>';
	var_dump($return);
	die;
	echo $html;
?>
