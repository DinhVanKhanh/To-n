<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckAdmin())  die();

if ($rt->GetPost('submit')) {
    $id=$rt->GetPost("id");
    $name = $rt->GetPost("name");

    if ($name == null || $name == "") {
        echo create_noti(3, "Mời nhập đủ dữ liệu!".$name);
        die();
    } else {
        $classify_post = new apps_model_ClassifyPost($id);
        if ($classify_post->UpdateClassifyPost($name))
            echo create_noti(1, "Lưu thành công");
        else echo create_noti(4, "Lưu thất bại! trùng tên danh mục");
    }
}

function create_noti($classify_alerts, $mess)
{
    return json_encode([
        "classify_alerts" => $classify_alerts,
        "mess" => $mess
    ]);
}