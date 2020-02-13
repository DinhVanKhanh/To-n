<?php include TPL_DIR . '/_head.tpl.php'; ?>
<?php include('apps/bootstrap.php');
  $a = new apps_libs_Dbconn();
  $sql = "select * from posts order by post_id";
  $run = $a->Querry($sql);

 ?>
<body class="archive category category-tin-tuc category-67 header-shadow lightbox nav-dropdown-has-arrow">
  <div id="wrapper">
    <?php include TPL_DIR . '/_header-main.tpl.php'; ?>
    <main id="main" class="" style="padding-top: 50px;">
      <div class="row  ">
        <div class="post-sidebar large-4 col">
            <aside id="block_widget-7" class="widget block_widget">
              <div class="row"  id="row-852780339">
                <div class="col small-12 large-12"  >
                  <?php include TPL_DIR . '/_mini-news.tpl.php'; ?>
                  <?php include TPL_DIR . '/_newest-video.tpl.php'; ?>
                  <?php include TPL_DIR . '/_featured-news.tpl.php'; ?>
                  <?php include TPL_DIR . '/_statistical-access.tpl.php'; ?>
                </div>
              </div>
            </aside>
        </div>
        <!-- .post-sidebar -->
        <div class="large-8 col medium-col-first">
          <div class="row large-columns-1 medium-columns- small-columns-1">
            <div class="col post-item" >
              <div class="col-inner">
                    <span style="font-size: 15px;margin-bottom: 30px">Bài viết:</span>
                    <?php
                    $i = 1; 
                    while($dong = mysqli_fetch_assoc($run)){ ?>
                    <!-- .box-image -->
                    <div class="" >   <!-- box-text text-left: là chữ từng hàng sẽ giảm dần -->
                      <div class="box-text-inner blog-post-inner">
                        <a  href="?view=newss&id=<?php echo $dong['post_id'] ?>" class="post-title is-large "><?php echo $i.". ". $dong['post_title']?>  </a>
                        
                    <?php $i++;}
                        // if(isset($_GET['id'])){
                        //   $get = $_GET['id'];
                        //   if($get == "4"){
                        //     var_dump($_GET);
                        //   }
                        // }
                     ?>
                      <!-- .box-text-inner -->
                    </div>
                    <!-- .box-text -->
                
                <!-- .link -->
              </div>
              <!-- .col-inner -->
            </div>
            <!-- .col -->
          </div>
        <!-- .large-9 -->
      </div>
      <!-- .row -->
  </div>
  <!-- .page-wrapper .blog-wrapper -->
  </main><!-- #main -->
  <?php include TPL_DIR . '/_footer.tpl.php'; ?>
