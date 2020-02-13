  
  <?php
require_once('autoload.php');
  /*Session_start
  ===========================================*/
$security = new Security();
$security->sec_session_start();
if(!isset($_GET['u_id'])){
  header('location:'.HOME);
  exit;
}
$userId = $_GET['u_id'];
$_SESSION['adtudo_id'] = $userId;
$database = new Database( HOST, USER, PASS, DBNAME );
$conn = $database -> get_connection();
//Kiểm tra có phải trang admin tự do k
$query = "select * from users where user_id = {$userId} and user_type = 4";
$res = $conn->query($query)->fetch();
if(!isset($res['user_type']) || $res['user_type'] != 4){
    header('location:'.HOME);
    exit;
}
$query = "select * from admin_layout where user_id = {$userId}";
$layout = $conn->query($query)->fetch();
if($layout){
  $attribute = json_decode($layout['attribute'],true);
  $header = $attribute['header_banner'];
  $footer = $attribute['footer_banner'];
  $main_content = $layout['main_content'];
}
include TPL_DIR . '/_head.tpl.php' ;
?>
  <body class="home page-template-default page page-id-291 header-shadow lightbox nav-dropdown-has-arrow">
        
    <div id="wrapper">
              <?php include TPL_DIR . '/_header-main.tpl.php'; ?>
      <main class="clearfix">
        <div style="background-image: <?=isset($attribute)? $attribute['header_banner']['bg']: '' ?>; height: <?=isset($attribute)? $attribute['header_banner']['height']: '0' ?>px" class="bg banner-admin header-banner">
          <div id="headerbanner-content" class="banner-content">
            <?=isset($attribute)? $attribute['header_banner']['content']: '' ?>
          </div>
        </div>
        <hr style="margin: 0;background: linear-gradient(to bottom, blue ,white, purple); height:40px; opacity: 1">
        <div class="sidebar ">
          <section class="video_container">
            <?=!empty($attribute['sidebar_video_iframe2'])? $attribute['sidebar_video_iframe2']: sidebar_video_macdinh2 ?>
          </section>
          <section class="img_container">
            <img src='<?=!empty($attribute['sidebar_img_src1'])? $attribute['sidebar_img_src1']: sidebar_img_macdinh1 ?>'> 
          </section>
          <section class="video_container">
            <?=!empty($attribute['sidebar_video_iframe1'])? $attribute['sidebar_video_iframe1']: sidebar_video_macdinh1 ?>
          </section>
          <section class="img_container">
            <img src='<?=!empty($attribute['sidebar_img_src2'])? $attribute['sidebar_img_src2']: sidebar_img_macdinh2 ?>'> 
          </section>
        </div>
        <div class="main-content">
            <?=isset($main_content)? $main_content: '' ?>
        </div>
      </main>
      <div style="background-image: <?=isset($attribute)? $attribute['footer_banner']['bg']: '' ?>; height: <?=isset($attribute)? $attribute['footer_banner']['height']: '0' ?>px" class="bg banner-admin header-banner">
          <div id="headerbanner-content" class="banner-content">
            <?=isset($attribute)? $attribute['footer_banner']['content']: '' ?>
          </div>
        </div>
<?php include TPL_DIR . '/_footer.tpl.php'; ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('.main-content').height($('.sidebar').height() - 40);
  });
</script>
<style type="text/css">
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
    /*top:-150px;*/


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
  .main-content{
    background-color: white;
    width: 60%;
    float:right;
    padding: 20px;
    overflow: auto;
    box-sizing: border-box;
  }

  main{
    background-color: #E0E0E0!important;
  }
  .banner-admin th,.banner-admin td{
    border: none;
  }
    .sidebar{
    float: left;
    width: 40%;
    height: 100%;
    background: linear-gradient(to right, red , yellow);


  }
  .sidebar section{ 
    float: left;
    width: 100%;
    height: 47%;
    margin-top:2%;
    box-sizing: border-box;
    padding: 5px;
    text-align: center
  }
  section.video_container{
    margin-top: 0!important;
  }
  .sidebar section iframe,.sidebar section img{
    max-width: 100%;
    max-height: 100%;
    width:100%;

    /*object-fit: contain*/
  }
  /*.main-content{
    width: 60%;
    float: left;
    height: 500px;
  }*/
  .main-content::-webkit-scrollbar {
    width: 20px;
    background: transparent;
  }

/* Track */
.main-content::-webkit-scrollbar-track {
    background:  transparent;
    background-clip: content-box;   /* THIS IS IMPORTANT */
}

/* Handle */
.main-content::-webkit-scrollbar-thumb {
    /*background: black;*/
    background: linear-gradient(to right, blue, white,blue);
    border-radius: 5px;
    /*border: 20px solid black;*/
}
*::-webkit-scrollbar {
    width: 2px;
    background: transparent;
  }
*::-webkit-scrollbar-track {
    background:  transparent;
    
    background-clip: content-box;   /* THIS IS IMPORTANT */
}
*::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, black,white, black);
    border-radius: 5px;
}
@media only screen and (max-width: 800px) {
  .bg{
    background-size: cover;
  }
}
@media only screen and (max-width: 600px) {

  .sidebar, .main-content{
    width: 100%;
    height: 100%;
 /*   max-height: 600px;*/
  }
    .sidebar section iframe,.sidebar section img{
    max-width: 100%;
    max-height: 50%;

    margin: auto;
    object-fit: contain
  }
}
</style>