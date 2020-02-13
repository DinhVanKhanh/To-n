<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckAdmin()) die();
if ($rt->GetPost('submit')) {
    $user_username = $rt->GetPost("user_username");
    $user_password = $rt->GetPost("user_password");
    $user_fullname = $rt->GetPost("user_fullname");
    $user_sdt = $rt->GetPost("user_sdt");
    $user_email = $rt->GetPost("user_email");
    $matp = $rt->GetPost("matp");
    $type_acc=$rt->GetPost("type_acc");
    $addre=$rt->GetPost("addre");

    if ($user_username == null || $user_username == "" ||
        $user_password == null || $user_password == "" ||
        $user_email == null || $user_email == "" ||
        $type_acc == null || $type_acc == ""||
        ($type_acc==2&&($matp==""||$matp==-1)) || empty($user_fullname)
        || empty($user_sdt)
    ) {
        echo create_noti(3, "Mời nhập đủ dữ liệu!");
        die();
    } else {
        $acc_child = new apps_model_User();
        if ($acc_child->InserUser($user_username,$user_password,$user_fullname,$user_sdt,$user_email,$addre,$type_acc+1,$matp))
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