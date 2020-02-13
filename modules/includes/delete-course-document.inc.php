<?php
	include_once("../../autoload.php");
	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database->get_connection();

	$baseURL = "/home/smartbrain/domains/smartbrain.edu.vn/public_html";


if(isset($_POST['documentID'])){

	//Get the document to unlink real file
	$sql = 'SELECT * FROM course_document WHERE id = :documentID;';

	$query = $conn->prepare($sql);

	$query->execute([
		'documentID' => $_POST['documentID']
	]);

	$document = $query->fetch(PDO::FETCH_ASSOC);

	$documentURL = $baseURL.$document['document_url'];

	//Delete the document
	$sql1 = 'DELETE FROM course_document WHERE id = :documentID;';

	$query1 = $conn->prepare($sql1);

	$query1->execute([
		'documentID' => $_POST['documentID']
	]);

	if(file_exists($documentURL)){
		unlink($documentURL);
	};

	print_r('Đã xóa tài liệu thành công!');
} else {
	print_r('Có lỗi trong quá trình xóa tài liệu.');
};
