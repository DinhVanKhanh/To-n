<?php
if(!(isset($_SESSION['logged'])&&$_SESSION['logged']==true))
  header("Location: index.php");
?>
<?php include TPL_DIR . '/_head.tpl.php'?>
<body class="home page-template-default page page-id-291 header-shadow lightbox nav-dropdown-has-arrow">
  <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
  <div id="wrapper">
  <?php include TPL_DIR . '/_header-main.tpl.php' ?>
  <main id="main" class="">
    <!-- .page-title -->
    <div class="page-wrapper my-account mb">
      <div class="container" role="main">
        <div class="row vertical-tabs">
          <div class="large-9 col" style="min-width: 480px">
            <div id="my-account-menu" class="col large-3">
              <div class="user-profile">
                <div class="user-image">
<!--                    --><?php
//                        $user = unserialize($_SESSION['data']);
//                        if (is_null($user['end_user_avatar'])){
//                            echo '<img alt="" src="/images/avatar.jpg">';
//                        } else {
//                            echo '<img alt="" src="'. $user['end_user_avatar']. '">';
//                        };
//                    ?>
                </div>
                <div class="user-info">
                  <p class="username"><?php
                      $user = unserialize($_SESSION['data'])['end_user_fullname'];
                      echo $user;
                      ?>
                  </p>
                    <form method="POST" action="default/includes/profile-picture.php" enctype="multipart/form-data">
                    <?php

                    $email = unserialize($_SESSION['data'])['end_user_email'];

                    $database = new Database(HOST, USER, PASS, DBNAME);
                    $conn = $database -> get_connection();

                    $sql = "SELECT * FROM end_users WHERE end_user_email = :email;";
                    $query = $conn -> prepare($sql);
                    $query -> execute(array(
                      ':email' => $email
                    ));
                    $user = $query -> fetch(PDO::FETCH_ASSOC);
                    
                                            if (is_null($user['end_user_avatar'])){
                                               echo '<img id="img_show" alt="" class="img-responsive" src="/images/avatar.jpg">';
                                            } else {
                                                echo '<img id="img_show"  alt="" class="img-responsive" src="uploads/images/'. $user['end_user_avatar']. '">';
                                            };
                    ?>
                    </form>
                    </span><a href="/logout.php?r=index.php">Đăng xuất</a>
                </div>
              </div>
              <ul class="myaccount-menu">
				<?php include INC_DIR . '/account-sidebar.inc.php'; ?>
              </ul>
            </div>
            <div id="my-account-content" class="col large-9">
              <div class="woocommerce">
                <?php include INC_DIR . '/account.inc.php'; ?>
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
  <script>
        function upload_img() {
            //Lấy ra files
            var file_data = $('#file').prop('files')[0];
            //lấy ra kiểu file
            var type = file_data.type;
            //Xét kiểu file được upload
            var match = ["image/png", "image/jpg", "image/jpeg"];
            //kiểm tra kiểu file
            if (type == match[0] || type == match[1] || type == match[2]) {
                //khởi tạo đối tượng form data
                var form_data = new FormData();
                //thêm files vào trong form data
                form_data.append('file', file_data);
                //sử dụng ajax post
                $.ajax({
                    url: 'apps/uploadimg.php', // gửi đến file upload.php 
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (res) {
                        $('#img').val(res);
                        if (res != "") {
                            $("#img_show").attr("src", "apps/rec/" + res);
                            $("#img_show").css("display", "block");
                        }
                        //$('#resultfile').html(res);
                    }
                });
            } else {
                $('#file').val('');
                alert("Không hỗ trợ loại ảnh này");
            }
            return false;
        }</script>
