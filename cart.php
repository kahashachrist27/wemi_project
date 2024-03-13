
<?php include_once 'header.php'; ?>

<div class="site-section">
	<div class="container">

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

			<div class="col-lg-11 m-auto mb-3">
				<div class="row">
					<!-- <div class="col-md-2"></div> -->
					<div class="col-md-10">
						<div class="card card-primary mb-3">
							<div class="card-header">Paiement du panier en <?php echo CURRENCY; ?></div>
							<div class="card-body">
								<!-- <div class="row">
									<div class="col-md-2 col-xs-2"><b>Action</b></div>
									<div class="col-md-2 col-xs-2"><b>Image</b></div>
									<div class="col-md-2 col-xs-2"><b>Nom</b></div>
									<div class="col-md-2 col-xs-2"><b>Quantité</b></div>
									<div class="col-md-2 col-xs-2"><b>Prix du produit</b></div>
									<div class="col-md-2 col-xs-2"><b>Prix en <?php echo CURRENCY; ?></b></div>
								</div>
								<div id="cart_checkout"></div> -->
								<div class="table-responsive">
									<table class="table table-striped table-hover">
									  <thead>
									    <tr>
									      <!-- <th scope="col">#</th> -->
									      <th scope="col">Action</th>
									      <th scope="col">Image</th>
									      <th scope="col">Nom</th>
									      <th scope="col">Quantité</th>
									      <th scope="col">Prix</th>
									      <th scope="col">Total</th>
									    </tr>
									  </thead>
									  <tbody id="cart_checkout">
									    <!-- <tr>
									      <th scope="row">1</th>
									      <td>Mark</td>
									      <td>Otto</td>
									      <td>@mdo</td>
									    </tr> -->
									    
									  </tbody>
									</table>

								</div> 
							</div> 
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
<?php include_once 'footer.php'; ?>	
