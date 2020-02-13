<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
$db = new apps_libs_Dbconn();
if (!$user->CheckAdmin()) die();

if ($rt->GetPost('submit')) {
    $user_id = $rt->GetPost("user_id");
    $user_password = $rt->GetPost("user_password");
    $user_fullname = $rt->GetPost("user_fullname");
    $user_sdt = $rt->GetPost("user_sdt");
    $user_type = $rt->GetPost("type_acc");
    $matp = $rt->GetPost("matp");
    $user_email = $rt->GetPost("user_email");
    $addre=$_POST['addre'];

    if ($user_id == null || $user_id == "" ||
        $user_password == null || $user_password == "" ||
        $user_email == null || $user_email == "" ||
        empty($matp) || $matp < 0
    ) {
        echo create_noti(3, "Mời nhập đủ dữ liệu!");
        die();
    } else {
        $user = new apps_model_User($user_id);
        $sql = "update users set user_fullname= '$user_fullname', user_password = '$user_password', user_sdt = '$user_sdt', user_type = $user_type, matp = $matp, addre = '$addre' where user_id = $user_id";

        if ($db->voidQuery($sql))
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