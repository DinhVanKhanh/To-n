<?php
  include('apps/bootstrap.php');

  $a = new apps_libs_Dbconn();

  //truy xuất dữ liệu
  $sql = "select * from optionn";                     
$run = $a->Querry($sql);
$i=1;

 ?>

<!-- #main -->
<style>
@media only screen and (min-width: 768px) {
    .footer-1,.footer-2,.footer-3{
		width:33.333%;
		text-align:left;
	}
    .dki{
      width:200px;
    }
}
@media only screen and (max-width: 768px) {
    .footer-1,.footer-2,.footer-3{
		width:80%;
		margin-left:10%;
		text-align:center;
		
	}
	.chuoduane ul{
			margin: auto;
	}
}

.footer-footer{
  /*border: 1px solid red;*/
  background-color: #333;
 /* height: 400px;*/
 
}

.footer-unline{
 /* border:1px solid red;*/
  margin-top: 50px;
  /*height: 300px;*/
  background-color: #333;
}

.footer-1{
  float:left;
  /*width: 340px;*/
 /* border: 1px solid violet;*/
 /* height: 300px;*/

  background-color: #333;
}

.footer-2{
  float: left;
 /* width: 340px;*/
  /*border: 1px solid blue;*/
  /*height: 300px;*/

  background-color: #333;
}

.footer-3{
  float:left;
 /* width: 350px;*/
  /*border: 1px solid black;*/
 /* height: 300px;*/
}

.footer-col-1 span{
  /* background-color: white;
  color: blue; */
}

.footer-col-3 ul{
	/* margin:auto;
	display:block;
	list-style-type:none; */
	}

.footer-col-3 ul li{
	
	/* list-style-type:none;
	float: left;
	margin-right:15px; */
	}

</style>


