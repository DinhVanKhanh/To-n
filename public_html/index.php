<?php require_once('autoload.php');
	/*Session_start
	===========================================*/
$security = new Security();
$security->sec_session_start();

if (isset($_GET['view'])) {
  switch ($_GET['view']) {
    case 'home':
      include TPL_DIR . '/index.tpl.php';
      break;
    case 'static':
      include TPL_DIR . '/static.tpl.php';
      break;
    case 'register':
      include TPL_DIR . '/_head.tpl.php';
      include TPL_DIR . '/_header-main.tpl.php';
      echo "<div style='display:block;margin:0 auto;' >";
      include TPL_DIR . '/_register.tpl.php';
      echo "</div>";
      include TPL_DIR . '/_footer.tpl.php';
      break;
    case 'news':
      include TPL_DIR . '/news.tpl.php';
      break;
    case 'contact':
      include TPL_DIR . '/contact.tpl.php';
      break;
    case 'account':
      include TPL_DIR . '/account.tpl.php';
      break;
    case 'course':
      include TPL_DIR . '/course.tpl.php';
      break;
    case 'login':
      include TPL_DIR . '/_head.tpl.php';
      include TPL_DIR . '/_header-main.tpl.php';
      echo "<div style='display:block;margin:0 auto;' >";
      include TPL_DIR . '/_login.tpl.php';
      echo "</div>";
      include TPL_DIR . '/_footer.tpl.php';
      break;
    case 'lost-password':
      include TPL_DIR . '/_head.tpl.php';
      include TPL_DIR . '/_header-main.tpl.php';
      echo "<div style='display:block;margin:0 auto;' >";
      include TPL_DIR . '/lost_password.tpl.php';
      echo "</div>";
      include TPL_DIR . '/_footer.tpl.php';
      break;
    case 'video':
      include TPL_DIR . '/video.tpl.php';
      break;
    case 'pay':
      include TPL_DIR . '/pay.tpl.php';
      break;
    case 'newss':
      include TPL_DIR . '/news.php';
      break;
    case 'cate':
      echo 'Dang lam';
      break;
  }
} else {
  include TPL_DIR . '/index.tpl.php';
  
}
?>
