				<div id="banner">
					<div class="container">
						<div class="row">
							<div class="12u">
								<div style="border:solid 1px #A60000; font-size:1.0em; padding:0px 5px; color:#a0a8ab; ">
								Attention, ce site n'est plus maintenu à jour autant qu'il devrait l'être... Mon <a style="color:#BF3730;" href="http://365.phantase.com">projet 365</a> me fait un peu délaisser cette partie. Vous pouvez retrouver les dernières photos sur le site du <a style="color:#BF3730;" href="http://365.phantase.com">projet 365</a> et les séries complètes sur mon <a style="color:#BF3730;" href="https://www.flickr.com/phantase/">Flickr</a>.
								</div>
							</div>
						</div>
						<div class="row">
							<div class="12u">
								<!-- Banner List Slider -->
								<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 1200px; height: 300px; background: #000; overflow: hidden; border: solid white; ">

									<!-- Loading Screen -->
									<div u="loading" style="position: absolute; top: 0px; left: 0px;">
										<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
											background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
										</div>
										<div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
											top: 0px; left: 0px;width: 100%;height:100%;">
										</div>
									</div>

									<!-- Slides Container -->
									<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 900px; height: 300px;
										overflow: hidden;">
							<?php
							foreach($articles as $article)
							{
							?>
										<div>
											<img u="image" src="https://cdn.phantase.net/article/<?php echo $article['article_html']; ?>_slide.jpg" />
											<div u="thumb">
												<img class="i" src="https://cdn.phantase.net/article/<?php echo $article['article_html']; ?>_thumb.jpg" />
												<div class="t"><?php echo $article['article_titre']; ?></div>
												<div class="c"><?php echo $article['article_accroche']; ?></div>
											</div>
										</div>
							<?php
							}
							?>
									</div>
									
									<!-- ThumbnailNavigator Skin Begin -->
									<div u="thumbnavigator" class="jssort11" style="position: absolute; width: 300px; height: 300px; left:900px; top:0px;">
										<!-- Thumbnail Item Skin Begin -->
										<style>
											/* jssor slider thumbnail navigator skin 11 css */
											/*
											.jssort11 .p            (normal)
											.jssort11 .p:hover      (normal mouseover)
											.jssort11 .pav          (active)
											.jssort11 .pav:hover    (active mouseover)
											.jssort11 .pdn          (mousedown)
											*/
											.jssort11
											{
												font-family: Arial, Helvetica, sans-serif;
											}
											.jssort11 .i, .jssort11 .pav:hover .i
											{
												position: absolute;
												top:13px;
												left:3px;
												WIDTH: 112px;
												HEIGHT: 75px;
												border: white 1px dashed;
											}
											* html .jssort11 .i
											{
												WIDTH /**/: 114px;
												HEIGHT /**/: 80px;
											}
											.jssort11 .pav .i
											{
												border: white 1px solid;
											}
											.jssort11 .t, .jssort11 .pav:hover .t
											{
												position: absolute;
												top: 3px;
												left: 120px;
												width:180px;
												height: 20px;
												line-height:22px;
												text-align: left;
												color:#fc9835;
												font-size:13px;
												font-weight:700;
												white-space: nowrap;
											}
											.jssort11 .pav .t, .jssort11 .phv .t, .jssort11 .p:hover .t
											{
												color:#fff;
											}
											.jssort11 .c, .jssort11 .pav:hover .c
											{
												position: absolute;
												top: 30px;
												left: 120px;
												width:180px;
												height: 70px;
												line-height:11px;
												color:#fff;
												font-size:11px;
												font-weight:400;
												overflow: hidden;
											}
											.jssort11 .pav .c, .jssort11 .phv .c, .jssort11 .p:hover .c
											{
												color:#fc9835;
											}
											.jssort11 .t, .jssort11 .c
											{
												transition: color 2s;
												-moz-transition: color 2s;
												-webkit-transition: color 2s;
												-o-transition: color 2s;
											}
											.jssort11 .p:hover .t, .jssort11 .phv .t, .jssort11 .pav:hover .t, .jssort11 .p:hover .c, .jssort11 .phv .c, .jssort11 .pav:hover .c
											{
												transition: none;
												-moz-transition: none;
												-webkit-transition: none;
												-o-transition: none;
											}
											.jssort11 .p
											{
												background:#181818;
											}
											.jssort11 .pav, .jssort11 .pdn
											{
												background:#462300;
											}
											.jssort11 .p:hover, .jssort11 .phv, .jssort11 .pav:hover
											{
												background:#333;
											}
										</style>
										<div u="slides" style="cursor: move;">
											<div u="prototype" class="p" style="position: absolute; width: 300px; height: 100px; top: 0; left: 0;">
												<thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></thumbnailtemplate>
											</div>
										</div>
										<!-- Thumbnail Item Skin End -->
									</div>
									<!-- ThumbnailNavigator Skin End -->
									<a style="display: none" href="http://www.jssor.com">image carousel</a>
								</div>
								<!-- Jssor Slider End -->
							</div>
						</div>
					</div>
				</div>
