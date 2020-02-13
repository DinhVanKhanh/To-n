<?php include(INC_DIR . '/course-detail.inc.php'); ?>
<div class="page-title-inner flex-row  medium-flex-wrap container">
  <div class="flex-col flex-grow medium-text-center">
    <div class="is-large">
      <nav class="woocommerce-breadcrumb breadcrumbs"><a href="/index.php">Trang chủ</a> <span class="divider">/</span><a href="/index.php?view=cate&id=<?php echo $cate['cate_id']; ?>"><?php echo $cate['cate_name']; ?></a></nav>
    </div>
  </div>
  <!-- .flex-left -->
</div>
<!-- flex-row -->
</div><!-- .page-title -->
<main id="main" class="">
<div class="shop-container">
<div id="product-893" class="post-893 product type-product status-publish has-post-thumbnail product_cat-cac-lop-hoc-cho-be-tu-7-den-12-tuoi first instock shipping-taxable product-type-simple">
<div class="product-main">
<div class="row content-row row-divided row-large row-reverse">
<div class="col large-9">
  <div class="row">
    <div class="large-7 col">
      <div class="product-images relative mb-half has-hover woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4">
        <figure class="woocommerce-product-gallery__wrapper product-gallery-slider slider slider-nav-small mb-half has-image-zoom" data-flickity-options="{
          &quot;cellAlign&quot;: &quot;center&quot;,
          &quot;wrapAround&quot;: true,
          &quot;autoPlay&quot;: false,
          &quot;prevNextButtons&quot;:true,
          &quot;adaptiveHeight&quot;: true,
          &quot;imagesLoaded&quot;: true,
          &quot;lazyLoad&quot;: 1,
          &quot;dragThreshold&quot; : 15,
          &quot;pageDots&quot;: false,
          &quot;rightToLeft&quot;: false       }">
          <?php echo $images; ?>
        </figure>
      </div>
      <div class="product-thumbnails thumbnails slider-no-arrows slider row row-small row-slider slider-nav-small small-columns-4" data-flickity-options="{
        &quot;cellAlign&quot;: &quot;left&quot;,
        &quot;wrapAround&quot;: false,
        &quot;autoPlay&quot;: false,
        &quot;prevNextButtons&quot;:true,
        &quot;asNavFor&quot;: &quot;.product-gallery-slider&quot;,
        &quot;percentPosition&quot;: true,
        &quot;imagesLoaded&quot;: true,
        &quot;pageDots&quot;: false,
        &quot;rightToLeft&quot;: false,
        &quot;contain&quot;: true
        }">
        <?php echo $thumbs; ?>
      </div>
      <!-- .product-thumbnails -->
    </div>
    <div class="product-info summary entry-summary col col-fit product-summary">
      <h1 class="product-title entry-title">
        <?php echo $product['product_name']; ?>
      </h1>
      <div class="is-divider small"></div>

			<?php
				if( !isset( $_SESSION['logged'] ) || $_SESSION['logged'] !== true ) {
					echo '<a class="button wltspab_custom_login_link nav-top-link nav-top-not-logged-in" href="" data-open="#login-form-popup">ĐĂNG NHẬP ĐỂ MUA KHÓA HỌC</a>';
				}
				else {
					// echo '<a class="button" href="/default/includes/buy.inc.php?id=' . $product['product_id'] . '">' . $buyText . '</a>';
          echo'<a class="button" href="#" name="'.$product['product_id'].'" id="addToCart">THÊM VÀO GIỎ HÀNG</a>';
				}
			?>
      <div class="price-wrapper">
        <p class="price product-page-price ">
          <span class="woocommerce-Price-amount amount"><?php echo number_format($product['product_price'], 0, ',', '.'); ?>&nbsp;<span class="woocommerce-Price-currencySymbol">₫</span></span>
        </p>
      </div>
      <div class="product-short-description">
        <p><?php echo $product['product_short_des']; ?></p>
      </div>
      <div class="product_meta">
        <span class="posted_in">Danh mục: <a href="/index.php?view=cate&id=<?php echo $cate['cate_id']; ?>" rel="tag"><?php echo $cate['cate_name']; ?></a></span>
      </div>
    </div>
    <!-- .summary -->
  </div>
  <!-- .row -->
  <div class="product-footer">
    <div class="woocommerce-tabs container tabbed-content">
      <ul class="product-tabs  nav small-nav-collapse tabs nav nav-uppercase nav-tabs nav-normal nav-left">
        <li class="description_tab  active">
          <a href="http://smartbrain.edu.vn/san-pham/giao-trinh-cap-do-6/#tab-description">Mô tả</a>
        </li>
      </ul>
      <div class="tab-panels" style="padding: 0px; border: none;">
        <div class="panel entry-content active" id="tab-description">
          <textarea cols="4" rows="50" readonly style="resize: none">
            <?php echo $product['product_long_des']; ?>   
          </textarea>
            
        </div>
      </div>
      <!-- .tab-panels -->
    </div>
    <!-- .tabbed-content -->
    <div class="related related-products-wrapper product-section">
      <h3 class="product-section-title container product-section-title-related pt-half pb-half uppercase">
        Khóa học tương tự
      </h3>
      <div class="row large-columns-4 medium-columns- small-columns-2 row-small slider row-slider slider-nav-reveal slider-nav-push" data-flickity-options="{&quot;imagesLoaded&quot;: true, &quot;groupCells&quot;: &quot;100%&quot;, &quot;dragThreshold&quot; : 5, &quot;cellAlign&quot;: &quot;left&quot;,&quot;wrapAround&quot;: true,&quot;prevNextButtons&quot;: true,&quot;percentPosition&quot;: true,&quot;pageDots&quot;: false, &quot;rightToLeft&quot;: false, &quot;autoPlay&quot; : false}">
        <?php echo $html; ?>
      </div>
    </div>
  </div>
</div>
<!-- col large-9 -->

