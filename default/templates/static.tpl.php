  <?php include TPL_DIR . '/_head.tpl.php';
  		include('apps/bootstrap.php');
		$a = new apps_libs_Dbconn();
		$sql = "select * from part_ttd";
		$run = $a->Querry($sql);
		$dong = mysqli_fetch_assoc($run);


   ?>

<body class="page-template-default page page-id-299 header-shadow lightbox nav-dropdown-has-arrow">

<a class="skip-link screen-reader-text" href="#main">Skip to content</a>

<div id="wrapper">


  <?php include TPL_DIR . '/_header-main.tpl.php'; ?>


<main id="main" class="">
<div id="content" class="content-area page-wrapper" role="main">
	<div class="row row-main">
		<div class="large-12 col">
			<div class="col-inner">
						<p>&nbsp;</p>
<div class="row row-small" style="max-width:1140px" id="row-150879133">
<div class="col medium-9 small-12 large-9"  ><div class="col-inner" style="padding:0px 15px 0px 0px;" >

<?= $dong['content']?>

</div></div>
<div class="col medium-3 small-12 large-3"  ><div class="col-inner" style="padding:0px 0px 0px 0px;" >
<div class="row"  id="row-1124075665">

<div class="col small-12 large-12"  ><div class="col-inner box-shadow-2" style="padding:10px 15px 10px 15px;" >

    <?php include TPL_DIR . '/_mini-news.tpl.php'; ?>

    <?php include TPL_DIR . '/_newest-video.tpl.php'; ?>

    <?php include TPL_DIR . '/_featured-news.tpl.php'; ?>

    <?php include TPL_DIR . '/_statistical-access.tpl.php'; ?>

</div>
</div></div>

<style scope="scope">

</style>
</div>
<p>Trân trọng!</p>


												</div><!-- .col-inner -->
		</div><!-- .large-12 -->
	</div><!-- .row -->
</div>


</main><!-- #main -->
<?php include TPL_DIR . '/_footer.tpl.php'; ?>
