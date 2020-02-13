<?php
include_once("apps/libs/Dbconn.php");
?>
<div class="col-2 large-6 col pb-0">
  <div class="account-register-inner">
          <h3 class="uppercase">Đăng ký</h3>
      <form id="form-reg-new" method="post" action="default/includes/register.inc.php">
          <p>
              <label for="reg_email">Địa chỉ email <span class="required">*</span></label>
              <input type="email" name="email" id="reg_email" value="" />
              <span class="h-noti" id="noti_reg_email"></span>
          </p>
          <p>
              <label for="reg_fullname">Họ và tên <span class="required">*</span></label>
              <input type="text" name="fullName" id="reg_fullname" />
              <span class="h-noti" id="noti_reg_fullname"></span>
          </p>
          <p>
              <label for="reg_password">Mật khẩu <span class="required">*</span></label>
              <input type="password" name="password" id="reg_password" />
              <span class="h-noti" id="noti_reg_password"></span>
          </p>
          <p>
              <label for="reg_retypePassword">Xác nhận mật khẩu <span class="required">*</span></label>
              <input type="password" name="confirmPassword" id="reg_retypePassword" />
              <span class="h-noti" id="noti_reg_retypePassword"></span>
          </p>
          <p>
              <label for="reg_phone">Số điện thoại <span class="required">*</span></label>
              <input type="text" name="phone" id="reg_phone" />
              <span class="h-noti" id="noti_reg_phone"></span>
            </p>
          <p>
              <label for="reg_city">Tỉnh/thành phố <span class="required">*</span></label>
              <?php
                $db = new apps_libs_Dbconn();
                $param = [
                    "from" => "devvn_tinhthanhpho",
                    "select" => "*"
                ];
                $result = $db->Select($param);

                $html = '
                    <select id="reg_city" name="city"><option value="-1">Chọn tỉnh/thành phố</option>
                ';
                while ($row = mysqli_fetch_assoc($result)) {
                    $html .= '<option class="city" id="' . $row["matp"] . '" value="' . $row["matp"] . '">' . $row["name"] . '</option>';
                };
                $html .= '</select>';
                echo $html;
                ?>
              <span class="h-noti" id="noti_reg_city"></span>
          </p>
          <p>
              <label for="reg_district">Quận/huyện <span class="required">*</span></label>
              <select id="reg_district" name="district">

              </select>
              <span class="h-noti" id="noti_reg_district"></span>
          </p>
          <p>
              <label for="reg_ward">Xã/phường <span class="required">*</span></label>
              
              <select name="ward" id="reg_ward">

              </select>
              <span class="h-noti" id="noti_reg_ward"></span>
          </p>
          <p>
              <label for="reg_address">Địa chỉ <span class="required">*</span></label>
              <input type="text" name="address" id="reg_address" />
          </p>
      <p>
      <?php
      require('autoload.php');
      $database = new Database(HOST, USER, PASS, DBNAME);
      $conn = $database->get_connection();
        $sql = 'SELECT * FROM posts WHERE post_id = :postID;';
        $query = $conn->prepare($sql);
        $query->execute([
            ':postID' => 6
        ]);

        $termContent = $query->fetch(PDO::FETCH_ASSOC);
        ?>
      <span style="border:1px solid #dcdcdc;width:100%">
                      <?php
                        echo $termContent['post_content'];
                        //echo $termContent['post_content'];
                        ?>
                    </span>
      <input type="checkbox" id="paymentTerms" value="termsAccepted">
                      <span>Tôi đã đọc và đồng ý với các điều khoản của Công ty.</span>
                      <span class="h-noti" id="noti_paymentTerms"></span>
        <input type="submit" name="register" value="Đăng ký" />
      </p>
    </form>
    <style>
        .h-noti
        {
            color:red;
            font-size: 10px;
        }
    </style>
    <script>
        $("#form-reg-new").submit(function(){
            $(".h-noti").html("");
            $("input").css("border-color","#ddd");

            var email=$("#reg_email").val();
            var ck_email=/([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!ck_email.test(email))
            {
                $('html, body').animate({
                    scrollTop: $("#reg_email").offset().top
                }, 500);
                $("#reg_email").css("border-color","red");
                $("#noti_reg_email").html("Sai định dạng email");
                return false;
            }

            var reg_fullname=$("#reg_fullname").val();
            if(reg_fullname=="")
            {
                $('html, body').animate({
                    scrollTop: $("#reg_email").offset().top
                }, 500);
                $("#reg_fullname").css("border-color","red");
                $("#noti_reg_fullname").html("Mời nhập tên");
                return false;
            }

            var reg_password=$("#reg_password").val();
            ck_reg_password=/([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/;
            if(!ck_reg_password.test(reg_password))
            {
                $('html, body').animate({
                    scrollTop: $("#reg_password").offset().top
                }, 500);
                $("#reg_password").css("border-color","red");
                $("#noti_reg_password").html("Mật khẩu chưa đủ mạnh (yêu cầu chữ hoa và chữ thường)");
                return false;
            }

            var reg_retypePassword=$("#reg_retypePassword").val();
            if(reg_retypePassword!=reg_password)
            {
                $('html, body').animate({
                    scrollTop: $("#reg_retypePassword").offset().top
                }, 500);
                $("#reg_retypePassword").css("border-color","red");
                $("#noti_reg_retypePassword").html("Mật khẩu chưa trùng khớp");
                return false;
            }
    
            if($("#reg_city").val()==null||$("#reg_city").val()=="-1")
            {
                $('html, body').animate({
                    scrollTop: $("#reg_city").offset().top
                }, 500);
                $("#reg_city").css("border-color","red");
                $("#noti_reg_city").html("Mời chọn tỉnh");
                return false;
            }
            if($("#reg_district").val()==null||$("#reg_district").val()=="-1")
            {
                $('html, body').animate({
                    scrollTop: $("#reg_district").offset().top
                }, 500);
                $("#reg_district").css("border-color","red");
                $("#noti_reg_district").html("Mời chọn huyện");
                return false;
            }
            if($("#reg_ward").val()==null||$("#reg_ward").val()=="-1")
            {
                $('html, body').animate({
                    scrollTop: $("#reg_ward").offset().top
                }, 500);
                $("#reg_ward").css("border-color","red");
                $("#noti_reg_ward").html("Mời chọn xã");
                return false;
            }

            if($("#paymentTerms").prop('checked')==false)
            {
                $('html, body').animate({
                    scrollTop: $("#noti_paymentTerms").offset().top
                }, 500);
                $("#paymentTerms").css("border-color","red");
                $("#noti_paymentTerms").html("Chưa chấp nhận điều khoản");
                return false;
            }
        });
    </script>


  </div>
</div>

