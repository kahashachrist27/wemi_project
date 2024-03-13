
<?php include_once 'header.php'; ?>
<?php include_once 'form_recherche.php'; ?>
<div class="site-section">
	<div class="container">
		<div class="row mb-3">
			<div class="col-12 text-center">
				<h3>Recherche  <?= isset($_GET['s'])? 'de '.$_GET['s'] : 'vide' ?></h3>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3" style="display: none">
				<div class="featured-user  mb-5 mb-lg-0">
					<h3 class="mb-4">Categorie</h3>
					<ul class="list-unstyled" id="get_category">
						<!--<li>
							<a href="#" class="d-flex align-items-center">
								<img src="images/person_1.jpg" alt="Image" class="img-fluid mr-2">
								<div class="podcaster">
									<span class="d-block">Claire Stanford</span>
									<span class="small">32,420 podcasts</span>
								</div>
							</a>
						</li>   DMK-->
						
					</ul>
				</div>
			</div>

			<div class="col-lg-9 m-auto" id="get_product_search">
				
			</div>
		</div>
	</div>
	
<?php include_once 'footer.php'; ?>	