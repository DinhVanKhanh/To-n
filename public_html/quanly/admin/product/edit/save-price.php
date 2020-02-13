<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckAdmin()) die();

if ($rt->GetPost('submit')) {
    $product_id = $rt->GetPost("product_id");
    $product_price = $rt->GetPost("product_price");
    $level=$rt->GetPost("level");

    if ($product_id == null || $product_id == ""
        || $product_price == null || $product_price == ""
        || $level == null || $level == "") {
        echo create_noti(3, "Mời nhập đủ dữ liệu!");
        die();
    } else {
        $price_product = new apps_model_PriceProduct();
        $data_price = $price_product->SelectPriceProductToIdProduct($product_id,$level);

        if ($data_price) {
            $id = $data_price['price_id'];
            $price = new apps_model_PriceProduct($id);
            if ($price->UpdatePriceProduct($product_price))
                echo create_noti(1, "Lưu thành công");
            else echo create_noti(4, "Lưu thất bại! có lỗi xảy ra");
        } else {
            $price = new apps_model_PriceProduct();
            if ($price->InserPriceProduct($product_id, $product_price,$level))
                echo create_noti(1, "Lưu thành công");
            else echo create_noti(4, "Lưu thất bại! có lỗi xảy ra");
        }
    }
}

function create_noti($classify_alerts, $mess)
{
    return json_encode([
        "classify_alerts" => $classify_alerts,
        "mess" => $mess
    ]);
}