		<!-- Features -->
			<div id="features-wrapper">
				<div id="features">
					<div class="container">
						<div class="row">
<?php
$cpt = 0;
foreach($articles as $article)
{
	$cpt++;
	if( $cpt == 5 ){
		$cpt = 1;
?>
						</div>
						<div class="row">
<?php
	}
?>

							<div class="3u">
							
								<!-- Feature <?php echo $article['article_id']; ?> -->
									<section>
										<a href="<?php echo $article['article_date_publie_html']; ?>/<?php echo $article['article_html']; ?>/" class="bordered-feature-image">
											<img src="cover/<?php echo $article['article_date_publie_html']; ?>/<?php echo $article['article_html']; ?>.jpg" alt="<?php echo $article['article_titre']; ?>" title="<?php echo $article['article_titre']; ?>" />
											<div><?php echo $article['article_date_publie_fr']; ?></div>
										</a>
										<h2><a href="<?php echo $article['article_date_publie_html']; ?>/<?php echo $article['article_html']; ?>/"><?php echo $article['article_titre']; ?></a></h2>
										<p class="article-paragraph">
											<?php echo $article['article_accroche']; ?>
										</p>
									</section>

							</div>
							
<?php
}
?>
						</div>
					</div>
					
<?php 
$prefix = (isset($category))? "./category/".$category."/page/":"./page/";
include_once('views/modules/pagination.php');
?>

				</div>
			</div>