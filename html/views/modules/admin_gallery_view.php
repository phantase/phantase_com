		<!-- Content -->
			<div id="content-wrapper">
				<div id="content">
					<div class="container">
						<div class="row">
							<div class="12u">
							
								<!-- Main Content -->
									<section>
										<header>
											<h2>Galleries - Administration</h2>
											<h3>Visualisation de : <span id="gallerydir"><?php echo $gallery; ?></span></h3>
										</header>
										<div class="gallery_view">
<?php
foreach($galleryObj as $image)
{
?>
											<img src="https://cdn.phantase.net/gallery/<?php echo $gallery; ?>/thumbs/thumbs_<?php echo $image['name']; ?>" id="<?php echo $image['name']; ?>" />
<?php
}
?>
										</div>
										<div class="gallery_actions">
											Sélection : <a id="gallery_action_select_none">Aucun</a> - <a id="gallery_action_select_all">Tous</a> - <a id="gallery_action_select_invert">Inverse</a> <br/>
											<a id="gallery_action_generate_gallery">Générer le code pour une gallerie</a> <i>(Sélectionnez des images pour obtenir une gallerie avec seulement celles-ci)</i><br/>
											<a id="gallery_action_generate_singlepic">Générer le code pour une (des) image(s) séparée(s)</a> <i>(Sélectionnez une (des) image(s) avant)</i><br/>
										</div>
										<div class="gallery_output">
											<textarea id="generated_code"></textarea>
										</div>
									</section>

							</div>
						</div>
					</div>
				</div>
			</div>