					<div class="container pageblock">
						<div class="pagination">
							<?php if( $page == 1 ){ ?>
							<span class="previous-off">« Précédent</span>
							<?php } else { ?>
							<span class="previous"><a href="<?php echo $prefix; ?><?php echo $page-1; ?>/">« Précédent</a></span>
							<?php } ?>
							
							<?php for( $i=1; $i<=$pages; $i++ ){ ?>
								<?php if( $page == $i ){ ?>
								<span class="active"><?php echo $i; ?></span>
								<?php } else { ?>
								<span><a href="<?php echo $prefix; ?><?php echo $i; ?>/"><?php echo $i; ?></a></span>
								<?php } ?>
							<?php } ?>
							
							<?php if( $page == $pages ){ ?>
							<span class="next-off">Suivant »</span>
							<?php } else { ?>
							<span class="next"><a href="<?php echo $prefix; ?><?php echo $page+1; ?>/">Suivant »</a></span>
							<?php } ?>
						</div>
<?php if( isset($numberOfArticles) ) { ?>
						<div>(<?php echo $numberOfArticles; ?> articles)</div>
<?php } ?>
					</div>