<main id="main" class="">
	<div class="page-wrapper my-account mb">
		<div class="container" role="main">
			<div class="woocommerce">
				<form id="f_reset_pass">
					<p>Quên mật khẩu? Vui lòng nhập tên đăng nhập hoặc địa chỉ email. Bạn sẽ nhận được một liên kết tạo mật khẩu mới qua email.</p>
					<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
						<label for="user_login">Tên đăng nhập hoặc email</label>
						<input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" />
					</p>
					<div class="clear"></div>
					<p class="woocommerce-form-row form-row">
						<input type="hidden" name="wc_reset_password" value="true" />
						<input id="reset_pass" type="button" class="woocommerce-Button button" value="Đặt lại mật khẩu" />
					</p>
				</form>
			</div>
		</div>
	</div>
</main>

<script>
	$(document).ready(function () {
		$("#f_reset_pass").submit(function () {
			return false;
		})

		$("#reset_pass").click(function () {
			$("#reset_pass").val('Vui lòng chờ');
			$('#reset_pass').attr('disabled', true);
			$.ajax({
				url: "default/includes/reset-password.inc.php",
				type: "post",
				dataType: "text",
				data: {
					user_email:$("#user_login").val()
				},
				success: function (result) {
					$("#reset_pass").val('Đặt lại mật khẩu');
					$('#reset_pass').removeAttr('disabled');
					alert(result);
				}
			});
		});
	
	})
</script>