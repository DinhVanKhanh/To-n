<?php
	require_once('../../config.php');

	if(isset($_FILES['filesToUpload'])) {
		$destination = $_POST['destination'];
		$prefix = $_POST['prefix'];
		$urls = array();
		for($i = 0; $i < count($_FILES['filesToUpload']['name']); $i++) {
			$extensionParts = explode('/', $_FILES['filesToUpload']['type'][$i]);
			$extension = $extensionParts[1];

			//Check extension
			$allows = ['jpeg', 'jpg', 'png', 'mp4'];
			if(!in_array($extension,$allows)) {
				exit;
			}

			$fileName = $destination . '/' . $prefix . time() . '-' . $i . '.' . $extension;

			//Uploading
			$r = move_uploaded_file($_FILES['filesToUpload']['tmp_name'][$i], UPLOAD_DIR . $fileName );
			$r ? array_push($urls, $fileName) : false;
		}

		echo json_encode($urls);
	}
?>
