<?php
  if(!isset($_GET['id'])) {
    echo 'Khóa học không tồn tại';
    exit;
  }

	$database = new Database(HOST, USER, PASS, DBNAME);
	$conn = $database -> get_connection();

	$buyText = (isset($_GET['buy']) && $_GET['buy'] === true) ? 'Mua thêm' : 'Mua khóa học';

	//Get course
  $sql = "SELECT * FROM products WHERE product_id = :id;";
  $query = $conn -> prepare($sql);
  $query -> execute(array(
    ':id' => (int)$_GET['id']
  ));
  $product = $query -> fetch(PDO::FETCH_ASSOC);

  //Get preview images
  $images = '';
  foreach(json_decode($product['product_images']) as $img) {
    $images .= '
      <div data-thumb="/uploads/' . $img . '" class="first slide woocommerce-product-gallery__image">
        <a href="/index.php?view=course&id=' . $product['product_id'] . '">
          <img width="430" height="616" src="/uploads/' . $img . '" class="attachment-shop_single size-shop_single wp-post-image" alt="" title="cd6" data-caption="" data-src="/uploads/' . $img . '" data-large_image="/uploads/' . $img . '" data-large_image_width="430" data-large_image_height="616">
        </a>
      </div>
    ';
  }

  //Get preview thumbs
  $thumbs = '';
  foreach(json_decode($product['product_images']) as $img) {
    $thumbs .= '
      <div class="col is-nav-selected first"><a><img width="120" height="120" src="/uploads/' . $img . '" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt=""></a></div>
    ';
  }

  //Get course category
  $sql = "SELECT * FROM product_cates WHERE cate_id = :id;";
  $query = $conn -> prepare($sql);
  $query -> execute(array(
    ':id' => (int)$product['product_cate']
  ));
  $cate = $query -> fetch(PDO::FETCH_ASSOC);

  //Get related
  $sql = "SELECT * FROM products WHERE product_cate = :id LIMIT 4;";
  $query = $conn -> prepare($sql);
  $query -> execute(array(
    ':id' => (int)$product['product_cate']
  ));

  $html = '';
  while($r = $query -> fetch(PDO::FETCH_ASSOC)) {
    $img = json_decode($r['product_images']);
    $html .= '
    <div class="col">
      <div class="col-inner">
        <div class="badge-container absolute left top z-1"></div>
        <div class="product-small box">
          <div class="box-image">
            <div class="image-fade_in_back">
              <a href="/index.php?view=course&id=' . $r['product_id'] . '">
                <img width="240" height="240" src="/uploads/' . $img[0] . '" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="" />
              </a>
            </div>
          </div>
          <div class="box-text box-text-products">
            <div class="title-wrapper">
              <p class="category uppercase is-smaller no-text-overflow product-cat op-7">
                ' . $r['product_name'] . '
              </p>
            </div>
            <div class="price-wrapper">
              <span class="price"><span class="woocommerce-Price-amount amount">' . number_format($r['product_price'], 0, '.', ',') . '&nbsp;<span class="woocommerce-Price-currencySymbol">₫</span></span></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    ';
  }
?>
