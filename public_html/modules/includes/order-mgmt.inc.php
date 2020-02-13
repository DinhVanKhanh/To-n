<?php
	require_once( '../../autoload.php' );
	$security = new Security();
	$database = new Database( HOST, USER, PASS, DBNAME );
	$security -> sec_session_start();
	$userID = $_SESSION['userID'];
	// if(isset($_POST['orderPage'])){
		// $omitNumber = 20 * ($_POST['orderPage'] - 1);

		$sql = "SELECT orders.* FROM `orders`,end_users WHERE order_user = end_users.end_user_id and end_users.adtudo_id = $userID ORDER BY order_completed ASC,created_at DESC " ;
	// } else {
	// 	$sql = "SELECT orders.* FROM `orders`,end_users WHERE order_user = end_users.end_user_id and end_users.adtudo_id = $userID ORDER BY order_completed ASC,created_at DESC LIMIT 20;";
	// };

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
		($r['order_completed'] == 0) ? $state = '<i style="background:yellow">Chưa xử lý</i>' : $state = '<i style="background:green;color:white">Đã xử lý</i>';

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
	// echo '<pre>';
	// var_dump($return);
	// die;
	// echo $html;
?>
<div class="bg-overlay"></div>
<table id ="table-donhang" class="table table-bordered table-hover">
	<thead>
	<tr style="background: linear-gradient(to bottom,blue, white, blue)">
		<th>STT</th>
		<th>Mail Người Mua</th>
		<th>Tên Người Mua</th>
		<th>Ngày Mua</th>
		<th>Tình Trạng</th>
		<th>Tổng Tiền</th>

	</tr>
	</thead>
	<tbody>
	<?php
	//Vòng lặp tạo tóm tắt đơn hàng theo email từng người
	$i = 1;
	if(empty($return))
		exit;
	foreach($return as $k => $v):
		$tongtien = 0;
		foreach($v as $k1 => $v1){
			// if($v1['r']['order_completed'] != 0)
				$tongtien += $v1['r']['order_quantity'] * $v1['product']['product_price'] ;
		}
	?>
		<tr>
			<td><?= $i ?></td>
			<td class="email" data-slot="<?=$i?>"><a href="javascript:void(0)" ><?= $k ?></td>
			<td><?= $v[0]['userInfo']['end_user_fullname']?></td>
			<td><?= $v[0]['r']['created_at']?></td>
			<td><?= $v[0]['state']?></td>
			<td><?= $tongtien?></td>

			
	<?php $i++; endforeach;?>
	</tbody>
</table>
<?php 
// Lặp để lấy chi tiết tất cả đơn hàng
$i = 1;
foreach($return as $k => $v):
	$tongtien = 0;
		foreach($v as $k1 => $v1){
			if($v1['r']['order_completed'] != 0)
				$tongtien += $v1['r']['order_quantity'] * $v1['product']['product_price'] ;
		}
?>
	<!--Bảng tất cả đơn hàng của từng khách khi click vào khách sẽ hiện ra-->
	<div class="wrap-detail" data-slot="<?=$i?>">
				<div style="width:100%;height:100%;overflow: auto">
					<div class="customer_info col-md-7" style="font-size:18px;float: left;text-align: left;">

						<span>Họ Tên Khách Hàng: <bold style="font-size:22px;color: red;display: inline-block;"> <?= $v[0]['userInfo']['end_user_fullname']?></bold></span><br>
						<span>Sdt: <?= $v[0]['userInfo']['end_user_phone_number']?></span><br>

					<span>Địa chỉ: <?= $v[0]['userLocation'] ?></span>
					</div>
					<div class="col-md-5" style="text-align: left;font-size: 18px">
						<span>Tổng tiền: <i style="font-size:22px;"><?=$tongtien?></i></span><br>
						<button class="xulytatca_btn btn btn-success">
							Xử lý đơn
						</button>
						<button class="xoatatca_btn btn btn-danger">
							Xóa đơn đã xử lý
						</button>
					</div>
				
				<table class="table table-bordered table-hover detail" >
					<thead>
						<tr style="background: linear-gradient(to bottom,blue, white, blue)">
							<td>STT</td>
							<td>Khóa học</td>
							<td>Số lượng</td>
							<td>Ngày đặt hàng</td>
							<td>Thành tiền</td>
							<td>Tình trạng</td>
							<td>Báo đã xử lý</td>
						</tr>
					</thead>
					<tbody>
				<?php
				$j = 1;
				foreach($v as $key => $val):
					$thanhtien = $val['r']['order_quantity'] * $val['product']['product_price'];
				?> 
					<tr id="<?= $val['r']['order_id']?>" class="order_id" data-status="<?= $val['r']['order_completed']?>">
						<td><?= $j?></td>
						<td><?= $val['product']['product_name']?></td>
						<td><?= $val['r']['order_quantity'] ?></td>
						<td><?= $val['r']['created_at']?></td>
						<td><?= $thanhtien ?></td>
						<td><?= $val['state']?></td>
						

						<td><button name="confirmOrder" class="btn btn-success" value="<?=$val['r']['order_id']?>">Đã xử lý</button>
						<button name="deleteOrder" class="btn btn-danger" value="<?=$val['r']['order_id']?>">Xóa</button></td>
					</tr>
				<?php $j++;endforeach;?>
				</tbody>
				</table>
				</div>
			</div>
			
<?php
	$i++;
	 endforeach;
	
?>
