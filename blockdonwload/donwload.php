<?php
include("../apps/libs/Dbconn.php");
include("VideoStream.php");
session_start();

if (!isset($_GET["key"])) die();
if (!isset($_GET["video_id"])) die();
$video_local = "../uploads/" . GetVideoLocal();

if (CheckKey()) {
    NewKey();
    $video = new VideoStream($video_local);
    $video->start();
    session_start();
    session_unset("key");
}

function CheckKey()
{
    if (isset($_SESSION["key"]))
        return true;
    else {
        $key = GetKey();
        if ($_GET["key"] == $key) {
            $_SESSION["key"] = $key;
            return true;
        } else return false;
    }
}

function GetKey()
{
    $param = [
        "from" => "videos",
        "select" => "keyss",
        "where" => "video_id='" . $_GET["video_id"] . "'"
    ];
    $db = new apps_libs_Dbconn();
    $result = $db->SelectOne($param);
    $row = mysqli_fetch_assoc($result);
    return $row["keyss"];
}

function GetVideoLocal()
{
    $param = [
        "from" => "videos",
        "select" => "video_source",
        "where" => "video_id=" . $_GET["video_id"]
    ];
    $db = new apps_libs_Dbconn();
    $result = $db->SelectOne($param);
    $row = mysqli_fetch_assoc($result);
    if(isset(json_decode($row["video_source"])[0]))
        return json_decode($row["video_source"])[0];
    else return "videos/".$row["video_source"];
}

function NewKey()
{
    $key = rand(1, 10000);
    $param = [
        "from" => "videos",
        "param" => [
            "col" => [
                "keyss"
            ],
            "data" => [
                $key
            ]
        ],
        "where" => "video_id=" . $_GET["video_id"]
    ];
    $db = new apps_libs_Dbconn();
    $db->Update($param);
}
?>