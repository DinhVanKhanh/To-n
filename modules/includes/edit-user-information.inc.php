<?php
// include_once("../../apps/libs/Dbconn.php");
require('../../autoload.php');

$database = new Database(HOST, USER, PASS, DBNAME);
$conn = $database -> get_connection();

$sql = "UPDATE end_users SET end_user_email = :email,
							 end_user_password = :password,
							 end_user_fullname = :fullName,
							 end_user_phone_number = :phone,
							 end_user_city = :city,
							 end_user_district = :district,
							 end_user_address = :address,
							 end_user_ward = :ward 
							 WHERE end_user_id = :userID; ";
$query = $conn->prepare($sql);

$query->execute(array(
	':email' => 	$_POST['email'],
	':password' => $_POST['password'],
	':fullName' => $_POST['fullName'],
	':phone' => $_POST['phone'],
	':city' => $_POST['city'],
	':district' => $_POST['district'],
	':address' => $_POST['address'],
	':ward' => $_POST['ward'],
	':userID' => $_POST['userID']

));

// $param = [
//         "from" => "end_users",
//         "where" => "end_user_id='" . $_POST['userID'] . "'",
//         "param" => [
//             "col" => ["end_user_email", "end_user_password" ,"end_user_fullname" , "end_user_phone_number", "end_user_city", "end_user_district", "end_user_address", "end_user_ward"],
//             "data" => [
//             	$_POST['email'],
//             	$_POST['password'],
//             	$_POST['fullName'],
//                 $_POST['phone'],
//                 $_POST['city'],
//                 $_POST['district'],
//                 $_POST['address'],
//                 $_POST['ward']
//             ]
//         ]
//     ];

// $db = new apps_libs_Dbconn();
// $db->Update($param);

header('Location: http://smartbrain.edu.vn/admin.php?mod=end-users');