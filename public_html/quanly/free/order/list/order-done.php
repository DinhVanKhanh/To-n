<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckFree()) die();

$id = $rt->GetPost("id");

if ($id == null || $id == "") die();
$db = new apps_libs_Dbconn();
//Lấy thông tin đơn hàng
$sql = "select * from orders where order_id = $id";
$order = $db->query($sql)[0];
// Lấy thông tin khách hàng
$sql = "select * from end_users where end_user_id = {$order->order_user}";
$customer = $db->query($sql,$db)[0];
if($customer->adtudo_id == $_SESSION['userID']){
    $param = [
        "from" => "orders",
        "param"=>[
            "col"=>[
                "order_completed"
            ],
            "data"=>
            [
                1
            ]
            ],
        "where" => "order_id=$id"
    ];
    $db->Update($param);
}
?>