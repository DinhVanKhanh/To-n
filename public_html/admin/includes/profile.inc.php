<?php
	if( isset( $_SESSION['dp_logged'] ) && $_SESSION['dp_logged'] ) {
		$html = '
			<div class="dp-profile">
				<p>Xin chào, ' . $_SESSION['dp_username'] . ' <a href="logout.php?r=login.php">Đăng xuất</a></p>
			</div>
		';
	}
	echo $html;
?>
