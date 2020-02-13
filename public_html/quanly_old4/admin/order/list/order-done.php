<?php
include_once('../../../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckAdmin()) die();

$id = $rt->GetPost("id");
if ($id == null || $id == "") die();
$db = new apps_libs_Dbconn();

$param = [
    "from" => "order_branch",
    "param"=>[
        "col"=>[
            "order_completed"
        ],
        "data"=>
        [
            1
        ]
        ],
    "where" => "order_id=$id"
];
$db->Update($param);

?>