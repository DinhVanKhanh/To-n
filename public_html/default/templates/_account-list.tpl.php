<fieldset>
	<legend style="max-width: 120px">Giới thiệu</legend>
	<div class="container">
		<div class="row">
			<?php include INC_DIR . '/account-list-demo.inc.php'; ?>
			<?php
			echo $html;
			?>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>Video</legend>
	<div class="container">
		<div class="row large-columns-4 medium-columns-3 small-columns-1">
			<?php include INC_DIR . '/account-list-grid.inc.php'; ?>
		</div>
	</div>
</fieldset>
<style>
	@media only screen and (max-width: 768px)
	{
		.myaccount-menu
		{
			display: none;
		}
	}
</style>
<script>
	$(document).ready(function(){
		if(screen.width<768)
		{
			$("#h-menu-phone").append($(".myaccount-menu").html());
		}
		$('html, body').animate({
            scrollTop: $("#video_show").offset().top
        }, 500);
	});
</script>