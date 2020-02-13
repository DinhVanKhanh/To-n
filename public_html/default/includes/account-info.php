<?php
include_once("apps/libs/Dbconn.php");
$database = new Database(HOST, USER, PASS, DBNAME);
$conn = $database->get_connection();
$sql = 'SELECT * FROM end_users WHERE end_user_email = :userEmail;';
$query = $conn->prepare($sql);
$query->execute(array(
    'userEmail' => unserialize($_SESSION['data'])['end_user_email']
));

$userInformation = $query->fetch(PDO::FETCH_ASSOC);

$file = file_get_contents('hanh-chinh/dist/tinh_tp.json');
$json = json_decode($file, true);


$db = new apps_libs_Dbconn();
$param = [
    "from" => "devvn_tinhthanhpho",
    "select" => "*"
];
$result = $db->Select($param);

$city = '
                    <select onchange=\'load_ajax_district()\' id="reg_city_s" name="city" style="max-width:200px;"><option>Chọn tỉnh/thành phố</option>
                ';
while ($row = mysqli_fetch_assoc($result)) {
    $select = "";
    if ($row["matp"] == $userInformation["end_user_city"]) $select = "selected";
    $city .= '<option ' . $select . ' class="city" id="' . $row["matp"] . '" value="' . $row["matp"] . '">' . $row["name"] . '</option>';
};
$city .= '</select> ';


$html = '
        <div class="row">
        <div class="col-xs-12 xol-sm-12 com-md-12">
	        <form action="/default/includes/edit-account.php" method="POST">
		<fieldset>
            <legend>Thông tin</legend>
                <p>
                    <label for="account_fullname">Cập nhập ảnh đại diện</label>
                    <input onchange="upload_img()" type="file" id="file" />

                      <input type="hidden" value="" id="img" name="img" />
                      </p>
                <p>
                    <label for="account_fullname">Họ Tên</label>
                    <p id="account_fullname">' . $userInformation['end_user_fullname'] . '</p>
                </p>
                <div class="clear"></div>
                
                    <label for="account_email">Địa chỉ email</label>
                    <p id="account_email">' . $userInformation['end_user_email'] . '</p>
                
                <div class="clear"></div>
                    <p>
                        <label for="account_phone">Số điện thoại</label>
                        <input type="text" name="phone" id="account_phone" value="' . $userInformation['end_user_phone_number'] . '" style="max-width:120px;">
                    </p>   
                    
                <div class="clear"></div>
                    <p>
                        <label for="account_city">Tỉnh/Thành phố</label>
                       ' . $city . '
                    </p>    
                 <div class="clear"></div>
                    <p>
                        <label for="account_district">Quận/Huyện</label>
                            <select onchange=\'load_ajax_ward()\' id="reg_district_s" name="district" style="max-width:200px;">

                            </select>
                    </p>     
                <div class="clear"></div>
                    <p>
                        <label for="account_ward">Phường/Xã</label>
                        <select id="reg_ward_s" name="ward" style="max-width:200px;">

                            </select>
                    </p>    
                    <script>$(document).ready(function(){load_ajax_district(\''.$userInformation["end_user_district"].'\');load_ajax_ward(\''.$userInformation["end_user_ward"].'\')})</script>
                <div class="clear"></div>
                <p>
                    <label for="account_address">Địa chỉ nhà</label>
                    <input type="text" name="address" id="account_address" value="' . $userInformation['end_user_address'] . '" style="max-width:200px;">
                </p>

        </fieldset>
            <div class="clear"></div>
                <input type="hidden" name="userEmail" value="' . $userInformation['end_user_email'] . '">	
                <input type="submit" name="editAccount" value="Lưu thay đổi">
                <a class="button" href="index.php?view=account&action=change-password">Thay đổi mật khẩu</a>
        </form>
        </div>
    </div>
    ';
echo $html;
