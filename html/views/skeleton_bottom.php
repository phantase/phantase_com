		<!-- Footer -->
			<div id="footer-wrapper">
				<footer id="footer" class="container">
					<div class="row">
						<div class="8u">
						
							<!-- Links -->
								<section>
									<h2>A découvrir aussi</h2>
									<div>
										<div class="row">
											<!--<div class="3u">
												<ul class="link-list last-child">
													<li><a href="http://figs.phantase.com">Mon site de Figurines</a></li>
												</ul>
											</div>-->
											<div class="3u">
												<ul class="link-list last-child">
													<li><a href="http://www.flickr.com/phantase/">Retrouvez moi sur Flickr</a></li>
												</ul>
											</div>
											<div class="3u">
												<ul class="link-list last-child">
													<li><a href="http://www.twitter.com/phantakun">Retrouvez moi sur Twitter</a></li>
												</ul>
											</div>
											<div class="3u">
												<ul class="link-list last-child">
<?php if( isLogged() ) { ?>
													<li><a id="logout" href="#">Se déconnecter</a> (<?php echo $_SESSION['username']; ?>)</li>
<?php } else { ?>
													<li><a href="login/">Se connecter</a></li>
<?php } ?>
												</ul>
											</div>
										</div>
										<div class="row">
											<span>Utilise des choses en provenance de :</span>
											<a href="http://html5up.net">HTML5 UP</a>
											<a href="http://jquery.com/">JQUERY</a>
											<a href="http://jssor.com">Jssor Slider</a>
											<a href="http://osvaldas.info/image-lightbox-responsive-touch-friendly">Image Lightbox</a>.
										</div>
									</div>
								</section>

						</div>
						<div class="4u">
							
							<!-- Blurb -->
								<section>
									<h2>Information sur ce site</h2>
									<p>
										Toutes les photos sur ce site ont été prises par mes soins et sont ma propriété.
										Merci de ne pas les réutiliser sans m'en demander l'autorisation.
									</p>
								</section>
						
						</div>
					</div>
				</footer>
			</div>

		<!-- Copyright -->
			<div id="copyright">
				&copy; Phantase. Tous droits réservés.
			</div>

<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//stats.phantase.com/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '3']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->

	</body>
</html>