<footer id="footer" class="footer-wrapper">
  <!-- FOOTER 1 -->
  <!--
  <div class="footer-widgets footer footer-1">
    <div class="row large-columns-1 mb-0">
      <div id="block_widget-5" class="col pb-0 widget block_widget">
        <div class="row"  id="row-654246227">
          <div class="col medium-3 small-12 large-3"  >
            <div class="col-inner"  >
              <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_161135953">
                <div class="img-inner image-cover dark" style="padding-top:69%;">
                  <img width="435" height="279" src="wp-content/uploads/2017/12/smart-brain-1.png" class="attachment-large size-large" alt="" srcset="http://smartbrain.edu.vn/wp-content/uploads/2017/12/smart-brain-1.png 435w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/smart-brain-1-24x15.png 24w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/smart-brain-1-36x23.png 36w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/smart-brain-1-48x31.png 48w" sizes="(max-width: 435px) 100vw, 435px" />
                </div>
                <style scope="scope">
                  #image_161135953 {
                  width: 100%;
                  }
                </style>
              </div>
            </div>
          </div>
          <div class="col medium-3 small-12 large-3"  >
            <div class="col-inner"  >
              <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_1453697119">
                <div class="img-inner image-cover dark" style="padding-top:69%;">
                  <img width="1020" height="680" src="wp-content/uploads/2017/12/CVB-1200x800.jpg" class="attachment-large size-large" alt="" srcset="http://smartbrain.edu.vn/wp-content/uploads/2017/12/CVB-1200x800.jpg 1200w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/CVB-600x400.jpg 600w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/CVB-768x512.jpg 768w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/CVB-24x16.jpg 24w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/CVB-36x24.jpg 36w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/CVB-48x32.jpg 48w" sizes="(max-width: 1020px) 100vw, 1020px" />
                </div>
                <style scope="scope">
                  #image_1453697119 {
                  width: 100%;
                  }
                </style>
              </div>
            </div>
          </div>
          <div class="col medium-3 small-12 large-3"  >
            <div class="col-inner"  >
              <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_1180564266">
                <div class="img-inner image-cover dark" style="padding-top:69%;">
                  <img width="960" height="720" src="wp-content/uploads/2017/12/z697301604014_8f107ea7a363c905427b13134d1a0e79.jpg" class="attachment-large size-large" alt="" srcset="http://smartbrain.edu.vn/wp-content/uploads/2017/12/z697301604014_8f107ea7a363c905427b13134d1a0e79.jpg 960w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/z697301604014_8f107ea7a363c905427b13134d1a0e79-533x400.jpg 533w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/z697301604014_8f107ea7a363c905427b13134d1a0e79-768x576.jpg 768w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/z697301604014_8f107ea7a363c905427b13134d1a0e79-24x18.jpg 24w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/z697301604014_8f107ea7a363c905427b13134d1a0e79-36x27.jpg 36w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/z697301604014_8f107ea7a363c905427b13134d1a0e79-48x36.jpg 48w" sizes="(max-width: 960px) 100vw, 960px" />
                </div>
                <style scope="scope">
                  #image_1180564266 {
                  width: 100%;
                  }
                </style>
              </div>
            </div>
          </div>
          <div class="col medium-3 small-12 large-3"  >
            <div class="col-inner"  >
              <div class="img has-hover x md-x lg-x y md-y lg-y" id="image_710654595">
                <div class="img-inner image-cover dark" style="padding-top:69%;">
                  <img width="1020" height="574" src="wp-content/uploads/2017/12/20161023_080011-1400x788.jpg" class="attachment-large size-large" alt="" srcset="http://smartbrain.edu.vn/wp-content/uploads/2017/12/20161023_080011-1400x788.jpg 1400w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/20161023_080011-711x400.jpg 711w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/20161023_080011-768x432.jpg 768w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/20161023_080011-24x14.jpg 24w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/20161023_080011-36x20.jpg 36w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/20161023_080011-48x27.jpg 48w" sizes="(max-width: 1020px) 100vw, 1020px" />
                </div>
                <style scope="scope">
                  #image_710654595 {
                  width: 100%;
                  }
                </style>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  -->
  <!-- footer 1 -->
  <!-- FOOTER 2 -->
  <?php  while ($dong=mysqli_fetch_array($run)){ ?>
  <div class="footer-footer">
    <div class="row dark large-columns-1 mb-0">
      <div class="footer-unline row">
        <div class="col-md-4 footer-1">
          <!-- <p align="center" style=" color:#fff"><strong>CÔNG TY TNHH DỊCH VỤ GIÁO DỤC VÀ ĐÀO TẠO TOÁN TƯ DUY</strong></p>
          <p align="center"><strong style=" color:#fff">TRUNG TÂM ĐÀO TẠO KỸ NĂNG TOÁN TƯ DUY </strong></p>
          <p align="center" style=" color:#fff">Trụ sở: 21A2/280, Tổ 20, KP3A, Phường Long Bình Tân, Biên Hòa, Đồng Nai.</p>
          <p align="center" style=" color:#fff"><strong style=" color:#fff">ĐT:  0913.978.263  (Quản lý)  </strong>Thương hiệu; Bản quyền <em><strong>0914.147822.       </strong></em><strong>Email:  <a href="https://default.edu.vn/cdn-cgi/l/email-protection#75011a141b010011000c111b351218141c195b161a18">toantuduydn@gmail.com</a>  &#8211; <a href="tin-tuc/-toan-tu-duy-moi-hop-tac.html">Website: smartbrain.edu.vn</a></strong></p>
          <p align="center"><em><strong style=" color:#fff">Copyright © 2016  smartbrain.edu.vn/ All rights reserved / đang trong quá trình xây dựng.</strong></em></p> -->
         
          
          <div class="footer-col-1">
            <?php echo $dong['cot1']; ?>
             
          </div>
        </div>
        
        <div class="col-md-4 col-12 footer-2">
        <?php echo $dong['cot2'];?>
          
        </div>
        
        <div class="col-md-4 col-12 footer-3 ">
          <?php echo $dong['cot3'];?>
          <form action="#" method="post">
          <!-- show input-->
          <div class="col-sm-7" style="padding:0" >
            <input class="form-control" type="text" size="3" >
            </div>
            <div class="col-sm-5" style="text-align:center;"> 
            <input style=" background-color:#00C;" type="button" value="Đăng kí" >
            </div>   
        </div>
          <?php  } ?>

      </div>
    </div>
    <!-- end row -->
  </div>
  <!-- end footer 2 -->
  <div class="absolute-footer dark medium-text-center text-center">
    <div class="container clearfix">
      <div class="footer-primary pull-left">
        <div class="copyright-footer">
          <span style=" color: #fff">Thiết kế website bởi Pion.vn</span>
        </div>
      </div>
      <!-- .left -->
    </div>
    <!-- .container -->
  </div>
  <!-- .absolute-footer -->
  <a href="#top" class="back-to-top button invert plain is-outline hide-for-medium icon circle fixed bottom z-1" id="top-link"><i class="icon-angle-up" ></i></a>
