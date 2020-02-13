<?php
	require('../../autoload.php');
	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database -> get_connection();

	if (isset($_POST['targetUser'])){
		$sql = 'UPDATE end_users SET end_user_lock = :newUserStatus WHERE end_user_id = :targetUser;';

		$query = $conn->prepare($sql);

		if ($_POST['userStatus'] == 1){
			$newUserStatus = 0;
			$result = ['message' => 'Đã khóa thành viên thành công.', 'status' => 'Đã khóa'];
		} else if($_POST['userStatus'] == 0) {
			$newUserStatus = 1;
			$result = ['message' => 'Đã mở khóa thành viên thành công.',  'status' => 'Đang hoạt động'];
		};

		$query->execute(array(
			':newUserStatus' => $newUserStatus,
			':targetUser' => $_POST['targetUser']
		));

		print_r(json_encode($result));
	} else {
		$result = ['message' => 'Có lỗi trong quá trình khóa/mở khóa thành viên.'];
	};