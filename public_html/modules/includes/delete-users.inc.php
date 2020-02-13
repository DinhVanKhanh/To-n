<?php
include_once("../../autoload.php");
$database = new Database(HOST, USER, PASS, DBNAME);
$conn = $database->get_connection();
$sql = 'DELETE FROM end_users WHERE end_user_id = :userId;';
$query = $conn->prepare($sql);
$query->execute(array(
    ':userId' => $_POST['userID']
));

$result = ['message' => 'Đã xóa thành viên'];
print_r(json_encode($result));