</footer>
<!-- .footer-wrapper -->
</div>
<!-- #wrapper -->
<!-- Mobile Sidebar -->
<div id="main-menu" class="mobile-sidebar no-scrollbar mfp-hide">
<div class="sidebar-menu no-scrollbar ">
  <ul id="h-menu-phone" class="nav nav-sidebar  nav-vertical nav-uppercase">
    <li class="header-search-form search-form html relative has-icon">
      <div class="header-search-form-wrapper">
        <div class="searchform-wrapper ux-search-box relative form- is-normal">
          <form method="get" class="searchform" action="/index.php" role="search">
            <div class="flex-row relative">
              <div class="flex-col flex-grow">
                <input type="search" class="search-field mb-0" name="s" value="" placeholder="Tìm kiếm&hellip;" />
                <input type="hidden" name="post_type" value="product" />
              </div>
              <!-- .flex-col -->
              <div class="flex-col">
                <button type="submit" class="ux-search-submit submit-button secondary button icon mb-0">
                <i class="icon-search" ></i>				</button>
              </div>
              <!-- .flex-col -->
            </div>
            <!-- .flex-row -->
            <div class="live-search-results text-left z-top"></div>
          </form>
        </div>
      </div>
    </li>
    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-291 current_page_item menu-item-298"><a href="/" class="menu-image-title-after menu-image-not-hovered"><img width="24" height="24" src="wp-content/uploads/2017/12/fa-home-24x24.png" class="menu-image menu-image-title-after" alt="" srcset="http://smartbrain.edu.vn/wp-content/uploads/2017/12/fa-home-24x24.png 24w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/fa-home-280x280.png 280w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/fa-home.png 400w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/fa-home-120x120.png 120w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/fa-home-240x240.png 240w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/fa-home-36x36.png 36w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/fa-home-48x48.png 48w" sizes="(max-width: 24px) 100vw, 24px" /><span class="menu-image-title">TRANG CHỦ</span></a></li>
    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-310"><a href="/?view=static" class="menu-image-title-after menu-image-not-hovered"><img width="24" height="24" src="wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-24x24.png" class="menu-image menu-image-title-after" alt="" srcset="http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-24x24.png 24w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-280x280.png 280w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-400x400.png 400w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-768x768.png 768w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-800x800.png 800w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-120x120.png 120w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-240x240.png 240w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-700x700.png 700w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-36x36.png 36w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart-48x48.png 48w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Copyright-Symbol-R-PNG-Clipart.png 1600w" sizes="(max-width: 24px) 100vw, 24px" /><span class="menu-image-title">TOÁN TƯ DUY – TOÁN TRÍ TUỆ SMART BRAIN (VN)</span></a></li>
    <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-311">
      <a href="/?view=news" class="menu-image-title-after menu-image-not-hovered"><img width="24" height="24" src="wp-content/uploads/2017/12/Newspaper-24x24.png" class="menu-image menu-image-title-after" alt="" srcset="http://smartbrain.edu.vn/wp-content/uploads/2017/12/Newspaper-24x24.png 24w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Newspaper-280x280.png 280w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Newspaper-400x400.png 400w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Newspaper-120x120.png 120w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Newspaper-240x240.png 240w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Newspaper-36x36.png 36w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Newspaper-48x48.png 48w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Newspaper.png 512w" sizes="(max-width: 24px) 100vw, 24px" /><span class="menu-image-title">TIN TỨC</span></a>
      <ul class=children>
        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-476"><a href="category/video/index.html" class="menu-image-title-after menu-image-not-hovered"><img width="24" height="24" src="wp-content/uploads/2017/12/video-24x24.png" class="menu-image menu-image-title-after" alt="" srcset="http://smartbrain.edu.vn/wp-content/uploads/2017/12/video-24x24.png 24w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/video-280x280.png 280w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/video-400x400.png 400w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/video-120x120.png 120w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/video-240x240.png 240w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/video-36x36.png 36w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/video-48x48.png 48w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/video.png 512w" sizes="(max-width: 24px) 100vw, 24px" /><span class="menu-image-title">VIDEO</span></a></li>
      </ul>
    </li>
    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-315"><a href="/?view=contact" class="menu-image-title-after menu-image-not-hovered"><img width="24" height="24" src="wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-24x24.png" class="menu-image menu-image-title-after" alt="" srcset="http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-24x24.png 24w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-280x280.png 280w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-400x400.png 400w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-768x768.png 768w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-800x800.png 800w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-120x120.png 120w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-240x240.png 240w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-700x700.png 700w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-36x36.png 36w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg-48x48.png 48w, http://smartbrain.edu.vn/wp-content/uploads/2017/12/Phone_sign_font_awesome.svg.png 1000w" sizes="(max-width: 24px) 100vw, 24px" /><span class="menu-image-title">LIÊN HỆ</span></a></li>


    <!-- <li class="account-item has-icon menu-item">
      <a href="my-account/index.html"
        class="nav-top-link nav-top-not-logged-in" data-open="#login-form-popup">
      <span class="header-account-title">
      Đăng nhập  </span>
      </a> 
    </li> -->
