<?php
require_once('autoload.php');
	/*Session_start
	===========================================*/
// $security = new Security();
// $security->sec_session_start();
	session_start();

if( $_SESSION['typeAcc'] == 4  )
	$userId = $_SESSION['userID'];
else{
	echo 'Bạn không có quyền truy cập trang này, vui lòng đăng nhập';
	header("refresh:3; url=".HOME);
	exit;
}

// Tạo kết nối db với pdo
$database = new Database( HOST, USER, PASS, DBNAME );
$conn = $database -> get_connection();
//Nếu có gửi post về thì insert hoặc update
if(!empty($_POST)){
	// gom thông số header và footer banner vào attribute rồi serialize
	$attribute = array();
	// Nếu ko truyển sidebar video thì lấy sidebar video mặc định
	if(!empty($_POST['sidebar_video_iframe1']))
		$sidebar_video_iframe = $_POST['sidebar_video_iframe1'];
	else
		$sidebar_video_iframe = sidebar_video_macdinh1;
	if(!empty($_POST['sidebar_video_iframe2']))
		$sidebar_video_iframe2 = $_POST['sidebar_video_iframe2'];
	else
		$sidebar_video_iframe2 = sidebar_video_macdinh2;
	// Nếu ko truyền sidebar image thì lấy sidebar mặc định
	if(!empty($_POST['sidebar_img_src1']))
		$sidebar_img_src = $_POST['sidebar_img_src1'];
	else
		$sidebar_img_src = sidebar_img_macdinh1;
	if(!empty($_POST['sidebar_img_src2']))
		$sidebar_img_src2 = $_POST['sidebar_img_src2'];
	else
		$sidebar_img_src2 = sidebar_img_macdinh2;

	$attribute['header_banner'] = $_POST['header_banner'];
	$attribute['footer_banner'] = $_POST['footer_banner'];
	$attribute['sidebar_video_iframe1'] = $sidebar_video_iframe;
	$attribute['sidebar_video_iframe2'] = $sidebar_video_iframe2;
	$attribute['sidebar_img_src1'] = $sidebar_img_src;
	$attribute['sidebar_img_src2'] = $sidebar_img_src2;
	// echo'<pre>';
	// var_dump($attribute);die;
	$attribute = json_encode($attribute);
	$main_content = $_POST['main_content'];
	// Lưu vào csdl nếu chưa có thì insert có r thì update
	$query = "insert into admin_layout(user_id, attribute, main_content) values( :userId, :attribute, :main_content) on duplicate key update attribute = :attribute, main_content = :main_content";
	$prepared = $conn->prepare($query);

	$res = $prepared->execute(array(
		':userId' 		=> $userId,
		':main_content'	=> $main_content,
		':attribute'	=> $attribute,
	));

	//Nếu ko save vào csdl dc bật thông báo và chuyển trang
	// if(!$res){
	// 	echo 'Không thể lưu thông tin, vui lòng kiểm tra lại hoặc liên hệ ban quản trị </br>';
	// 	echo 'Trang sẽ tự chuyển sau 5s';
	// 	header('refresh:6s');
	// 	exit;
	// }
}
//Lấy thông số admin layout hiện tại

$query = "select * from admin_layout where user_id = {$userId}";

$layout = $conn->query($query)->fetch();

if($layout){
	$attribute = json_decode($layout['attribute'],true);
	$header = $attribute['header_banner'];
	$footer = $attribute['footer_banner'];
	$main_content = $layout['main_content'];
}
// var_dump($attribute);die;
// echo '<pre>';
// var_dump($attribute);die;


		// $sql = "INSERT INTO posts( post_title, post_time, post_content, post_tags, cate_id, post_uri ) VALUES ( :post_title, :post_time, :post_content, :post_tags, :cate_id, :post_uri );";
		
		// $query = $conn -> prepare( $sql );
		// $r = $query -> execute( array( 
		// 	':post_title' => $_POST['post_title'],
		// 	':post_time' => time(),
		// 	':post_content' => $_POST['post_content'],
		// 	':post_tags' => $_POST['post_tags'],
		// 	':cate_id' => $_POST['post_cate'],
		// 	':post_uri' => convert_utf8( $_POST['post_title'] ) . '-' . time() 
		// ) );

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Title of the document</title>
</head>
	<script
	  src="https://code.jquery.com/jquery-3.3.1.min.js"
	  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	  crossorigin="anonymous">
	 </script>
	<script type="text/javascript" src="js\ckeditor\ckeditor\ckeditor.js"></script>
	<!-- <script type="text/javascript" src="js\ckeditor\ckfinder\ckfinder.js"></script> -->
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script type="text/javascript">
  	$(document).ready(function($){

  	});
  </script>
  <script type="text/javascript">
  		// CKFinder.setupCKEditor();
  		CKEDITOR.replace('main-content');
  		CKEDITOR.inline('headerbanner-content');
  </script>
