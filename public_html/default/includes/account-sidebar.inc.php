<?php
	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database -> get_connection();

//	$data = unserialize($_SESSION['data']);
//	$userId = $data['end_user_id'];
//	$sql = "SELECT * FROM orders WHERE order_user = :user AND order_completed = 1 ORDER BY order_id DESC;";
//	$query1 = $conn -> prepare($sql);
//	$query1 -> execute(array(
//		':user' => $userId
//	));

	$sql = "SELECT * FROM products;";
	$query1 = $conn -> prepare($sql);
	$query1 -> execute();

	$html = '
		<li class="active col-xs-12 col-sm-12 col-md-12">
			<a class="edit-account" href="/index.php?view=account&action=info" title="Thông tin tài khoản">
				<span>Thông tin tài khoản</span>
			</a>
		</li>
		<li class="col-xs-12 col-sm-12 col-md-12">
			<a class="khoa-hoc-cua-ban-1" href="/index.php?view=account&action=course" title="KHÓA HỌC CỦA BẠN">
				<span>KHÓA HỌC CỦA BẠN</span>
			</a>
		</li>
	';
	$fetchQuery1 = $query1 -> fetchAll();
	foreach ($fetchQuery1 as $product){
        $html .= '
			<li class="col-xs-12 col-sm-12 col-md-12">
				<a class="khoa-hoc-cua-ban-1" href="/index.php?view=account&action=list&course_id=' . $product['product_id'] . '" title="' . $product['product_name'] . '">
					<span>' . $product['product_name'] . '</span>
				</a>
			</li>
		';
	}

	echo $html;
?>
<style type="text/css">
	/*@media (max-width: 480px){
		#my-account-menu .myaccount-menu li, #my-account-menu-tab .myaccount-menu li {
			width:370px !important;
		}
		.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
    		max-width: 82% !important;
	}
	#my-account-menu .user-profile .username{
		padding-right:130px;
	}
	.user-info a{
		margin-right:130px;
	}
	legend {
		width: 350px !important;
	}
}
	@media (max-width: 380px){
		#my-account-menu .myaccount-menu li, #my-account-menu-tab .myaccount-menu li {
			width:320px !important;
		}
		.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
    		max-width: 72% !important;
	}
	#my-account-menu .user-profile .username{
		padding-right:150px;
	}
	.user-info a{
		margin-right:150px;
	}
	legend {
		width: 300px !important;
	}
}
	@media (max-width: 320px){
		#my-account-menu .myaccount-menu li, #my-account-menu-tab .myaccount-menu li {
			width:270px !important;
		}
		.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
    		max-width: 62% !important;
	}
	#my-account-menu .user-profile .username{
		padding-right:180px;
	}
	.user-info a{
		margin-right:180px;
	}
	legend {
		width: 230px !important;
	}
	
}*/
.my-account>.container>.vertical-tabs>.large-9 {
    min-width: 303px !important;
}
</style>