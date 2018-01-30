		<!-- Content -->
			<div id="content-wrapper">
				<div id="content">
					<div class="container">
						<div class="row">
							<div class="12u">
							
								<!-- Main Content -->
									<section class="article">
										<header>
											<h1><?php echo $articleObj['article_titre']; ?></h1>
											<h3 class="article_meta">Par Phantase - <?php echo $articleObj['article_date_publie_fr']; ?> - Classé dans : <?php include_once('controllers/article_categories.php'); ?><?php include_once('views/modules/warning_pages.php'); ?></h3>
										</header>
										<?php echo $pageObj['page_content']; ?>
<?php 
$prefix = $articleObj['article_date_publie_html']."/".$articleObj['article_html']."/";
if( $pages > 1 )
include_once('views/modules/pagination.php');
?>
									</section>

							</div>
						</div>
					</div>
				</div>
			</div>