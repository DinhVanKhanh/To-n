  <?php include TPL_DIR . '/_head.tpl.php' ?>
  <?php 
      include('apps/bootstrap.php');
      $a = new apps_libs_Dbconn();
      $sql = "select * from title1";
      $run = $a->Querry($sql);


   ?>
      <body class="home page-template-default page page-id-291 header-shadow lightbox nav-dropdown-has-arrow">
        <a class="skip-link screen-reader-text" href="#main">Skip to content</a>
        <div id="wrapper">
              <?php include TPL_DIR . '/_header-main.tpl.php' ?>
          <main id="main" class="">
            <div id="content" class="content-area page-wrapper" role="main">
              <div class="row row-main">
                <div class="large-12 col">
                  <div class="col-inner">
                    <div class="row row-small" style="max-width:1140px" id="row-1735762556">
                      <div class="col medium-9 small-12 large-9"  >
                        <div class="col-inner text-center"  >
													<div class="gap-element" style="display:block; height:auto; padding-top:27px" class="clearfix"></div>
                          <div class="container section-title-container" >
                            <h3 class="section-title section-title-center"><b></b><span class="section-title-main" style="color:rgb(236, 16, 16);">THƯƠNG HIỆU - BẢN QUYỀN TOÁN TƯ DUY</span><b></b></h3>
                          </div>
                          <!-- .section-title -->
                         
                          <div class="row row-small"  id="row-895025583">
                            <div class="col small-12 large-12"  >
                              <div class="col-inner"  >
                                <div class="row large-columns-3 medium-columns- small-columns-2 row-small has-shadow row-box-shadow-2 slider row-slider slider-nav-reveal slider-nav-push"  data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 4000}'>
																	<div class="col" >
																		<div class="col-inner">
																			<div class="badge-container absolute left top z-1"></div>
																			<div class="product-small box has-hover box-normal box-text-bottom">
                                        <?php while ($dong1 = mysqli_fetch_array($run)) {                 
                                         ?>
																				<div class="box-image" >
                                          
																					<div class="" >
                                            <?php echo $dong1['hinh1'] ?>
                                            
																						
																					</div>
																				</div>
																				<!-- box-image -->
																				<div class="box-text text-center" >
																					<div class="title-wrapper">
																						<p class="category uppercase no-text-overflow product-cat">
																							Thương hiệu - Bản quyền
																						</p>
																					</div>
																				</div>
																				<!-- box-text -->
																			</div>
																			<!-- box -->
                                        
																		</div>
																		<!-- .col-inner -->
																	</div>
																	<!-- col -->
																	<div class="col" >
																		<div class="col-inner">
																			<div class="badge-container absolute left top z-1"></div>
																			<div class="product-small box has-hover box-normal box-text-bottom">
																				<div class="box-image" >
																					<div class="" >
                                            
																						<?php echo $dong1['hinh2'] ?>
																					</div>
																				</div>
																				<!-- box-image -->
																				<div class="box-text text-center" >
																					<div class="title-wrapper">
																						<p class="category uppercase no-text-overflow product-cat">
																							Thương hiệu - Bản quyền
																						</p>
																					</div>
																				</div>
																				<!-- box-text -->
																			</div>
																			<!-- box -->
																		</div>
																		<!-- .col-inner -->
																	</div>
																	<!-- col -->
																	<div class="col" >
																		<div class="col-inner">
																			<div class="badge-container absolute left top z-1"></div>
																			<div class="product-small box has-hover box-normal box-text-bottom">
																				<div class="box-image" >
																					<div class="" >
																						<?php echo $dong1['hinh3'] ?>
																					</div>
																				</div>

																				<!-- box-image -->
																				<div class="box-text text-center" >
																					<div class="title-wrapper">
																						<p class="category uppercase no-text-overflow product-cat">
																							Thương hiệu - Bản quyền
																						</p>
																					</div>
																				</div>
                                      <?php } ?>
																				<!-- box-text -->
																			</div>
																			<!-- box -->
																		</div>
																		<!-- .col-inner -->
																	</div>
                                  <!-- col -->
                                </div>
                              </div>
                            </div>
                            <style scope="scope">
                            </style>
                          </div>

                          <!-- .section-title -->
                          <?php include TPL_DIR . '/_slide.tpl.php' ?>
                          <div class="row large-columns-4 medium-columns- small-columns-2 row-xsmall has-shadow row-box-shadow-1 slider row-slider slider-nav-reveal slider-nav-push"  data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : false}'>
                          </div>
                        </div>
                      </div>
                      <div class="col medium-3 small-12 large-3"  >
                        <div class="col-inner"  >
                          <div class="gap-element" style="display:block; height:auto; padding-top:25px" class="clearfix"></div>
                          <div class="container section-title-container" >
                            <h3 class="section-title section-title-center"><b></b><span class="section-title-main" style="font-size:110%;color:rgb(244, 47, 47);">Giới Thiệu Khóa Học</span><b></b></h3>
                          </div>

                          <!-- .section-title -->
                          <div class="row large-columns-1 medium-columns-1 small-columns-1 row-small">
                            <?php
                            include ("apps/bootstrap.php");
                            $param=[
                              "select"=>"*",
                              "from"=>"videos",
                              "where"=>"demo=1 order by video_product ASC"
                            ];
                            $db=new apps_libs_Dbconn();
                            $result=$db->Select($param);
                            if($result)
                            {
                              while($row=mysqli_fetch_assoc($result))
                              {
                                echo '
                                <div class="col post-item" >
                                  <button data-toggle="modal" data-target="#myModal'.$row["video_id"].'" class="col-inner">
                                      <div class="box box-vertical box-text-bottom box-blog-post has-hover">
                                        <div class="box-image" style="width:35%;">
                                          <div class="image-cover" style="padding-top:76%;">
                                            <img width="259" height="194" src="images/play-btn.png" sizes="(max-width: 259px) 100vw, 259px" />
                                          </div>
                                        </div>
                                        <!-- .box-image -->
                                        <div class="box-text text-left is-xsmall" >
                                          <div class="box-text-inner blog-post-inner">
                                            <h5 class="post-title is-large uppercase">'.$row["video_name"].'</h5>
                                            <div class="is-divider"></div>
                                          </div>
                                          <!-- .box-text-inner -->
                                        </div>
                                        <!-- .box-text -->
                                      </div>
                                      <!-- .box -->
                                  
                                    <!-- .link -->
                                  </button>
                                  <!-- .col-inner -->
                                </div>

                                <div id="myModal'.$row["video_id"].'" class="modal fade" role="dialog">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">'.$row["video_name"].'</h4>
                                      </div>
                                      <div class="modal-body">
                                      <video controls style="width:100%" controlsList="nodownload">
                                        <source src="/blockdonwload/donwload.php?key='.$row["keyss"].'&video_id='.$row["video_id"].'"></source>
                                      </video>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                
                                  </div>
                                </div>';
                              }
                            }
                            


                            ?>
                          </div>


                          <div class="container section-title-container" >
                            <h3 class="section-title section-title-center"><b></b><span class="section-title-main" style="color:rgb(252, 0, 0);">hỗ trợ trực tuyến</span><b></b></h3>
                          </div>
                          <!-- .section-title -->
                          <p>Hotline: Smart Brain &#8211; Biên Hòa<br />
                            0251.627.7878 &#8211; 0913.978.263
                          </p>
                          <div class="gap-element" style="display:block; height:auto; padding-top:10px" class="clearfix"></div>
                          <div class="social-icons follow-icons full-width text-center" ><a href="featured_item/another-print-package/index.html" target="_blank" data-label="Facebook"  rel="nofollow" class="icon primary button circle facebook tooltip" title="Follow on Facebook"><i class="icon-facebook" ></i></a><a href="featured_item/another-print-package/index.html" target="_blank"  data-label="Twitter"  rel="nofollow" class="icon primary button circle  twitter tooltip" title="Follow on Twitter"><i class="icon-twitter" ></i></a><a href="mailto:a" target="_blank"  data-label="E-mail"  rel="nofollow" class="icon primary button circle  email tooltip" title="Send us an email"><i class="icon-envelop" ></i></a><a href="featured_item/another-print-package/index.html" target="_blank" rel="nofollow"  data-label="Google+"  class="icon primary button circle  google-plus tooltip" title="Follow on Google+"><i class="icon-google-plus" ></i></a><a href="featured_item/another-print-package/index.html" target="_blank" rel="nofollow" data-label="YouTube" class="icon primary button circle  youtube tooltip" title="Follow on YouTube"><i class="icon-youtube" ></i></a></div>
                          <div class="gap-element" style="display:block; height:auto; padding-top:10px" class="clearfix"></div>
                          <?php include TPL_DIR . '/_statistical-access.tpl.php'; ?>
                        </div>
                      </div>
                      <style scope="scope">
                      </style>
                    </div>
                    <table class="wp-list-table widefat fixed striped wonderplugin-slider_page_wonderplugin_slider_show_items">
                      <tbody id="the-list">
                        <tr>
                          <td class="shortcode column-shortcode" data-colname="Shortcode">
                            <div id="amazingslider_customtexteffect_2" style="display:none;">{"Bottom bar":{"textstyle":"static","textpositionstatic":"bottom","textautohide":true,"textpositionmarginstatic":0,"textpositiondynamic":"bottomleft","textpositionmarginleft":24,"textpositionmarginright":24,"textpositionmargintop":24,"textpositionmarginbottom":24,"texteffect":"slide","texteffecteasing":"easeOutCubic","texteffectduration":600,"texteffectslidedirection":"left","texteffectslidedistance":30,"texteffectdelay":500,"texteffectseparate":false,"texteffect1":"slide","texteffectslidedirection1":"right","texteffectslidedistance1":120,"texteffecteasing1":"easeOutCubic","texteffectduration1":600,"texteffectdelay1":1000,"texteffect2":"slide","texteffectslidedirection2":"right","texteffectslidedistance2":120,"texteffecteasing2":"easeOutCubic","texteffectduration2":600,"texteffectdelay2":1500,"textcss":"display:block; padding:12px; text-align:left;","textbgcss":"display:block; position:absolute; top:0px; left:0px; width:100%; height:100%; background-color:#333333; opacity:0.6; filter:alpha(opacity=60);","titlecss":"display:block; position:relative; font:bold 14px Georgia,serif,Arial; color:#fff;","descriptioncss":"display:block; position:relative; font:12px Georgia,serif,Arial; color:#fff; margin-top:8px;","buttoncss":"display:block; position:relative; margin-top:8px;","texteffectresponsive":true,"texteffectresponsivesize":640,"titlecssresponsive":"font-size:12px;","descriptioncssresponsive":"display:none !important;","buttoncssresponsive":"","addgooglefonts":false,"googlefonts":"","textleftrightpercentforstatic":40}}</div>
                            <div class="wonderpluginslider-container" id="wonderpluginslider-container-2" style="max-width:1130px;margin:0 auto;padding-left:0px;padding-right:240px;padding-top:0px;padding-bottom:0px;">
                              <div class="wonderpluginslider" id="wonderpluginslider-2" data-sliderid="2" data-width="1130" data-height="700" data-skin="righttabs" data-autoplay="true" data-randomplay="false" data-loadimageondemand="false" data-transitiononfirstslide="false" data-autoplayvideo="false" data-isresponsive="true" data-fullwidth="false" data-isfullscreen="false" data-ratioresponsive="false" data-showtext="true" data-showtimer="true" data-showbottomshadow="false" data-navshowpreview="false" data-textautohide="true" data-pauseonmouseover="false" data-lightboxresponsive="true" data-lightboxshownavigation="false" data-lightboxshowtitle="true" data-lightboxshowdescription="false" data-texteffectresponsive="true" data-donotinit="false" data-addinitscript="false" data-lightboxfullscreenmode="true" data-lightboxcloseonoverlay="true" data-lightboxvideohidecontrols="false" data-lightboxnogroup="false" data-lightboxshowsocial="false" data-lightboxshowfacebook="true" data-lightboxshowtwitter="true" data-lightboxshowpinterest="true" data-lightboxsocialrotateeffect="true" data-showsocial="false" data-showfacebook="true" data-showtwitter="true" data-showpinterest="true" data-socialrotateeffect="true" data-disableinlinecss="false" data-triggerresize="false" data-lightboxautoslide="false" data-lightboxshowtimer="true" data-lightboxshowplaybutton="true" data-lightboxalwaysshownavarrows="false" data-lightboxshowtitleprefix="true" data-titleusealt="false" data-scalemode="fill" data-arrowstyle="mouseover" data-transition="slice" data-loop="0" data-border="0" data-slideinterval="8000" data-arrowimage="arrows-32-32-0.png" data-arrowwidth="32" data-arrowheight="32" data-arrowtop="50" data-arrowmargin="8" data-navstyle="thumbnails" data-navimage="bullet-24-24-5.png" data-navwidth="70" data-navheight="68" data-navspacing="5" data-navmarginx="16" data-navmarginy="16" data-navposition="right" data-playvideoimage="playvideo-64-64-0.png" data-playvideoimagewidth="64" data-playvideoimageheight="64" data-lightboxthumbwidth="90" data-lightboxthumbheight="60" data-lightboxthumbtopmargin="12" data-lightboxthumbbottommargin="4" data-lightboxbarheight="64" data-lightboxtitlebottomcss="color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;" data-lightboxdescriptionbottomcss="color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;" data-textformat="Bottom bar" data-textpositionstatic="bottom" data-textpositiondynamic="bottomleft" data-paddingleft="0" data-paddingright="240" data-paddingtop="0" data-paddingbottom="0" data-texteffectresponsivesize="640" data-textleftrightpercentforstatic="40" data-fadeduration="1000" data-crossfadeduration="1000" data-slideduration="1000" data-elasticduration="1000" data-sliceduration="1500" data-blindsduration="1500" data-blocksduration="1500" data-shuffleduration="1500" data-tilesduration="2000" data-kenburnsduration="5000" data-flipduration="1500" data-flipwithzoomduration="2000" data-threedduration="1500" data-threedhorizontalduration="1500" data-threedwithzoomduration="2500" data-threedhorizontalwithzoomduration="2200" data-threedflipduration="1500" data-threedflipwithzoomduration="2000" data-threedtilesduration="2000" data-threedfallback="flip" data-threedhorizontalfallback="flip" data-threedwithzoomfallback="flipwithzoom" data-threedhorizontalwithzoomfallback="flipwithzoom" data-threedflipfallback="flip" data-threedflipwithzoomfallback="flipwithzoom" data-threedtilesfallback="tiles" data-ratiomediumscreen="800" data-ratiomediumheight="1.2" data-ratiosmallscreen="480" data-ratiosmallheight="1.6" data-socialmode="mouseover" data-socialposition="position:absolute;top:8px;right:8px;" data-socialpositionsmallscreen="position:absolute;top:8px;right:8px;" data-socialdirection="horizontal" data-socialbuttonsize="32" data-socialbuttonfontsize="18" data-lightboxsocialposition="position:absolute;top:100%;right:0;" data-lightboxsocialpositionsmallscreen="position:absolute;top:100%;right:0;left:0;" data-lightboxsocialdirection="horizontal" data-lightboxsocialbuttonsize="32" data-lightboxsocialbuttonfontsize="18" data-lightboxtitlestyle="bottom" data-lightboximagepercentage="75" data-lightboxdefaultvideovolume="1" data-lightboxoverlaybgcolor="#000" data-lightboxoverlayopacity="0.9" data-lightboxbgcolor="#fff" data-lightboxtitleprefix="%NUM / %TOTAL" data-lightboxtitleinsidecss="color:#fff; font-size:16px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left;" data-lightboxdescriptioninsidecss="color:#fff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;" data-triggerresizedelay="100" data-lightboxslideinterval="5000" data-lightboxtimerposition="bottom" data-lightboxtimercolor="#dc572e" data-lightboxtimeropacity="1" data-lightboxbordersize="8" data-lightboxborderradius="0" data-textcss="display:block; padding:12px; text-align:left;" data-textbgcss="display:block; position:absolute; top:0px; left:0px; width:100%; height:100%; background-color:#333333; opacity:0.6; filter:alpha(opacity=60);" data-titlecss="display:block; position:relative; font:bold 14px Georgia,serif,Arial; color:#fff;" data-descriptioncss="display:block; position:relative; font:12px Georgia,serif,Arial; color:#fff; margin-top:8px;" data-buttoncss="display:block; position:relative; margin-top:8px;" data-titlecssresponsive="font-size:12px;" data-descriptioncssresponsive="display:none !important;" data-buttoncssresponsive="" data-jsfolder="http://smartbrain.edu.vn/wp-content/plugins/wonderplugin-slider/engine/" style="display:none;" >
                                <ul class="amazingslider-slides"  style="display:none;">
                                  <li>
                                    <img class="amazingsliderimg" src="images/0I.jpg" alt="Biểu Thức Toán Tư Duy" title="Biểu Thức Toán Tư Duy" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/m-Ng0qCnkLQ"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0II.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/0MiKvjK4bZg?t=312s"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0III.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/XNzKO-JrQ8w"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0IV.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/6LBHSwIVdPE"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0V.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/6geL-a76m1o?t=321s"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0VI.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/3vy3aVHwvnQ?t=35s"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0VII.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/da3i0qTjLFo?t=287s"></video>
                                  </li>
                                </ul>
                                <ul class="amazingslider-thumbnails"  style="display:none;">
                                  <li><img class="amazingsliderthumbnailimg" src="../images/0I.jpg" alt="Biểu Thức Toán Tư Duy" title="Biểu Thức Toán Tư Duy" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="../images/0II.jpg" alt="" title="" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="../images/0III.jpg" alt="" title="" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="../images/0IV.jpg" alt="" title="" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="../images/0V.jpg" alt="" title="" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="../images/0VI.jpg" alt="" title="" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="../images/0VII.jpg" alt="" title="" data-description="" /></li>
                                </ul>
                                <div class="wonderplugin-engine"><a href="http://www.wonderplugin.com/wordpress-slider/" title="Responsive WordPress Image Slideshow Plugin">Responsive WordPress Image Slideshow Plugin</a></div>
                              </div>
                            </div>
                          </td>
                          <td class="phpcode column-phpcode" data-colname="PHP code">
                            &lt;?php echo do_shortcode(&#8216;
                            <div id="amazingslider_customtexteffect_2" style="display:none;">{"Bottom bar":{"textstyle":"static","textpositionstatic":"bottom","textautohide":true,"textpositionmarginstatic":0,"textpositiondynamic":"bottomleft","textpositionmarginleft":24,"textpositionmarginright":24,"textpositionmargintop":24,"textpositionmarginbottom":24,"texteffect":"slide","texteffecteasing":"easeOutCubic","texteffectduration":600,"texteffectslidedirection":"left","texteffectslidedistance":30,"texteffectdelay":500,"texteffectseparate":false,"texteffect1":"slide","texteffectslidedirection1":"right","texteffectslidedistance1":120,"texteffecteasing1":"easeOutCubic","texteffectduration1":600,"texteffectdelay1":1000,"texteffect2":"slide","texteffectslidedirection2":"right","texteffectslidedistance2":120,"texteffecteasing2":"easeOutCubic","texteffectduration2":600,"texteffectdelay2":1500,"textcss":"display:block; padding:12px; text-align:left;","textbgcss":"display:block; position:absolute; top:0px; left:0px; width:100%; height:100%; background-color:#333333; opacity:0.6; filter:alpha(opacity=60);","titlecss":"display:block; position:relative; font:bold 14px Georgia,serif,Arial; color:#fff;","descriptioncss":"display:block; position:relative; font:12px Georgia,serif,Arial; color:#fff; margin-top:8px;","buttoncss":"display:block; position:relative; margin-top:8px;","texteffectresponsive":true,"texteffectresponsivesize":640,"titlecssresponsive":"font-size:12px;","descriptioncssresponsive":"display:none !important;","buttoncssresponsive":"","addgooglefonts":false,"googlefonts":"","textleftrightpercentforstatic":40}}</div>
                            <div class="wonderpluginslider-container" id="wonderpluginslider-container-2" style="max-width:1130px;margin:0 auto;padding-left:0px;padding-right:240px;padding-top:0px;padding-bottom:0px;">
                              <div class="wonderpluginslider" id="wonderpluginslider-2" data-sliderid="2" data-width="1130" data-height="700" data-skin="righttabs" data-autoplay="true" data-randomplay="false" data-loadimageondemand="false" data-transitiononfirstslide="false" data-autoplayvideo="false" data-isresponsive="true" data-fullwidth="false" data-isfullscreen="false" data-ratioresponsive="false" data-showtext="true" data-showtimer="true" data-showbottomshadow="false" data-navshowpreview="false" data-textautohide="true" data-pauseonmouseover="false" data-lightboxresponsive="true" data-lightboxshownavigation="false" data-lightboxshowtitle="true" data-lightboxshowdescription="false" data-texteffectresponsive="true" data-donotinit="false" data-addinitscript="false" data-lightboxfullscreenmode="true" data-lightboxcloseonoverlay="true" data-lightboxvideohidecontrols="false" data-lightboxnogroup="false" data-lightboxshowsocial="false" data-lightboxshowfacebook="true" data-lightboxshowtwitter="true" data-lightboxshowpinterest="true" data-lightboxsocialrotateeffect="true" data-showsocial="false" data-showfacebook="true" data-showtwitter="true" data-showpinterest="true" data-socialrotateeffect="true" data-disableinlinecss="false" data-triggerresize="false" data-lightboxautoslide="false" data-lightboxshowtimer="true" data-lightboxshowplaybutton="true" data-lightboxalwaysshownavarrows="false" data-lightboxshowtitleprefix="true" data-titleusealt="false" data-scalemode="fill" data-arrowstyle="mouseover" data-transition="slice" data-loop="0" data-border="0" data-slideinterval="8000" data-arrowimage="arrows-32-32-0.png" data-arrowwidth="32" data-arrowheight="32" data-arrowtop="50" data-arrowmargin="8" data-navstyle="thumbnails" data-navimage="bullet-24-24-5.png" data-navwidth="70" data-navheight="68" data-navspacing="5" data-navmarginx="16" data-navmarginy="16" data-navposition="right" data-playvideoimage="playvideo-64-64-0.png" data-playvideoimagewidth="64" data-playvideoimageheight="64" data-lightboxthumbwidth="90" data-lightboxthumbheight="60" data-lightboxthumbtopmargin="12" data-lightboxthumbbottommargin="4" data-lightboxbarheight="64" data-lightboxtitlebottomcss="color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;" data-lightboxdescriptionbottomcss="color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;" data-textformat="Bottom bar" data-textpositionstatic="bottom" data-textpositiondynamic="bottomleft" data-paddingleft="0" data-paddingright="240" data-paddingtop="0" data-paddingbottom="0" data-texteffectresponsivesize="640" data-textleftrightpercentforstatic="40" data-fadeduration="1000" data-crossfadeduration="1000" data-slideduration="1000" data-elasticduration="1000" data-sliceduration="1500" data-blindsduration="1500" data-blocksduration="1500" data-shuffleduration="1500" data-tilesduration="2000" data-kenburnsduration="5000" data-flipduration="1500" data-flipwithzoomduration="2000" data-threedduration="1500" data-threedhorizontalduration="1500" data-threedwithzoomduration="2500" data-threedhorizontalwithzoomduration="2200" data-threedflipduration="1500" data-threedflipwithzoomduration="2000" data-threedtilesduration="2000" data-threedfallback="flip" data-threedhorizontalfallback="flip" data-threedwithzoomfallback="flipwithzoom" data-threedhorizontalwithzoomfallback="flipwithzoom" data-threedflipfallback="flip" data-threedflipwithzoomfallback="flipwithzoom" data-threedtilesfallback="tiles" data-ratiomediumscreen="800" data-ratiomediumheight="1.2" data-ratiosmallscreen="480" data-ratiosmallheight="1.6" data-socialmode="mouseover" data-socialposition="position:absolute;top:8px;right:8px;" data-socialpositionsmallscreen="position:absolute;top:8px;right:8px;" data-socialdirection="horizontal" data-socialbuttonsize="32" data-socialbuttonfontsize="18" data-lightboxsocialposition="position:absolute;top:100%;right:0;" data-lightboxsocialpositionsmallscreen="position:absolute;top:100%;right:0;left:0;" data-lightboxsocialdirection="horizontal" data-lightboxsocialbuttonsize="32" data-lightboxsocialbuttonfontsize="18" data-lightboxtitlestyle="bottom" data-lightboximagepercentage="75" data-lightboxdefaultvideovolume="1" data-lightboxoverlaybgcolor="#000" data-lightboxoverlayopacity="0.9" data-lightboxbgcolor="#fff" data-lightboxtitleprefix="%NUM / %TOTAL" data-lightboxtitleinsidecss="color:#fff; font-size:16px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left;" data-lightboxdescriptioninsidecss="color:#fff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;" data-triggerresizedelay="100" data-lightboxslideinterval="5000" data-lightboxtimerposition="bottom" data-lightboxtimercolor="#dc572e" data-lightboxtimeropacity="1" data-lightboxbordersize="8" data-lightboxborderradius="0" data-textcss="display:block; padding:12px; text-align:left;" data-textbgcss="display:block; position:absolute; top:0px; left:0px; width:100%; height:100%; background-color:#333333; opacity:0.6; filter:alpha(opacity=60);" data-titlecss="display:block; position:relative; font:bold 14px Georgia,serif,Arial; color:#fff;" data-descriptioncss="display:block; position:relative; font:12px Georgia,serif,Arial; color:#fff; margin-top:8px;" data-buttoncss="display:block; position:relative; margin-top:8px;" data-titlecssresponsive="font-size:12px;" data-descriptioncssresponsive="display:none !important;" data-buttoncssresponsive="" data-jsfolder="http://smartbrain.edu.vn/wp-content/plugins/wonderplugin-slider/engine/" style="display:none;" >
                                <ul class="amazingslider-slides"  style="display:none;">
                                  <li>
                                    <img class="amazingsliderimg" src="images/0I.jpg" alt="Biểu Thức Toán Tư Duy" title="Biểu Thức Toán Tư Duy" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/m-Ng0qCnkLQ"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0II.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/0MiKvjK4bZg?t=312s"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0III.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/XNzKO-JrQ8w"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0IV.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/6LBHSwIVdPE"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0V.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/6geL-a76m1o?t=321s"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0VI.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/3vy3aVHwvnQ?t=35s"></video>
                                  </li>
                                  <li>
                                    <img class="amazingsliderimg" src="images/0VII.jpg" alt="" title="" data-description="" />
                                    <video preload="none" src="https://www.youtube.com/embed/da3i0qTjLFo?t=287s"></video>
                                  </li>
                                </ul>
                                <ul class="amazingslider-thumbnails"  style="display:none;">
                                  <li><img class="amazingsliderthumbnailimg" src="images/0I.jpg" alt="Biểu Thức Toán Tư Duy" title="Biểu Thức Toán Tư Duy" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="images/0II.jpg" alt="" title="" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="images/0III.jpg" alt="" title="" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="images/0IV.jpg" alt="" title="" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="images/0V.jpg" alt="" title="" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="images/0VI.jpg" alt="" title="" data-description="" /></li>
                                  <li><img class="amazingsliderthumbnailimg" src="images/0VII.jpg" alt="" title="" data-description="" /></li>
                                </ul>
                                <div class="wonderplugin-engine"><a href="http://www.wonderplugin.com/wordpress-slider/" title="Responsive WordPress Image Slideshow Plugin">Responsive WordPress Image Slideshow Plugin</a></div>
                              </div>
                            </div>
                            &#8216;); ?&gt;
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- .col-inner -->
                </div>
                <!-- .large-12 -->
              </div>
              <!-- .row -->
            </div>
          </main>
<?php include TPL_DIR . '/_footer.tpl.php'; ?>
