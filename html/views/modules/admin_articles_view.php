		<!-- Content -->
			<div id="content-wrapper">
				<div id="content">
					<div class="container">
						<div class="row">
							<div class="12u">
							
								<!-- Main Content -->
									<section>
										<header>
											<h2>Voir les articles - Administration</h2>
											<h3>Ici, vous pouvez gérer vos articles déjà publiés ou en cours d'écriture...</h3>
										</header>
										<table class="articles_view">
											<tr>
												<th>Identifiant</th>
												<th>Titre</th>
												<th>Date de publication</th>
												<th>Date de modification</th>
												<th>Pages</th>
												<th colspan="2">Etat</th>
												<th colspan="2">Action sur l'article</th>
											</tr>
<?php
foreach($articles as $article)
{
?>
<?php
if( $article['article_publie'] == 1 ){
?>
											<tr class="published">
<?php
} else {
?>
											<tr class="unpublished">
<?php
}
?>
												<td><?php echo $article['article_id']; ?></td>
												<td><?php echo $article['article_titre']; ?></td>
												<td><?php echo $article['article_date_publie_fr']; ?></td>
												<td><?php echo $article['article_date_modifie_fr']; ?></td>
												<td><?php echo $article['article_nbpages']; ?></td>
<?php
if( $article['article_publie'] == 1 ){
?>
												<td><img src="css/images/icon_visible.png" alt="Publié" title="Publié" /></td>
<?php
} else {
?>
												<td><img src="css/images/icon_invisible.png" alt="Non publié" title="Non publié" /></td>
<?php
}
?>
<?php
if( $article['article_promu'] == 1 ){
?>
												<td><img src="css/images/icon_promoted.png" alt="Promu" title="Promu" /></td>
<?php
} else {
?>
												<td><img src="css/images/icon_notpromoted.png" alt="Non promu" title="Non promu" /></td>
<?php
}
?>
												<td><a href="./write/<?php echo $article['article_date_publie_html']; ?>/<?php echo $article['article_html']; ?>/"><img src="css/images/icon_write.png" alt="Modifier" title="Modifier" /></a></td>
												<td><a href="./delete/<?php echo $article['article_date_publie_html']; ?>/<?php echo $article['article_html']; ?>/"><img src="css/images/icon_delete.png" alt="Supprimer" title="Supprimer" /></a></td>
											</tr>
<?php
}
?>
										</table>
									</section>

							</div>
						</div>
					</div>
				</div>
			</div>