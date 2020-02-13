<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckAdmin()) die('meo fai admin');

$id = $rt->GetPost("id");

if ($id == null || $id == "") die();

// $classify_post=new apps_model_ClassifyPost($id);
// if (!$classify_post->SelectClassifyPost()) die();

$db = new apps_libs_Dbconn();

$param = [
    "from" => "order_branch",
    "where" => "order_id='" . $id . "'"
];
$db->Delete($param);


?>