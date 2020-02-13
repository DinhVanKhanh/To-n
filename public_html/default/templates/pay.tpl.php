  <?php 
  require('autoload.php');
  include TPL_DIR . '/_head.tpl.php';

  $userEmail = unserialize($_SESSION['data'])['end_user_email'];

  $database = new Database(HOST, USER, PASS, DBNAME);
  $conn = $database->get_connection();

  
  $sql = 'SELECT * FROM end_users WHERE end_user_email = :email;';

  $query = $conn->prepare($sql);

  $query->execute([
    ':email' => $userEmail
  ]);

  $userInfo = $query->fetch(PDO::FETCH_ASSOC);

  //Get Payment Term content
  $sql = 'SELECT * FROM posts WHERE post_id = :postID;';
  $query = $conn->prepare($sql);
  $query->execute([
    ':postID' => 6
  ]);

  $termContent = $query->fetch(PDO::FETCH_ASSOC);




  // Get User Ward
  $sqlWard = 'SELECT * FROM devvn_xaphuongthitran_unicode WHERE xaid = :wardID;';

  $queryWard = $conn->prepare($sqlWard);
  $queryWard->execute([
    ':wardID' => $userInfo['end_user_ward']
  ]);

  $userWard = $queryWard->fetch(PDO::FETCH_ASSOC);
  // Get User District
  $sqlDistrict = 'SELECT * FROM devvn_quanhuyen_unicode WHERE maqh = :districtID;';

  $queryDistrict = $conn->prepare($sqlDistrict);
  $queryDistrict->execute([
    ':districtID' => $userInfo['end_user_district']
  ]);

  $userDistrict = $queryDistrict->fetch(PDO::FETCH_ASSOC);
  // Get User City
  $sqlCity = 'SELECT * FROM devvn_tinhthanhpho_unicode WHERE matp = :cityID;';

  $queryCity = $conn->prepare($sqlCity);
  $queryCity->execute([
    ':cityID' => $userInfo['end_user_city']
  ]);

  $userCity = $queryCity->fetch(PDO::FETCH_ASSOC);

  $userLocation = 'Địa chỉ: Số nhà ' . $userInfo['end_user_address'] . ', Xã/Phường:  ' . $userWard['name'] . ', Quận/Huyện:  ' .
    $userDistrict['name'] . ', Tỉnh/Thành Phố:  ' . $userCity['name'] . '.';

  ?>
      <body class="home page-template-default page page-id-291 header-shadow lightbox nav-dropdown-has-arrow">
        <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
        <div id="wrapper">
              <?php include TPL_DIR . '/_header-main.tpl.php'; ?>
          <main id="main" class="">
            <div id="content" class="content-area page-wrapper" role="main">
            	<div class="container" style="background-color: white; color: black;">
            		<div class="row text-center" style="margin-top: 20px">
            			 <h1> Xin chào, <?php echo $userInfo['end_user_fullname']; ?></h1>
            			 <h2>Đơn hàng của bạn</h2>		
            		</div>
            		<?php
              $sql = "SELECT * FROM products;";
              $query1 = $conn->prepare($sql);
              $query1->execute();
              $fetchQuery1 = $query1->fetchAll();
              $i=1;
              foreach ($fetchQuery1 as $product) {
                $product_url = json_decode($product['product_images']);
                echo '<div class="row add_margin_top">

							  			<div class="col-md-1 col-md-offset-1">
							  				<img src="/uploads/' . $product_url[0] . '">
							  			</div>
							  			<div class="col-md-2">
							  				<p>' . $product['product_name'] . '</p>
							  			</div>
							  			<div class="col-md-2">
							  				<p> Giá tiền: <span name="price" value="' . $product['product_price'] . '">' . $product['product_price'] . '</span></p>
							  			</div>
                      <div class="col-md-3">
                        <p style="display: inline-block; position: relative; bottom: 12px;">Số lượng: </p>
                        <input id="quantity'.$i.'" style="display: inline-block; margin-left: 20px; width: 60px;" type="number" value="' . CheckIDProduct($product['product_id']) . '" name="quantity" min=1 required>

                      </div>
							  			<div class="col-md-2">
                        <form action="default/includes/remove-from-cart.inc.php" method="POST">
                          <input id="productid'.$i.'" type="hidden" name="removedProduct" value="' . $product['product_id'] . '">
							  				  <button class="btn btn-warning btn-block" type="submit">Xóa khỏi giỏ hàng</button>
                        </form>
							  			</div>
                    </div>';
                    $i++;
              }
              echo "<input type='hidden' value='$i' id='number'/>";
              function CheckIDProduct($id)
              {
                $userCart = $_SESSION['userCart'];
                if ($userCart)
                  foreach ($userCart as $value) {
                  if ($id == $value["productID"])
                    return $value["number"];
                }
                return 0;
              }
              ?>
            		<div class="row text-center add_margin_top">
            			<h1> Địa điểm giao hàng </h1>
            			<h3> Vui lòng kiểm tra kỹ điểm điểm nhận hàng và số điện thoại liên lạc</h3>
            		</div>
                <div class="container">
              		<div class="row add_margin_top">
              			<h2 style="color: black;"><i class="fas fa-home"></i> <?php echo $userLocation; ?></h2>
                    <h2 style="color: black;"><i class="fas fa-phone"></i> Số điện thoại liên hệ: <?php echo $userInfo['end_user_phone_number']; ?></h2>
              		</div>
                  <div class="row add_margin_top">
                    <a class="btn btn-primary" href="/index.php?view=account&action=info">Chỉnh sửa địa điểm giao hàng</a>
                  </div>
                  <div class="row">
                    <h3 class="add_margin_top">Điều khoản thanh toán</h3>
                    <span style="border:1px solid #dcdcdc;width:100%">
                      <?php
                      echo $termContent['post_content'];
                        //echo $termContent['post_content'];
                      ?>
                    </span>
                    <input type="checkbox" name="paymentTerms" value="termsAccepted">
                      <span>Tôi đã đọc và đồng ý với các điều khoản của Công ty.</span>
                      <div class="row add_margin_top text-center">
                      <!-- <h3 style="margin-left: 38px;">Tổng thành tiền đơn hàng: 
                      <?php

                      $thanhTien = 0;

                      foreach ($userCart as $productID) {



                        $sqlDonGia = 'SELECT product_price FROM products WHERE product_id = :productID;';

                        $queryDonGia = $conn->prepare($sqlDonGia);

                        $queryDonGia->execute([
                          ':productID' => $productID
                        ]);

                        $result = $queryDonGia->fetch(PDO::FETCH_ASSOC);
                        $donGia = $result['product_price'];



                        $thanhTien += $donGia;
                      };

                      echo $thanhTien . ' VND';
                      ?></p> -->
                        <p style="font-size: 30px; margin-left: 33%">Tổng thành tiền đơn hàng: </p>
                        <span style="font-size: 30px;" id="thanhTien"></span>
                      <div class="row add_margin_top text-center" style="margin-bottom: 50px;">
                          <a id="confirmOrder" class="btn btn-primary" style="margin-left: 45%">Xác nhận đơn hàng và đặt hàng</a>
                      </div>
                    </div>
                  </div>
                </div>
            	</div>
             </div>
          </main>

<?php include TPL_DIR . '/_footer.tpl.php'; ?>
