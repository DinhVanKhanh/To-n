<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckAdmin()) die();

if ($rt->GetPost('submit')) {
    $user_id = $rt->GetPost("user_id");
    $user_password = $rt->GetPost("user_password");
    $user_email = $rt->GetPost("user_email");
    $addre=$rt->GetPost("addre");
    if ($user_id == null || $user_id == "" ||
        $user_password == null || $user_password == "" ||
        $user_email == null || $user_email == "") {
        echo create_noti(3, "Mời nhập đủ dữ liệu!");
        die();
    } else {
        $user = new apps_model_User($user_id);
        if ($user->UpdateUser($user_password,$user_email,$addre))
            echo create_noti(1, "Lưu thành công");
        else echo create_noti(4, "Lưu thất bại! Có lỗi xảy ra");
    }
}

function create_noti($classify_alerts, $mess)
{
    return json_encode([
        "classify_alerts" => $classify_alerts,
        "mess" => $mess
    ]);
}