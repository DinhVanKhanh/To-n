<?php
include_once('../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if ($user->isOnline()) {
    if ($user->CheckAdmin())
        $rt->AdminPage(true);
    else if ($user->CheckBranch())
        $rt->BranchPage(true);
    else if ($user->CheckDistrict())
        $rt->DistrictPage(true);
    else if ($user->CheckFree())
        $rt->FreePage(true);
} else {
    if ($rt->GetPost('submit')) {
        if ($user->Login()) {

            if ($user->CheckAdmin())
                $rt->AdminPage(true);
            else if ($user->CheckBranch())
                $rt->BranchPage(true);
            else if ($user->CheckDistrict()){
                $rt->DistrictPage(true);
            }
            else if ($user->CheckFree())
                $rt->FreePage(true);
        } else {
            echo "Tài khoản hoặc mật khẩu không đúng";
            die();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="font-end/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="font-end/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="font-end/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-end/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng nhập</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="POST" >
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Tài khoản" name="user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Đăng Nhập" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="font-end/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="font-end/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="font-end/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="font-end/dist/js/sb-admin-2.js"></script>

</body>

</html>
