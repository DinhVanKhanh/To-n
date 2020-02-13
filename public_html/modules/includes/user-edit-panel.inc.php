<?php
    include_once("../../apps/libs/Dbconn.php");
    require('../../autoload.php');
    $database = new Database(HOST, USER, PASS, DBNAME);
    $conn = $database->get_connection();
    $sql = 'SELECT * FROM end_users WHERE end_user_id = :userID;';
    $query = $conn->prepare($sql);
    $query->execute(array(
        ':userID' => $_POST['userID']
    ));

    $userInformation = $query->fetch(PDO::FETCH_ASSOC);

    $html = '
<div class="col-2 large-6 col pb-0">
  <div class="account-register-inner">
          <h3 class="uppercase text-center">Thay đổi thông tin thành viên</h3>
      <form method="post" action="/modules/includes/edit-user-information.inc.php">
      <input type="hidden" name="userID" value="'.$_POST['userID'].'">
          <p>
              <label for="reg_email">Địa chỉ email <span class="required">*</span></label>
              <input type="email" name="email" id="reg_email" class="form-control" style="margin-left: 25%; width: 25%" value="'.$userInformation['end_user_email'].'" />
          </p>
          <p>
              <label for="reg_fullname">Họ và tên <span class="required">*</span></label>
              <input type="text" name="fullName" id="reg_fullname" class="form-control" style="margin-left: 25%; width: 25%" value="'.$userInformation['end_user_fullname'].'" />
          </p>
          <p>
              <label for="reg_password">Mật khẩu <span class="required">*</span></label>
              <input type="password" name="password" id="reg_password" class="form-control" style="margin-left: 25%; width: 25%" value="'.$userInformation['end_user_password'].'" />
          </p>
          <p>
              <label for="reg_phone">Số điện thoại <span class="required">*</span></label>
              <input type="text" name="phone" id="reg_phone" class="form-control" style="margin-left: 25%; width: 25%" value="'.$userInformation['end_user_phone_number'].'" />
            </p>
          <p>
              <label for="reg_city">Tỉnh/thành phố <span class="required">*</span></label>';

              $db=new apps_libs_Dbconn();
              $param=[
                  "from"=>"devvn_tinhthanhpho",
                  "select"=>"*"
              ];
              $result=$db->Select($param);
              
              $option = '
                    <select id="reg_city" name="city"><option>Chọn tỉnh/thành phố</option>
                ';
              while($row=mysqli_fetch_assoc($result)){
                  $option .= '<option class="city" id="'.$row["matp"].'" value="'.$row["matp"].'">'. $row["name"] .'</option>';
              };
              $option .= '</select>';

              $html .= $option;


          $html .= '</p>
          <p>
              <label for="reg_district">Quận/huyện <span class="required">*</span></label>
              <select id="reg_district" name="district">

              </select>
          </p>
          <p>
              <label for="reg_ward">Xã/phường <span class="required">*</span></label>
              
              <select name="ward" id="reg_ward">

              </select>
          </p>
          <p>
              <label for="reg_address">Địa chỉ <span class="required">*</span></label>
              <input type="text" name="address" class="form-control" style="margin-left: 25%; width: 25%" id="reg_address" value="'.$userInformation['end_user_address'].'"  />
          </p>
      <p>
        <input type="submit" name="confirmEditUser" class="btn btn-success center-block" value="Sửa thông tin thành viên" />
      </p>
    </form>

  </div>
</div>';

print_r($html);