<!-- <a class="button wltspab_custom_login_link nav-top-link nav-top-not-logged-in" href="" data-open="#login-form-popup">ĐĂNG NHẬP ĐỂ MUA KHÓA HỌC</a> -->

    <?php
    if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
      echo '
                    <li class="account-item has-icon">
                      <a href="?view=login" id="mobileLogIn">
                        <span>Đăng nhập</span>
                      </a>
                    </li>
                    <li class="account-item has-icon">
                      <a href="?view=register" id="mobileLogIn">
                        <span>Đăng ký  </span>
                      </a>
                    </li>
                  ';
    } else {
      $user = unserialize($_SESSION['data'])['end_user_email'];
      $user = explode('@', $user)[0];
      echo '
                  <li style="border-bottom: 1px solid #ececec">
                    <span style="max-width: 150px; margin-top:10px; margin-bottom: 10px; overflow: hidden; text-overflow: ellipsis;white-space: nowrap;color: green;"><a href="/index.php?view=account&action=info" style="margin-left:29px; ">Chào mừng, ' . $user . '</a></span>
                  </li>';
    }
    ?>
  </ul>
</div>
<!-- inner -->
</div>
<!-- #mobile-menu -->
<div id="login-form-popup" class="lightbox-content mfp-hide">
<div class="my-account-header page-title normal-title">
  <div class="page-title-inner flex-row  container">
    <div class="flex-col flex-grow medium-text-center">
      <div class="text-center social-login">
        <a href="wp-logina52d.html?loginFacebook=1&amp;redirect=http://smartbrain.edu.vn/"
          class="button social-button large facebook circle"
          onclick="window.location = 'wp-login1379.html?loginFacebook=1&amp;redirect='+window.location.href return false"><i class="icon-facebook"></i>
        <span>Login with <strong>Facebook</strong></span></a>
        <a class="button social-button large google-plus circle"
          href="https://accounts.google.com/o/oauth2/auth?response_type=code&amp;redirect_uri=http%3A%2F%2Fsmartbrain.edu.vn%2Fwp-login.php%3FloginGoogle%3D1&amp;client_id=&amp;scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&amp;access_type=offline&amp;approval_prompt=auto"
          onclick="window.location = 'https://accounts.google.com/o/oauth2/auth?response_type=code&amp;redirect_uri=http%3A%2F%2Fsmartbrain.edu.vn%2Fwp-login.php%3FloginGoogle%3D1&amp;client_id=&amp;scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&amp;access_type=offline&amp;approval_prompt=auto'+window.location.href return false">
        <i class="icon-google-plus"></i>
        <span>Login with <strong>Google</strong></span></a>
      </div>
    </div>
    <!-- .flex-left -->
  </div>
  <!-- flex-row -->
