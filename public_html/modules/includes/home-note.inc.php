<?php 
	require_once( '../../autoload.php' );
	
	$note = 'Hiện tại không có thông báo nào ^^';
	
	/*Check exists of install folder
	=================================================*/
	if( is_dir( ROOT . '/install' ) || is_file( ROOT . '/install.php' ) ) {
		$note = '
			<p><big>!</big> Bạn nên xóa thư mục <b>install</b> và file <b>install.php</b> để apache chuyển hướng chính xác và đảm bảo an toàn cơ sở dữ liệu.</p>
		';
	}
	
	echo $note;
?>