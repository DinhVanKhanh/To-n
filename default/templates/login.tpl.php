<div class="col-1 large-6 col pb-0">
  <div class="account-login-inner">
    <h3 class="uppercase">Đăng nhập</h3>
    <form class="woocommerce-form woocommerce-form-login login" method="post" action="default/includes/login.inc.php">
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="username">Tên tài khoản hoặc địa chỉ email <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="username" value="" />
      </p>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="password">Mật khẩu <span class="required">*</span></label>
        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
      </p>
      <p class="form-row">
				<input type="hidden" name="redirection" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
        <input type="submit" class="woocommerce-Button button" name="login" value="Đăng nhập" />
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>Ghi nhớ mật khẩu</span>
        </label>
      </p>
      <p class="woocommerce-LostPassword lost_password">
        <a href="default/templates/lost_password.tpl.php">Quên mật khẩu?</a>
      </p>
    </form>
  </div>
  <!-- .login-inner -->
</div>