<body>
	<div style="margin: 30px auto; width: 80%;">Link giới thiệu của bạn là: <a href="<?= HOME.'/ad_show.php?u_id='.$userId?>"> <?= HOME.'/ad_show.php?u_id='.$userId?></a></div>
	<!-- Banner cho header -->
	<form style="margin-top: 50px" action="" method="post" >
	<h2>Banner Top</h2>
	<div style="background-image: <?=isset($attribute)? $attribute['header_banner']['bg']: banner_top_macdinh ?>; height: <?=isset($attribute)? $attribute['header_banner']['height']: '0' ?>px" class="bg banner-admin header-banner">
		<textarea style="display: none" class="banner_bg" name="header_banner[bg]"></textarea>
		
		<textarea style="display: none" class="banner-content" name="header_banner[content]"></textarea>
		<div contenteditable="true" id="headerbanner-content" class="banner-content">
			<?=!empty($attribute['header_banner']['content'])? $attribute['header_banner']['content']: '' ?>
		</div>
		<!-- Chỉnh độ cao cho banner-->
		<button type="button" class="btn btn-primary select-banner">Chọn banner</button>
		<section class="url_banner hidden" >
			<h3>Địa chỉ hình</h3>
			<span>X</span>
			<input type="text" name="">
			<button type="button" class="btn btn-primary">Chọn</button>
		</section>
		<label ><bold>Chọn chiều cao banner</bold></label>
		<input  type="number" class="banner-height" name="header_banner[height]" value="<?=isset($attribute)? $attribute['header_banner']['height']: '' ?>"></input>   
		<button style="float: right;" type="button" class="btn btn-primary reset-banner">Reset mặc định</button> 
		
	</div>
	<hr style="margin: 10px 0; border:3px solid white">
	<!-- Content viết nội dung như 1 page -->
<main class="clearfix">
	<div class="sidebar ">
		<section class="video_container">
			<input type="text" name="sidebar_video_iframe1" placeholder="Nhập link chia sẽ" value='<?=!empty($attribute['sidebar_video_iframe1'])? $attribute['sidebar_video_iframe1']: sidebar_video_macdinh1 ?>'>

			<?=!empty($attribute['sidebar_video_iframe1'])? $attribute['sidebar_video_iframe1']: sidebar_video_macdinh1 ?>
		</section>
		<section class="img_container">
			<input type="text" name="sidebar_img_src1" placeholder="Nhập địa chỉ image " value='<?=!empty($attribute['sidebar_img_src1'])? $attribute['sidebar_img_src1']: sidebar_img_macdinh1 ?>'>
			<img src='<?=!empty($attribute['sidebar_img_src1'])? $attribute['sidebar_img_src1']: sidebar_img_macdinh1 ?>'> 
		</section>
		<section class="video_container">
			<input type="text" name="sidebar_video_iframe2" placeholder="Nhập link chia sẽ" value='<?=!empty($attribute['sidebar_video_iframe2'])? $attribute['sidebar_video_iframe2']: sidebar_video_macdinh2 ?>'>

			<?=!empty($attribute['sidebar_video_iframe2'])? $attribute['sidebar_video_iframe2']: sidebar_video_macdinh2 ?>
		</section>
		<section class="img_container">
			<input type="text" name="sidebar_img_src2" placeholder="Nhập địa chỉ image " value='<?=!empty($attribute['sidebar_img_src2'])? $attribute['sidebar_img_src2']: sidebar_img_macdinh2 ?>'>
			<img src='<?=!empty($attribute['sidebar_img_src2'])? $attribute['sidebar_img_src2']: sidebar_img_macdinh2?>'> 
		</section>
	</div>
	<div class="main-content">
		<h2>Main Content</h2>
		<textarea class="ckeditor" id="main-content" name="main_content">
			<?=!empty($main_content)? $main_content: main_content_macdinh ?>
		</textarea>
	</div>
