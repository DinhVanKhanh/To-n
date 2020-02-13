<?php
include_once('../apps/bootstrap.php');
$login=new apps_libs_UserLogin();
if($login->isOnline())
    $login->Logout();
$rt=new apps_libs_Router();
$rt->LoginPage(true);
?>