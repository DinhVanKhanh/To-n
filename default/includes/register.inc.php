<?php
  require('../../autoload.php');
  $security = new Security();
$security->sec_session_start();

  if(isset($_POST['email'])) {
    if( $_POST['password'] === $_POST['confirmPassword'] ) {
        $email = $_POST['email'];
        $fullName = $_POST['fullName'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $ward = $_POST['ward'];
        $district = $_POST['district'];
        $city = $_POST['city'];
        $adtudo_id = isset($_SESSION['adtudo_id'])? $_SESSION['adtudo_id']: '';
        $database = new Database(HOST, USER, PASS, DBNAME);
        $conn = $database->get_connection();

        $sql = "INSERT INTO end_users(end_user_email, end_user_password, end_user_fullname, end_user_phone_number, end_user_city, end_user_district, end_user_address, end_user_ward, adtudo_id) 
              VALUES (:email, :password, :fullName, :phone, :city, :district, :address, :ward, :adtudo_id);";
        $query = $conn->prepare($sql);
        $result = $query->execute(array(
            ':email' => $email,
            ':password' => $password,
            ':fullName' => $fullName,
            ':phone' => $phone,
            ':city' => $city,
            ':district' => $district,
            ':ward' => $ward,
            ':address' => $address,
            ':adtudo_id' => $adtudo_id,
        ));

        echo "
        <script>
            alert('Bạn đã đăng kí thành công !');
            window.location='/index.php';
        </script>
        ";
        /*
        $result ? header("Location: ../../") : header("Location: /");

        header("Refresh: 1; url=../../login.php");
        */
    }
  }
?>
