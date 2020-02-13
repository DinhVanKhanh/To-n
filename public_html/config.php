<?php

	/**
	 * YIT - dp0613
	 * Don't delete this file
	 * Just copy and rename only
	 */

	/*Defining some constants for fixing url
	=====================================================*/
	define( 'ROOT', __dir__ );
	define( '_DEFAULT', ROOT . '/default/' );
	define( '_ADMIN', ROOT . '/admin/' );
	define( '_CORE', ROOT . '/core/' );
	define( '_MODULES', ROOT . '/modules/' );
	define( '_INSTALL', ROOT . '/install/' );
	define( 'TPL_DIR', _DEFAULT . 'templates/' );
	define( 'INC_DIR', _DEFAULT . 'includes/' );
	define( 'UPLOAD_DIR', ROOT . '/uploads/' );
	define('HOME','http://smartbrain.edu.vn');
	define('hinh_banquyen1', 'images/hinhbanquyen1.jpg');
	define('hinh_banquyen2', 'images/hinhbanquyen2.jpg');
	define('sidebar_img_macdinh1', 'images/sidebar_img_macdinh.jpg');
	define('sidebar_img_macdinh2', 'images/sidebar_img_macdinh2.jpg');
	define('sidebar_video_macdinh1', '<iframe width="560" height="315" src="https://www.youtube.com/embed/3vy3aVHwvnQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
	define('sidebar_video_macdinh2', '<iframe width="560" height="315" src="https://www.youtube.com/embed/YtEGu5Fa_fo" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>');
	
	define('banner_top_macdinh', 'images/banner_top_macdinh.jpg');
	define('banner_bottom_macdinh', 'images/banner_bottom_macdinh.jpg');
	define('main_content_macdinh','<p style="text-align:center"><img alt="" data-cke-saved-src="images/hinhbanquyen1.jpg" src="images/hinhbanquyen1.jpg" style="margin-left:20px; margin-right:20px; width:300px"><img alt="" data-cke-saved-src="images/hinhbanquyen2.jpg" src="images/hinhbanquyen2.jpg" style="height:435px; margin-left:20px; margin-right:20px; width:300px"></p><p>Lời mở đầu! Thưa quý độc giả; quý thầy cô; quý phụ huynh và các em học sinh thân mến! Thế kỷ 21 đang bùng nổ về Khoa học và Công nghệ cùng những ứng dụng Kỹ thuật số đa ngành, đa nghề; điều này đòi hỏi thế hệ trẻ, ngay từ bây giờ phải tư duy sáng tạo; đam mê học tập, nghiên cứu khoa học và phát huy hơn nữa tinh thần hiếu học mọi lúc; mọi nơi.</p><p>Toán học nói chung “Toán Tư Duy – Toán Trí Tuệ” nói riêng; là một bộ môn khoa học cơ bản và thiết thực nhất trong việc kích hoạt tư duy – phát triển trí tuệ; thông qua phương pháp rèn luyện các kỹ năng như: Nghe; nhìn; trả lời vấn đáp…, giúp các bạn Tự tin; tập trung; ghi nhớ; tưởng tượng; ảo tính nhanh; thông qua công cụ hỗ trợ học tập là chiếc bàn tính Soroban (Nhật Bản). Thực tế cho thấy, học sinh khi trải nghiệm chương trình “Toán Tư Duy – Toán Trí Tuệ” thời gian qua đã mang lại được nhiều lợi ích thiết thực như đã nói ở trên; ngoài ra tỷ lệ học sinh đạt chuẩn về kỹ năng tính nhanh qua các Cấp Độ của chương trình chiếm đa số. Toán Tư Duy – Toán Trí Tuệ Smart Brain; là 2 bộ giáo trình kỹ năng giải toán nhanh được ứng dụng trên bàn tính soroban và phương pháp đào tạo khoa học; dành cho các bạn ở độ tuổi từ 3 – 12 tuổi đã được Nhà sáng lập, tác giả đăng ký Bản quyền thành công tại Việt Nam và đang phát triển. Trí tuệ không ngừng uyên thâm; tư duy sáng tạo là vô hạn! Để giúp các bạn học sinh phát huy tối đa tiềm năng Não bộ và yêu thích Toán học hơn nữa. Tác giả tiếp tục biên soạn Bộ giáo trình “Toán Trí Tuệ Đỉnh Cao” Trên nền tảng công thức của Bộ giáo Trình Toán Trí Tuệ Smart Brain + cuả tác giả. Giúp các em đã trải nghiệm xong – Cấp Độ 8; hoàn thiện các thuật toán đã học và tăng cường sự “dài hơi” hơn trong sự học của mình. Bên cạnh đó Bộ Giáo trình Giúp Người học tư duy sâu hơn bằng các công thức (+; -; x; :) trên bàn tính soroban ở lớp triệu và lớp tỷ bằng những ví dụ minh họa thực tế và bài tập đa dạng. Đồng thời Bộ giáo trình này góp phần vào việc nghiên cứu khoa học của học sinh ở độ tuổi lớn hơn; sinh viên, giáo viên và cộng đồng yêu thích Toán Học; làm nền tảng cho sự phát triển toán học tư duy trong tương lai. Trân Trọng!</p><p>Tác giả: Nguyễn Đại Dương</p>');
	/*Defining some constants for connecting database
	=====================================================*/
	define( 'HOST', 'localhost' );
	define( 'USER', 'smartbrain_main' );
	define( 'PASS', '123@uUsmartbrain' );
	define( 'DBNAME', 'smartbrain_main' );

	/*Admin email
	=====================================================*/
	define( 'ADMIN_MAIL', 'txt95.kg@gmail.com' );

	/*Timezone
	=====================================================*/
	date_default_timezone_set( 'Asia/Ho_Chi_Minh' );

	/*Installing information
	====================================================*/
	define( 'INSTALLED', true );

	ini_set('display_errors',1); error_reporting(E_ALL);
?>
