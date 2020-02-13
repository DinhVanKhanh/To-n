<?php

	include_once("../../autoload.php");
	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database->get_connection();

	if (isset($_POST['productID']) && isset($_POST['documentName'])){
		$productID = $_POST['productID'];
		$documentName = $_POST['documentName'];
	};
	if(!isset($_FILES["documentFile"]))
	{
		echo "Mời chọn file";
		die();
	}

	$targetDir = "../../uploads/documents/";
	$documentURL = $targetDir . basename($_FILES['documentFile']['name']);
	$usableURL = "/uploads/documents/" . basename($_FILES['documentFile']['name']);
	$uploadOk = 1;

	// Check if file already exists
	if (file_exists($documentURL)) {
	    echo "File đã tồn tại.";
	    $uploadOk = 0;
	};

	// Check file size
	if ($_FILES["documentFile"]["size"] > 1000000000) {
		echo "File quá lớn, không thể upload.";
		$uploadOk = 0;
	};

	if ($uploadOk == 0) {
		header("Refresh: 3; url=/admin.php?mod=products");
    	echo "Có lỗi trong quá trình upload file";

		// if everything is ok, try to upload file
	} else {
		
    	if (move_uploaded_file($_FILES["documentFile"]["tmp_name"], $documentURL)) {
    		$sql = 'INSERT INTO course_document (product_id, document_name, document_url) VALUES (:productID, :documentName, :documentURL);';

			$query = $conn->prepare($sql);

			$query->execute([
				':productID' => $productID,
				':documentName' => $documentName,
				':documentURL' => $usableURL
			]);

			header("Refresh: 3; url=/admin.php?mod=products");
			echo "Upload file thành công!";
        	
    	} else {
        	echo "Có lỗi trong quá trình upload file";
    	};
	};

	

