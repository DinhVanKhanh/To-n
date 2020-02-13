<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckAdmin()) die();

$id = $rt->GetPost("id");

if ($id == null || $id == "") die();

$user=new apps_model_User($id);
if (!$user->SelectUser()) die();

$db = new apps_libs_Dbconn();
$sql = "update users set user_active = if(user_active = 0, 1, 0) where user_id = $id";
$db->query($sql);

?>