</main>
	<!-- Banner cho footer -->
	<h2>Footer Banner</h2>
	<div style="background-image: <?=isset($attribute)? $attribute['footer_banner']['bg']: ''?>; height: <?=isset($attribute)? $attribute['footer_banner']['height']: '0' ?>px" class="bg banner-admin footer-banner">
		<textarea style="display: none" class="banner_bg" name="footer_banner[bg]"></textarea>
		<textarea style="display: none" class="banner-content" name="footer_banner[content]"></textarea>
		<div contenteditable="true" id="footerbanner-content" class="banner-content">
			<?=isset($attribute)? $attribute['footer_banner']['content']: '' ?>
		</div>
		
		<!-- Chỉnh độ cao cho banner-->
		<button type="button" class="btn btn-primary select-banner">Chọn banner</button>
		<section class="url_banner hidden" >
			<h3>Địa chỉ hình</h3>
			<span>X</span>
			<input type="text" name="">
			<button type="button" class="btn btn-primary">Chọn</button>
		</section>
		<label><bold>Chọn chiều cao banner</bold></label>
		<input type="number" class="banner-height" name="footer_banner[height]" value="<?=isset($attribute)? $attribute['footer_banner']['height']: '' ?>"></input>    
		<button style="float: right;" type="button" class="btn btn-primary reset-banner">Reset mặc định</button> 
	</div>
	<button style="margin:30px; float: right"  type="button" class="btn btn-primary btn-lg submitbtn"> submit</button>
	<input type="hidden" name="">
	</form>
	<script>
	$(document).ready(function(){
		$('.submitbtn').click(function(e){
			form = $(this).parent('form');
			// Lọc qua tất cả banner để gán dữ liệu vào input 
			$('.banner-admin').each(function(){
				// tạo textarea chứa content của banner
				text_content = $(this).children('textarea.banner-content');
				//lấy nội dung của content và đổ vào textarea để submit
				content = text_content.siblings('div.banner-content').html();
				text_content.html(content);
				// biến chứa toàn bộ banner và css background
				banner = $(this);
				// tạo biến chứa css bg_image và chuyển vào textarea đé gưi POST
				img_contain = text_content.siblings('textarea.banner_bg');
				img_url 	= banner.css('background-image');
				img_url = img_url.replace(/\"/g, '\'');
				// truyền background-img vào textarea để submit
				img_contain.html(img_url);
				// console.log(img_url);
			});
			form.submit();
		});
		$('.banner-height').change(function(){
			banner = $(this).parent();
			banner.css('height',$(this).val());
		});
		$('.select-banner').click(function(){

			var banner = $(this).parent();
			var url = $(this).siblings('.url_banner');
			var btn_submit = url.children('button');
			var input = url.children('input');
			var close = url.children('span');
			url.show();
			close.click(function(){
				url.hide();
			});
			btn_submit.click(function(){
				input_val =  input.val();
				banner.css({"background-image": "url('"+input_val+"')"});
				url.hide();
			});
		});
		// $('.select-banner').click(function(){
		// 	var banner = $(this).parent();
		// 	CKFinder.popup( {
  //                chooseFiles: true,
  //                onInit: function( finder ) {
  //                    finder.on( 'files:choose', function( evt ) {
  //                        var file = evt.data.files.first();
  //                        banner.css({"background-image": "url('"+file.getUrl()+"')"});
 
  //                    } );
  //                    finder.on( 'file:choose:resizedImage', function( evt ) {
  //                        // banner. = evt.data.resizedUrl;
  //                        console.log(resizedUrl);
  //                    } );
  //                }
  //            } );
		// });
		$('.reset-banner').click(function(){
			var banner = $(this).parent();
			
			height = $(this).siblings('.banner-height');
			content = $(this).siblings('div.banner-content');
			
			if(banner.hasClass('footer-banner')){
				banner.css({"background-image": "url('<?= banner_bottom_macdinh?>')"});
				height.val(150).change();
			}else{
				banner.css({"background-image": "url('<?= banner_top_macdinh?>')"});
				height.val(400).change();
			}
			content.empty();
		});

	});
		

     </script>
     
</body>

</html>
<style type="text/css">
	.hidden{
		display: none;
	}
	.url_banner{
		width:50%;
		height:140px;
		position: fixed;
		top: 30%;
		left:25%;
		background:whitesmoke;
		text-align: center;

	}
	.url_banner input{
		border-radius: 30px;
		line-height: 30px;
		width: 100%;
	}
	.url_banner button{
		float: right;
		line-height: 25px;
		margin-top: 10px;
	}
	.url_banner span{
		position: absolute;
		top: 10px;
		right: 10px;
		cursor: pointer;
	}
	.bg{
		width: 100%;
		height: 100%;
	/*background-image: url(http://www.guibingzhuche.com/data/out/268/1718528.png);*/
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: 100% 100%;
	}
	.banner-admin{
		width: 100%;

		/*max-height: 400px;*/
	}
	.banner-content{
		height: 100%;
		overflow: hidden;

	}
	.banner-img{
		width: 100%;
		height: 100%;
		min-height: 100px;
		border: blue 1px solid;
		position: absolute;
		top: 0;
		left: 0;
		
	}

	.sidebar{
		float: left;
		width: 35%;
		height: 100%;
	}
	.sidebar section{ 
		float: left;
		width: 100%;
		height: 45%;
		margin-top:4%;
		box-sizing: border-box;
		padding-left: 10px;
		text-align: center
	}
	section .video_container{
		margin-top: 0!important;
	}
	.sidebar section input{
		border-radius: 15px;
		height: 10%;
		width: 100%;

	}
	.sidebar section iframe,.sidebar section img{
		max-width: 100%;
		max-height: 90%;
		width:100%;

		/*object-fit: contain*/
	}
	.main-content{
		width: 65%;
		float: left;
		height: 500px;
	}
	main{
		margin-top:100px;

	}
@media only screen and (max-width: 800px) {
  .bg{
    background-size: cover;
  }
}
@media only screen and (max-width: 600px) {

	.sidebar, .main-content{
		width: 100%;
	}
    .sidebar section iframe,.sidebar section img{
		max-width: 90%;
		max-height: 100%;
		margin: auto;
/*		object-fit: contain
*/	}
}
</style>