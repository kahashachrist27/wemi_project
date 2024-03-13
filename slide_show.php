<?php include_once 'header.php'; ?>
<?php include_once 'carousel.php'; ?>
<?php include_once 'form_recherche.php'; ?>

</header>
<!-- <hr> -->
<?php  
		$host = 'localhost';
		$dbname = 'wemi_project_db';
		$user = 'root';
		$password = '';

		try {
		    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
		    die("Erreur de connexion à la base de données: " . $e->getMessage());
		}
		// Fonction pour récupérer les products les plus visités de la semaine
		  	function fetchMostVisitedProductsFromDatabase() {
		      	global $pdo;
		      	$startDate = date('Y-m-d', strtotime('-7 days'));
		      	$endDate = date('Y-m-d');
		      	$stmt = $pdo->prepare("SELECT t_visits.product_id, COUNT(t_visits.product_id) as visit_count, products.product_title, products.product_image FROM t_visits INNER JOIN products ON products.product_id = t_visits.product_id WHERE visit_date BETWEEN ? AND ?  GROUP BY product_id ORDER BY visit_count DESC LIMIT 3");
		      	$stmt->execute([$startDate, $endDate]);
		      	return $stmt->fetchAll(PDO::FETCH_ASSOC);
		  	}
		  	

		  	// Récupérer les products les plus visités de la semaine
		 	$mostVisitedProducts = fetchMostVisitedProductsFromDatabase();
		?>
<div class="site-section"  >
	<div class="container">

		<div class="row">
			<div class="col-lg-3">
				<div class="featured-user  mb-5 mb-lg-0">
					<h3 class="mb-4">Categorie</h3>
					<ul class="list-unstyled" id="get_category">
					
						
					</ul>
				</div>
			</div>

			<div class="col-lg-9" id="">
				<div class="d-block d-md-flex podcast-entry bg-white mb-5" data-aos="fade-up" id="">
                    <!-- Assurez-vous d'inclure jQuery avant tout autre script jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Assurez-vous d'inclure le script jQuery Slick avant l'initialisation du carrousel -->
<script type="text/javascript" src="slick/slick.min.js"></script>
<div class="slideshow">
    <?php foreach ($mostVisitedProducts as $product): ?>
        <div class="slide">
            <h2>Produit : <?php echo $product['product_title']; ?></h2>
            <?php $product_image = "product_images/" . $product['product_image']; ?>
            <div class="flex image" style="background-image: url('<?php echo $product_image; ?>');">
                <div class="card-body mb-lg-6">
                    <!-- Contenu additionnel si nécessaire -->
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    // Assurez-vous que le document est prêt avant d'initialiser le carrousel
    $(document).ready(function(){
        // Initialiser le carrousel avec la classe .slideshow
        $('.slideshow').slick({
            autoplay: true,
            autoplaySpeed: 3000,
            dots: true,
            arrows: false,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    });
</script>



				</div>
			</div>
		</div>
		
	</div>
</div>

<?php include_once 'footer.php'; ?>	
