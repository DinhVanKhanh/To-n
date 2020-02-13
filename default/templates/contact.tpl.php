<?php include TPL_DIR . '/_head.tpl.php';
      include('apps/bootstrap.php');
    $a = new apps_libs_Dbconn();
    $sql = "select * from lienhe";
    $run = $a->Querry($sql);
    $dong = mysqli_fetch_assoc($run);

 ?>
<body class="page-template-default page page-id-305 header-shadow lightbox nav-dropdown-has-arrow">
  <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
  <div id="wrapper">
  <?php include TPL_DIR . '/_header-main.tpl.php'; ?>
  <main id="main" class="">
    <div id="content" class="content-area page-wrapper" role="main">
      <div class="row row-main">
        <div class="large-12 col">
          <div class="col-inner">
            <div id="page-header-1106451220" class="page-header-wrapper">
              <div class="page-title dark featured-title">
                <div class="page-title-bg">
                  <div class="title-bg fill bg-fill"
                    data-parallax-container=".page-title"
                    data-parallax-background
                    data-parallax="-">
                  </div>
                  <div class="title-overlay fill"></div>
                </div>
                <div class="page-title-inner container align-center text-center flex-row-col medium-flex-wrap" >
                  <div class="title-content flex-col">
                    <div class="title-breadcrumbs pb-half pt-half">
                      <nav class="woocommerce-breadcrumb breadcrumbs"><a href="/?view=home">Trang chủ</a> <span class="divider">&#47;</span> LIÊN HỆ</nav>
                    </div>
                  </div>
                </div>
                <!-- flex-row -->
                <style scope="scope">
                  #page-header-1106451220 .title-bg {
                  background-image: url(images/caption-about.jpg);
                  }
                </style>
              </div>
              <!-- .page-title -->
            </div>
            <!-- .page-header-wrapper -->
            <div class="gap-element" style="display:block; height:auto; padding-top:30px" class="clearfix"></div>
            <div class="row row-small" style="max-width:1140px" id="row-986162404">
              <div class="col medium-8 small-12 large-8"  >
                <?= htmlspecialchars_decode($dong['noidung']);?>
              </div>

              <div class="col medium-4 small-12 large-4"  >
                <div class="col-inner"  >
                  <div class="container section-title-container" >
                    <h3 class="section-title section-title-normal"><b></b><span class="section-title-main" style="font-size:85%;color:rgb(210, 11, 11);">Liên Hệ Với Chúng Tôi</span><b></b></h3>
                  </div>
                  <!-- .section-title -->
                  <div role="form" class="wpcf7" id="wpcf7-f10-p305-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response"></div>
                    <form action="default/includes/contact.inc.php" method="post" class="wpcf7-form" novalidate="novalidate">
                      <span class="wpcf7-form-control-wrap text-816"><input type="text" name="fullname" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Nhập họ và tên" /></span><br />
                      <span class="wpcf7-form-control-wrap text-816"><input type="text" name="address" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Nhập địa chỉ" /></span><br />
                      <span class="wpcf7-form-control-wrap tel-203"><input type="tel" name="telephone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Nhập số điện thoại" /></span><br />
                      <span class="wpcf7-form-control-wrap email-690"><input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Nhập email" /></span><br />
                      <span class="wpcf7-form-control-wrap text-816"><input type="text" name="subject" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Nhập tiêu đề" /></span><br />
                      <span class="wpcf7-form-control-wrap textarea-909"><textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Nhập nội dung liên hệ"></textarea></span><br />
                      <input type="submit" value="Gửi" class="wpcf7-form-control wpcf7-submit" />
                      <div class="wpcf7-response-output"><?php isset($_SESSION['error']) ? print($_SESSION['error']) : ''; ?></div>
                    </form>
                  </div>
                </div>
              </div>
              <style scope="scope">
              </style>
            </div>
          </div>
          <!-- .col-inner -->
        </div>
        <!-- .large-12 -->
      </div>
      <!-- .row -->
    </div>
  </main>
  <!-- #main -->
  <?php include TPL_DIR . '/_footer.tpl.php'; ?>
