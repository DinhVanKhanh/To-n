<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
$db = new apps_libs_Dbconn();
if (!$user->CheckBranch()) die();
$ret_quanhuyen = $db->getAllQh();

// var_dump($allQh);die;
$id = $rt->GetPost("id");
if ($id == null || $id == "") die();
// Lấy tất cả tỉnh và huyện
// Lấy mã quạn huyện thành phố ra làm key array
foreach($ret_quanhuyen as $k => $v){
    $v->maqh = (int)$v->maqh;
    $v->matp = (int)$v->matp;
    $quanhuyen[(int)$v->maqh] = $v;
}

// Admin tỉnh nên lấy mã quận huyện để lấy admin huyện và tự do con. Tạo kiểu list để truy xuất csdl
$user_maqh_list = '(';
foreach($quanhuyen as $k => $v){
    if($v->matp == $_SESSION['city'])
        $user_maqh_list .= $v->maqh.',';
}
$user_maqh_list = rtrim($user_maqh_list,',');
$user_maqh_list.= ')';
// $user=new apps_model_User($id);
// if (!$user->SelectUser()) die();
$sql = "update users set user_active = if(user_active = 0, 1, 0) where user_id = $id and matp in $user_maqh_list";
$db->query($sql);

?>