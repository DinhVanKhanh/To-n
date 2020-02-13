<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckBranch()) die();

$id = $rt->GetPost("id");

if ($id == null || $id == "") die();

$user=new apps_model_User($id);
if (!$user->SelectUser()) die();

$db = new apps_libs_Dbconn();

$param = [
    "from" => "users",
    "where" => "user_id='" . $id . "'"
];
$db->Delete($param);

?>