</div>
<!-- .page-title -->
<div class="account-container lightbox-inner">
  <div class="col2-set row row-divided row-large" id="customer_login">
    <?php
    include TPL_DIR . '_login.tpl.php';
    include TPL_DIR . '_register.tpl.php';
    ?>


    <!-- .large-6 -->
  </div>
  <!-- .row -->
</div>
<!-- .account-login-container -->
</div>
<script type='text/javascript' src='js/scripts.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wc_add_to_cart_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"http:\/\/smartbrain.edu.vn\/?wc-ajax=%%endpoint%%","i18n_view_cart":"Xem gi\u1ecf h\u00e0ng","cart_url":"http:\/\/smartbrain.edu.vn\/cart\/","is_cart":"","cart_redirect_after_add":"no"};
/* ]]> */
</script>
<script type='text/javascript' src='js/add-to-cart.js'></script>
<script type='text/javascript' src='js/blockUI.js'></script>
<script type='text/javascript' src='js/cookie.min.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var woocommerce_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"http:\/\/smartbrain.edu.vn\/?wc-ajax=%%endpoint%%"};
/* ]]> */
</script>
<script type='text/javascript' src='js/woocommerce.min2072.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wc_cart_fragments_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"http:\/\/smartbrain.edu.vn\/?wc-ajax=%%endpoint%%","fragment_name":"wc_fragments_3dcee8efe02eb415774ebebf429e6119"};
/* ]]> */
</script>
<script type='text/javascript' src='js/cart-fragments.min2072.js'></script>
<script type='text/javascript' src='js/selectBOX.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var yith_wcwl_l10n = {"ajax_url":"\/wp-admin\/admin-ajax.php","redirect_to_cart":"no","multi_wishlist":"","hide_add_button":"1","is_user_logged_in":"","ajax_loader_url":"http:\/\/smartbrain.edu.vn\/wp-content\/plugins\/yith-woocommerce-wishlist\/assets\/images\/ajax-loader.gif","remove_from_wishlist_after_add_to_cart":"yes","labels":{"cookie_disabled":"We are sorry, but this feature is available only if cookies are enabled on your browser.","added_to_cart_message":"<div class=\"woocommerce-message\">Product correctly added to cart<\/div>"},"actions":{"add_to_wishlist_action":"add_to_wishlist","remove_from_wishlist_action":"remove_from_wishlist","move_to_another_wishlist_action":"move_to_another_wishlsit","reload_wishlist_and_adding_elem_action":"reload_wishlist_and_adding_elem"}};
/* ]]> */
</script>
<script type='text/javascript' src='js/jquery.yith.js'></script>
<script type='text/javascript' src='js/flatsome-live-search.js'></script>
<script type='text/javascript' src='js/hoverIntent.min.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var flatsomeVars = {"ajaxurl":"http:\/\/smartbrain.edu.vn\/wp-admin\/admin-ajax.php","rtl":"","sticky_height":"70"};
/* ]]> */
</script>
<script type='text/javascript' src='js/flatsome.js'></script>
<script type='text/javascript' src='js/woocommerce.js'></script>
<script type='text/javascript' src='js/wp-embed.js'></script>
<script type='text/javascript' src='js/underscore.js'></script>

