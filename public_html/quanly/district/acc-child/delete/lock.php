<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
$db = new apps_libs_Dbconn();
// var_dump($_SESSION);die;
if (!$user->CheckDistrict()) die();
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
$sql = "update users set user_active = if(user_active = 0, 1, 0) where user_id = $id and matp = {$_SESSION['city']} ";
$db->query($sql);

?>