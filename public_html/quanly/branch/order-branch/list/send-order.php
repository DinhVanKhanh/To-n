<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckBranch()) die();

if ($rt->GetPost("submit")) {
    $json = $rt->GetPost("json");
    $data = json_decode($json, true);
    if ($data) {
        foreach ($data as $item) {
            $order_branch = new apps_model_OrderBranch();
            $order_branch->InserOrderBranch($user->GetAcc(), $item["product_id"], $item["quantity"]);
        }
        echo create_noti(1, "Đặt hàng thành công!");
        die();
    }
    echo create_noti(4, "Đặt hàng thất bại!");
    die();
}

function create_noti($classify_alerts, $mess)
{
    return json_encode([
        "classify_alerts" => $classify_alerts,
        "mess" => $mess
    ]);
}
?>