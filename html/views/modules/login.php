		<!-- Content -->
			<div id="content-wrapper">
				<div id="content">
					<div class="container">
						<div class="row">
							<div class="12u">
							
								<!-- Main Content -->
									<section>
										<header>
											<h2>Page de connexion</h2>
<?php if( isset( $_SESSION['userid'] ) && $_SESSION['userid'] == 1 ) { ?>
											<h3>Vous êtes déjà identifié.</h3>
<?php } else { ?>
											<h3>Veuillez vous identifier avant de continuer.</h3>
<?php } ?>
										</header>
<?php if( isset( $_SESSION['userid'] ) && $_SESSION['userid'] == 1 ) { ?>
										<p>Pour vous déconnecter, utilisez le lien en bas du site.</p>
<?php } else { ?>
										<form>
											<table class="mytable">
												<tr>
													<td colspan="2"><h3 class="as_login_heading">Connexion</h3></td>
												</tr>
												<tr>
													<td colspan="2"><div class="login_result" id="login_result"></div></td>
												</tr>
												<tr>
													<td>Utilisateur</td>
													<td><input type="text" name="username" id="username" class="as_input" /></td>
												</tr>
												<tr>
													<td>Mot de passe</td>
													<td><input type="password" name="password" id="password" class="as_input" /></td>
												</tr>
												<tr>
													<td></td>
												</tr>
												<tr>
													<td colspan="2"><input type="submit" name="login" id="login" class="as_button" value="Connexion &raquo;" /></td>
												</tr>
											</table>
										</form>
<?php } ?>
									</section>

							</div>
						</div>
					</div>
				</div>
			</div>