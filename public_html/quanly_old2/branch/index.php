<?php 
include('../../apps/bootstrap.php');
$rt = new apps_libs_Router();
$user = new apps_libs_UserLogin();
if (!$user->CheckBranch()) $rt->LoginPage(true);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="../font-end/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../font-end/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../font-end/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../font-end/dist/css/style.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../font-end/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-end/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="../font-end/vendor/jquery/jquery.min.js"></script>
    <script src="../font-end/ckeditor/ckeditor.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin</a>
            </div>
            <!-- /.navbar-header -->
         
            <ul class="nav navbar-top-links navbar-right">       
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="?r=acc&p=changepass"><i class="fa fa-user fa-fw"></i> Tài khoản</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                        </li>
                    </ul>
                </li>
        
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">    
                        <li>
                            <a href="?r=order&p=showlist">Danh sách đơn hàng</a>
                        </li>
                        <li>
                            <a href="?r=order-branch&p=showlist">Đặt hàng</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-child"></i> Tài khoản khu vực<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" >
                                <li>
                                    <a href="?r=acc-child&p=create">Tạo mới</a>
                                </li>
                                <li>
                                    <a href="?r=acc-child&p=showlist">Danh sách</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php
            if ($rt->GetGet('r') && $rt->GetGet('p')) {
                $r = $rt->GetGet('r');
                $p = $rt->GetGet('p');
                include($rt->GetFileInBranch($r, $p));
            } else {
                    //include('total/menufunction/menu.php');  
            }
            ?>
        </div>
        <div style="font-size:10px;float:right;padding:2px">
            Thiết kế website bởi Huu
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="../font-end/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <!-- <script src="../font-end/vendor/metisMenu/metisMenu.min.js"></script> -->

    <!-- Morris Charts JavaScript
    <script src="../font-end/vendor/raphael/raphael.min.js"></script>
    <script src="../font-end/vendor/morrisjs/morris.min.js"></script>
    <script src="../font-end/data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <!-- <script src="../font-end/dist/js/sb-admin-2.js"></script> -->
    <!-- <script src="../font-end/dist/js/js.js"></script> -->
    <script type="text/javascript" src="../../js/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../js/datatables.min.css">
</body>

</html>
