<?php
  require('../../autoload.php');

	/*Session_start
	===========================================*/
	$security = new Security();
	$security -> sec_session_start();

  if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $input_password = $_POST['password'];

    $database = new Database(HOST, USER, PASS, DBNAME);
    $conn = $database -> get_connection();

    $sql = "SELECT * FROM end_users WHERE end_user_email = :email;";
    $query = $conn -> prepare($sql);
    $query -> execute(array(
      ':email' => $email
    ));
    $data = $query -> fetch(PDO::FETCH_ASSOC);
    $real_password = $data['end_user_password'];

    if($real_password == $input_password) {

      if( $data['end_user_lock'] == 1 ){
        //Login success
      $_SESSION['logged'] = true;
      $_SESSION['data'] = serialize($data);

      if (isset($_POST['redirection'])){
        if ($_POST['redirection'] == '/index.php'){
          $redirection = '/index.php?view=account&action=info';
        } 
        else if($_POST['redirection']=='/?view=login'||$_POST['redirection']=='/index.php?view=login')
        {
          $redirection = '/index.php?view=account&action=info';
        }
        else {
          $redirection = $_POST['redirection'];
        };
      };

      header( "Location: " . $redirection );
    } else {
      echo 'Tài khoản của bạn đang bị khóa.';
      $redirection = isset($_POST['redirection']) ? $_POST['redirection'] : '/';
      header("Refresh: 1; url=" . $redirection);

    };
      
    } else {
      echo 'Sai thong tin dang nhap';
			$redirection = isset($_POST['redirection']) ? $_POST['redirection'] : '/';
			header("Refresh: 1; url=" . $redirection);
    };
  }
?>
