<?php
include_once("../../apps/libs/Dbconn.php");
require('../../autoload.php');

    /*Session_start
    ===========================================*/
$security = new Security();
$security->sec_session_start();

$user = unserialize($_SESSION['data']);
$userEmail = $user['end_user_email'];

$img = CopyImg($_POST["img"],$userEmail);
$param = null;
if ($img != "") {
    $param = [
        "from" => "end_users",
        "where" => "end_user_email='" . $userEmail . "'",
        "param" => [
            "col" => ["end_user_phone_number", "end_user_city", "end_user_district", "end_user_ward", "end_user_avatar"],
            "data" => [
                $_POST['phone'],
                "'" . $_POST['city'] . "'",
                "'" . $_POST['district'] . "'",
                "'" . $_POST['ward'] . "'",
                "'" . $img . "'"
            ]
        ]
    ];
} else {
    $param = [
        "from" => "end_users",
        "where" => "end_user_email='" . $userEmail . "'",
        "param" => [
            "col" => ["end_user_phone_number", "end_user_city", "end_user_district", "end_user_ward"],
            "data" => [
                $_POST['phone'],
                "'" . $_POST['city'] . "'",
                "'" . $_POST['district'] . "'",
                "'" . $_POST['ward'] . "'"
            ]
        ]
    ];
}

$database = new Database(HOST, USER, PASS, DBNAME);
$conn = $database -> get_connection();

$sql = "UPDATE end_users SET end_user_address = :address WHERE end_user_email = :userEmail; ";
$query = $conn->prepare($sql);
$query->execute(array(
    ':address' => $_POST['address'],
    ':userEmail' => $userEmail
));


$db = new apps_libs_Dbconn();
$db->Update($param);
header('Location: /index.php?view=account&action=info');

function CopyImg($img, $id_acc)
{
    if ($img == "") return "";
    $firtfile = "../../apps/rec/" . $img;
    $duoi = explode('.', $firtfile); // tách chuỗi khi gặp dấu .
    $duoi = $duoi[(count($duoi) - 1)];//lấy ra đuôi file
    $new = "../../uploads/images/" . $id_acc . '.' . $duoi;
    $new_img = $id_acc . '.' . $duoi;
    if (copy($firtfile, $new)) {
        return $new_img;
    }
    return "";
}
