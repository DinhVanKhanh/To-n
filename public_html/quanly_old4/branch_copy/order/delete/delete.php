<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckAdmin()) die();

$id = $rt->GetPost("id");

if ($id == null || $id == "") die();

$classify_post=new apps_model_ClassifyPost($id);
if (!$classify_post->SelectClassifyPost()) die();

$db = new apps_libs_Dbconn();

$param = [
    "from" => "tb_classify_post",
    "where" => "id='" . $id . "'"
];
$db->Delete($param);

$param = [
    "from" => "tb_post",
    "where" => "id_classify_post='$id'",
    "param" => [
        "col" => [
            "id_classify_post"
        ],
        "data" => [
            "''"
        ]
    ]
];
$db->Update($param);

?>