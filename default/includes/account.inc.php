<?php
//	if(isset($_GET['action']) && $_GET['action'] == 'info') {
//		include TPL_DIR . '/_account-info.tpl.php';
//	}

if(isset($_GET['action']) && $_GET['action'] == 'info') {
    include INC_DIR . '/account-info.php';
}
	else if (isset($_GET['action']) &&  $_GET['action'] == 'course') {
		include TPL_DIR . '/_account-course.tpl.php';
	}
	else if (isset($_GET['action']) &&  $_GET['action'] == 'list') {
		include TPL_DIR . '/_account-list.tpl.php';
	}
    else if (isset($_GET['action']) &&  $_GET['action'] == 'change-password') {
        include TPL_DIR . '/change-password.tpl.php';
    }
?>
