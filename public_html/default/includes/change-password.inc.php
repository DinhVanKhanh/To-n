<?php
    require('../../autoload.php');

    /*Session_start
    ===========================================*/
    $security = new Security();
    $security -> sec_session_start();

    $userEmail = unserialize($_SESSION['data'])['end_user_email'];


    $database = new Database(HOST, USER, PASS, DBNAME);
    $conn = $database -> get_connection();
    $sql = 'SELECT * FROM end_users WHERE end_user_email = :userEmail;';
    $query = $conn -> prepare($sql);
    $query -> execute(array(
        ':userEmail' => $userEmail
    ));

    $user = $query -> fetch(PDO::FETCH_ASSOC);

    if ( isset($_POST['oldPassword']) ){
       if ($_POST['oldPassword'] === $user['end_user_password'] ) {

           if ($_POST['newPassword'] === $_POST['newPasswordConfirmation']){

               $sql1 = 'UPDATE end_users SET end_user_password = :newPassword WHERE end_user_email = :userEmail;';
               $query1 = $conn->prepare($sql1);
               $query1 -> execute([
                   ':newPassword' => $_POST['newPassword'],
                   ':userEmail' => $userEmail
               ]);
               echo 'Đã thay đổi mật khẩu thành công';
               header('Location: /logout.php?r=index.php');
           } else {
               echo 'Mật khẩu mới không khớp nhau. Vui lòng thử lại.';
           };
       } else {
           echo 'Mật khẩu cũ không đúng. Vui lòng thử lại.';
       };
    } else {
        echo 'Vui lòng nhập mật khẩu cũ để đổi mật khẩu';
    }