<?php
  $database = new Database(HOST, USER, PASS, DBNAME);
  $conn = $database -> get_connection();

  $sql = "SELECT * FROM products WHERE product_id>=36 and product_id<=38 ORDER BY product_id ASC;";
  $query = $conn -> prepare($sql);
  $query -> execute();

  $html1 = '';
  while($r = $query -> fetch(PDO::FETCH_ASSOC)) {
    $img = json_decode($r['product_images']);
    $html1 .= '
      <div class="col" >
        <div class="col-inner">
          <div class="badge-container absolute left top z-1"></div>
          <div class="product-small box has-hover box-normal box-text-bottom">
            <div class="box-image" >
              <div class="" >
                <a href="/index.php?view=course&id=' . $r['product_id'] . '">
                  <img width="240" src="/uploads/' . $img[0] . '" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="" srcset="" />
                </a>
              </div>
            </div>
            <div class="box-text text-center" >
              <div class="title-wrapper">
                <p class="category uppercase no-text-overflow product-cat">
                  ' . $r['product_name'] . '
                </p>
              </div>
              <div class="price-wrapper">
                <span class="price"><span class="woocommerce-Price-amount amount">' . number_format($r['product_price'], 0, ',', '.') . '&nbsp;<span class="woocommerce-Price-currencySymbol">&#8363;</span></span></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    ';
  }
  //====
  $sql = "SELECT * FROM products WHERE product_id>=39 and product_id<=46 ORDER BY product_id ASC;";
  $query = $conn -> prepare($sql);
  $query -> execute();

  $html2 = '';
  while($r = $query -> fetch(PDO::FETCH_ASSOC)) {
    $img = json_decode($r['product_images']);
    $html2 .= '
      <div class="col" >
        <div class="col-inner">
          <div class="badge-container absolute left top z-1"></div>
          <div class="product-small box has-hover box-normal box-text-bottom">
            <div class="box-image" >
              <div class="" >
                <a href="/index.php?view=course&id=' . $r['product_id'] . '">
                  <img width="240" src="/uploads/' . $img[0] . '" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="" srcset="" />
                </a>
              </div>
            </div>
            <div class="box-text text-center" >
              <div class="title-wrapper">
                <p class="category uppercase no-text-overflow product-cat">
                  ' . $r['product_name'] . '
                </p>
              </div>
              <div class="price-wrapper">
                <span class="price"><span class="woocommerce-Price-amount amount">' . number_format($r['product_price'], 0, ',', '.') . '&nbsp;<span class="woocommerce-Price-currencySymbol">&#8363;</span></span></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    ';
  }

  //====
  $sql = "SELECT * FROM products WHERE product_id>46 ORDER BY product_id ASC;";
  $query = $conn -> prepare($sql);
  $query -> execute();

  $html3 = '';
  while($r = $query -> fetch(PDO::FETCH_ASSOC)) {
    $img = json_decode($r['product_images']);
    $html3 .= '
      <div class="col" >
        <div class="col-inner">
          <div class="badge-container absolute left top z-1"></div>
          <div class="product-small box has-hover box-normal box-text-bottom">
            <div class="box-image" >
              <div class="" >
                <a href="/index.php?view=course&id=' . $r['product_id'] . '">
                  <img width="240" src="/uploads/' . $img[0] . '" class="attachment-shop_catalog size-shop_catalog wp-post-image" alt="" srcset="" />
                </a>
              </div>
            </div>
            <div class="box-text text-center" >
              <div class="title-wrapper">
                <p class="category uppercase no-text-overflow product-cat">
                  ' . $r['product_name'] . '
                </p>
              </div>
              <div class="price-wrapper">
                <span class="price"><span class="woocommerce-Price-amount amount">' . number_format($r['product_price'], 0, ',', '.') . '&nbsp;<span class="woocommerce-Price-currencySymbol">&#8363;</span></span></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    ';
  }
?>
