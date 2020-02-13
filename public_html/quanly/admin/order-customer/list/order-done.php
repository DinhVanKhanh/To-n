<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckAdmin()) die();

$id = $rt->GetPost("id");
if ($id == null || $id == "") die();
$db = new apps_libs_Dbconn();
//Lấy thông tin đơn hàng
$sql = "select * from orders where order_id = $id";
$order = $db->query($sql)[0];
if($order->order_type == 1){
    // Nếu khách hàng vãng lai thì admin có quyền xử lý
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