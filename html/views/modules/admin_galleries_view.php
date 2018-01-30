		<!-- Content -->
			<div id="content-wrapper">
				<div id="content">
					<div class="container">
						<div class="row">
							<div class="12u">
							
								<!-- Main Content -->
									<section>
										<header>
											<h2>Voir les galleries - Administration</h2>
											<h3>Ici, vous pouvez gérer vos galleries</h3>
										</header>
										<table class="galleries_view">
											<tr>
												<th>Identifiant</th>
												<th>Taille</th>
												<th>Voir...</th>
											</tr>
<?php
foreach($galleries as $gallery)
{
?>
											<tr>
												<td class="gallery_dir"><?php echo $gallery['dir']; ?></td>
												<td class="gallery_size"><?php echo $gallery['size']; ?></td>
												<td class="gallery_action"><a href="./admin/gallery/<?php echo $gallery['dir']; ?>/"><img src="css/images/view.png" alt="Voir..." title="Voir.." /></a></td>
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