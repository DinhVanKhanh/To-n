<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckBranch()) die();
if ($rt->GetPost('submit')) {
    $user_username = $rt->GetPost("user_username");
    $user_password = $rt->GetPost("user_password");
    $user_email = $rt->GetPost("user_email");
    $matp = $rt->GetPost("matp");

    if ($user_username == null || $user_username == "" ||
        $user_password == null || $user_password == "" ||
        $user_email == null || $user_email == "" ||
        $matp == null || $matp == "") {
        echo create_noti(3, "Mời nhập đủ dữ liệu!");
        die();
    } else {
        $acc_child = new apps_model_User();
        if ($acc_child->InserUser($user_username,$user_password,$user_email,'',3,$matp))
            echo create_noti(1, "Lưu thành công");
        else echo create_noti(4, "Lưu thất bại! Trùng tên tài khoản");
    }
}

function create_noti($classify_alerts, $mess)
{
    return json_encode([
        "classify_alerts" => $classify_alerts,
        "mess" => $mess
    ]);
}