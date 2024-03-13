<div class="marque">

</div>
<footer class="site-footer mt-5 mb-0" style="bottom: 0px">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h3>A Propos de nous</h3>
				<p> <?= WEB_SITE_NAME ?> est l'Assurance de la vente en ligne. Nous disposons d'un large choix de produits au prix étonament Abordable.  <?= WEB_SITE_NAME ?> travaille avec les plus grandes marques qui lui font entièrement confiance dans la construction de ce sentier que doit désormais  suivre la concurrence.</p>
			</div>
			<div class="col-lg-3 mx-auto">
				<h3>Navigation</h3>
				<ul class="list-unstyled">
					<li><a href="index.php">Accueil</a></li>
					<li><a href="#" data-toggle="modal" data-target="#modalCart">Panier<span class="badge"></span></a>
					<li><a href="#" data-toggle="modal" data-target="#modal_rechercher">Rechercher</a>
					</li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</div>
			<div class="col-lg-4">
				<h3>Subscribe</h3>
				<p>Veillez nous fournir votre adresse mail pour n'est plus raté les nouvelles articles</p>
				<form action="#" class="form-subscribe">
					<input type="email" class="form-control mb-3" placeholder="Entrer Email">
					<input type="submit" class="btn btn-primary" value="Subscribe">
				</form>
			</div>
		</div>

		<div class="row pt-5 mt-5 text-center">
			<div class="col-md-12">
				<p>
					Copyright &copy; <?= WEB_SITE_NAME ?> <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script>  

				</p>
			</div>

		</div>
	</div>
</footer>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>

<script src="js/mediaelement-and-player.min.js"></script>

<script>
	/*document.addEventListener('DOMContentLoaded', function() {
		var mediaElements = document.querySelectorAll('video, audio'), total = mediaElements.length;

		for (var i = 0; i < total; i++) {
			new MediaElementPlayer(mediaElements[i], {
				pluginPath: 'https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/',
				shimScriptAccess: 'always',
				success: function () {
					var target = document.body.querySelectorAll('.player'), targetTotal = target.length;
					for (var j = 0; j < targetTotal; j++) {
						target[j].style.visibility = 'visible';
					}
				}
			});
		}
	});*/
	$('.carousel').carousel({
	  interval: 5000
	})

</script>


<script src="js/main.js"></script>
<script src="main.js"></script>
<script src="js/share.js"></script>

</body>
</html>

