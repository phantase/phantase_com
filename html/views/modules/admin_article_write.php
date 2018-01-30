		<!-- Content -->
			<div id="content-wrapper">
				<div id="content">
					<div class="container">
						<div class="row">
							<div class="12u">
							
								<!-- Main Content -->
									<section class="article">
										<header>
											<form>
												<input id="article_id" name="article_id" type="hidden" value="<?php echo $articleObj['article_id']; ?>" />
												<input id="article_html" name="article_html" type="hidden" value="<?php echo $articleObj['article_html']; ?>" />
												<input id="article_base_write_url" name="article_base_write_url" type="hidden" value="<?php echo $article_base_write_url; ?>" />
												<table class="article_meta">
													<tr>
														<td width="12%"><h1>Titre : </h1></td>
														<td colspan="2"><input id="article_titre" name="article_titre" type="text" value="<?php echo $articleObj['article_titre']; ?>" /></td>
														<td width="12%" class="article_savemeta">
															<img id="saveMeta" src="css/images/save.png" alt="Sauvegarder les métadonnées" title="Sauvegarder les métadonnées" />
														</td>
													</tr>
													<tr>
														<td><h3>Lien html : </h3></td>
														<td colspan="2"><input id="article_html" name="article_html" type="text" value="<?php echo $articleObj['article_html']; ?>" /></td>
														<td class="article_savemeta">
															<p id="saveResult" style="display:none;"></p>
														</td>
													</tr>
													<tr>
														<td><h3 class="article_meta">Par Phantase</h3></td>
														<td><h3 class="article_meta">Publié le : <?php echo $articleObj['article_date_publie_fr']; ?>  <img src="css/images/icon_calendar.png" width="16px" /></h3></td>
														<td><h3 class="article_meta">Classé dans :  <img src="css/images/icon_category.png" width="16px" /></h3></td>
														<td><h3 class="article_meta">Pages : 
															<select id="selectedPage" name="selectedPage">
<?php for( $i = 1 ; $i <= $articleObj['article_nbpages']; $i++ ){ ?>
																<option value="<?php echo $i; ?>" <?php echo ($i==$page)?'selected':''; ?>><?php echo $i; ?></option>
<?php } ?>
															</select>
															&nbsp;/&nbsp;<span id="nbPages"><?php echo $articleObj['article_nbpages']; ?></span>
															<img id="icon_plus_page" src="css/images/icon_plus_32.png" alt="Ajouter une page" title="Ajouter une page" />
															</h3></td>
													</tr>
													<tr>
														<td><h3>Accroche : </h3></td>
														<td colspan="3">
															<textarea name="article_accroche" id="article_accroche" rows="1"><?php echo $articleObj['article_accroche']; ?></textarea>
														</td>
													</tr>
												</table>
											</form>
										</header>
<?php if( isset($pageObj) ){ ?>
										<h2>Page <?php echo $page; ?></h2>
										<form>
											<input id="page_id" name="page_id" type="hidden" value="<?php echo $pageObj['page_id']; ?>" />
											<textarea name="contentPage" id="contentPage" rows="50" cols="80"><?php echo $pageObj['page_content']; ?></textarea>
										</form>
<?php } ?>
									</section>

							</div>
						</div>
					</div>
				</div>
			</div>