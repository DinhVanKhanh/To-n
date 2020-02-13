<?php include TPL_DIR . '/_head.tpl.php'?>
<?php include(INC_DIR . 'video-of-user.inc.php'); ?>
<body class="home page-template-default page page-id-291 header-shadow lightbox nav-dropdown-has-arrow">
  <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
  <div id="wrapper">
  <?php include TPL_DIR . '/_header-main.tpl.php' ?>
  <main id="main" class="">
    <!-- .page-title -->
    <div class="page-wrapper my-account mb">
      <div class="container" role="main">
        <div class="row vertical-tabs">
          <div class="large-9 col">
            <div id="my-account-menu" class="col large-3">
              <div class="user-profile">
                <div class="user-image">
                  <img alt="" src="/images/avatar.jpg">
                </div>
                <div class="user-info">
                  <p class="username">hieu.nhon.11 </p>
									</span><a href="/logout.php?r=index.php">Đăng xuất</a>
                </div>
              </div>
              <ul class="myaccount-menu">
                <li class="active">
                  <a class="edit-account" href="/index.php?view=account&action=info" title="Thông tin tài khoản">
                  <span>Thông tin tài khoản</span>
                  </a>
                </li>
                <li class="">
                  <a class="khoa-hoc-cua-ban-1" href="/index.php?view=account&action=course" title="KHÓA HỌC CỦA BẠN">
                  <span>KHÓA HỌC CỦA BẠN</span>
                  </a>
                </li>
              </ul>
            </div>
            <div id="my-account-content" class="col large-6">
              <div class="woocommerce">
                <div class="woocommerce-MyAccount-content">
                  <?php echo $html; ?>
                </div>
              </div>
            </div>
          </div>
          <!-- .large-9 -->
        </div>
        <!-- .row .vertical-tabs -->
      </div>
      <!-- .container -->
    </div>
    <!-- .page-wrapper.my-account  -->
  </main>
  <!-- #main -->
  <?php include TPL_DIR . '/_footer.tpl.php'; ?>