<!-- Modal -->
<div id="login2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
  function load_ajax_district(select=null)
  {
      cityValue = $("#reg_city_s").val();
            $.ajax({
                url:'default/includes/get-district.inc.php',
                data:{'cityValue': cityValue,
                  select:select
                },
                dataType:'TEXT',
                method: 'POST',
                success: function(result){
                    $('select#reg_district_s').html(result);
                }
            });
  };

  function updateThanhTien(){
    tongThanhTien = 0;

      $('span[name=price]').each(function(indexPrice){
            tongThanhTien += $('span[name=price]').eq(indexPrice).text() * $('input[name=quantity]').eq(indexPrice).val();
      });
      $('span#thanhTien').text(tongThanhTien);
  };


  function load_ajax_ward(select=null)
  {
    var cityValue;
      if($("#reg_district_s").val())cityValue=$("#reg_district_s").val()
      else cityValue=<?php echo (isset($userInformation["end_user_district"]) ? ("'" . $userInformation["end_user_district"] . "'") : "''"); ?>;
            $.ajax({
                url:'default/includes/get-ward.inc.php',
                data:{'cityValue': cityValue,select:select},
                dataType:'TEXT',
                method: 'POST',
                success: function(result){
                    $('select#reg_ward_s').html(result);
                }
            });
  };

  $(document).ready(function(){
    updateThanhTien();
  })



    $(document).ready(function() {
        $('select#reg_city').change(function(){
            cityValue = $(this).val();
            $.ajax({
                url:'default/includes/get-district.inc.php',
                data:{'cityValue': cityValue},
                dataType:'TEXT',
                method: 'POST',
                success: function(result){
                    $('select#reg_district').html(result);
                }
            });

        });
    });
    $(document).ready(function() {
        $('select#reg_district').change(function(){
            cityValue = $(this).val();
            $.ajax({
                url:'default/includes/get-ward.inc.php',
                data:{'cityValue': cityValue},
                dataType:'TEXT',
                method: 'POST',
                success: function(result){
                    $('select#reg_ward').html(result);
                }
            });

        });
    });
    $(document).ready(function(){
      $('a#addToCart').click( function(){
        productID = $(this).attr('name');
        $.ajax({
          url: 'default/includes/add-to-cart.inc.php',
          type: 'POST',
          data: {productID},
          dataType: 'JSON',
          success: function(response){
            if (response['status'] == 'success'){
              alert(response['message']);
            } else {
              alert(response['message']);
            };
          }
        });
      });
    });

    $(document).ready(function(){
      $('input[name=quantity]').change(function() {
        updateThanhTien();
      });
    })

    $(document).ready(function(){
      $('a#confirmOrder').click(function(){

        var donHang = [];

/*
        $('span[name=price]').each(function(indexPrice){
            var arrayTrungGian = {};
            var productID = $('input[name=removedProduct]').eq(indexPrice).val();
            var donGia = $(this).text();
            var soLuong = $('input[name=quantity]').eq(indexPrice).val();

            arrayTrungGian['productID'] = productID;
            arrayTrungGian['soLuong'] = soLuong;
            if(parseInt(arrayTrungGian['soLuong'])>0)
            donHang[indexPrice] = arrayTrungGian;
      });
      */
     var number=$("#number").val();
     index=0;
     for(var i=1;i<=number;i++)
     {
       if($("#quantity"+i).length)
       {
         if(parseInt($("#quantity"+i).val())>0)
         {
          var arrayTrungGian = {};
            arrayTrungGian['productID'] = $("#productid"+i).val();
            arrayTrungGian['soLuong'] = $("#quantity"+i).val();
            donHang[index] = arrayTrungGian;
            index++;
         }
       }
     }
        if ( $('input[name=paymentTerms]').is(':checked')){
          var dieuKhoanMuaHang = true;
        } else {
          var dieuKhoanMuaHang = false;
        };

        //console.log(donHang);

        $.ajax({
          url: '/default/includes/buy.inc.php',
          type: 'POST',
          dataType: 'JSON',
          data: {'paymentTerms': dieuKhoanMuaHang, 'donHang': donHang },

          success:function(result){
            alert(result['message']);
            window.location.replace('/index.php?view=account&action=info');
          }
        });
      })
    })





</script>
</body>
<!-- Mirrored from smartbrain.edu.vn/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Mar 2018 22:06:47 GMT -->
</html>
