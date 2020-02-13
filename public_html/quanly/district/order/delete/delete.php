<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckDistrict()) die();

$id = $rt->GetPost("id");
if ($id == null || $id == "") die();

// $classify_post=new apps_model_ClassifyPost($id);

// if (!$classify_post->SelectClassifyPost()) die();
// var_dump($id);die;
$db = new apps_libs_Dbconn();
function query($sql,$db){
	$res = $db->Querry($sql);
	$arr = array();
	while ( $row = mysqli_fetch_object($res)) {
		$arr[] = $row;
	}
	return $arr;
}
// Lấy thông tin đơn hàng
$sql = "select * from orders where order_id = $id";
$order = query($sql,$db)[0];
// Lấy thông tin khách hàng
$sql = "select * from end_users where end_user_id = {$order->order_user}";
$customer = query($sql,$db)[0];
//Nếu đơn hàng dạng 3 là ko có admin tự do thì admin huyện dc xử lý
if($order->order_type == 3){
	// Nếu khách hàng thuộc huyện của nó thì cho xử lý
	if($customer->end_user_district == $_SESSION['city']){
		$param = [
		    "from" => "orders",
		    "where" => "order_id='" . $id . "'"
		];
		$db->Delete($param);
	}
}



?>