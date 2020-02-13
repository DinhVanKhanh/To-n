<?php
  require('../../autoload.php');
	/*Session_start
	===========================================*/
	$security = new Security();
	$security -> sec_session_start();

		if (isset($_POST['productID'])){
			if(!isset($_SESSION['userCart'])){
				$_SESSION['userCart'] = [];
			}
			$ck=false;
			foreach($_SESSION['userCart'] as &$item)
			{
				if($item["productID"]==$_POST['productID'])
				{
					$item["number"]++;
					$ck=true;
				}
			}
			if($ck==false)
				array_push($_SESSION['userCart'], ["productID"=>$_POST['productID'],"number"=>1]);
			$returnArray = ['status' => 'success','message' => 'Đã thêm vào giỏ hàng'];
			print_r(json_encode($returnArray));
		} else{
			$returnArray = ['status' => 'fail', 'message' => 'Bạn chưa chọn khóa học nào.'];
			print_r(json_encode($returnArray));
		};
	
