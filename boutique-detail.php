<?php include_once('header.php'); ?>
<?php include_once 'form_recherche.php'; ?>
    <div class="container-fluid play-wrap  mt-1">

        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-12 text-center">
                        <h2 class="font-weight-bold text-black">Acceuil > Boutique</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="featured-user  mb-5 mb-lg-0">
                            <h3 class="mb-4">Categorie</h3>
                            <ul class="list-unstyled" id="get_category">
                            
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9" id="getProductDet">
                        <div class="d-block podcast-entry bg-white mb-5" data-aos="fade-up" id="">
                                
                            <?php
                                // Fonction pour récupérer les produits d'une boutique depuis la base de données
                                function fetchProductsInShopFromDatabase($shopId) {
                                    // Connexion à la base de données (à remplacer avec tes paramètres de connexion)
                                    $db_host = 'localhost';
                                    $db_name = 'wemi_project_db';
                                    $db_user = 'root';
                                    $db_pass = '';
                                    
                                    try {
                                        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        
                                        // Requête pour récupérer les produits de la boutique
                                        $query = "SELECT * FROM view_sure WHERE shop_id = :shop_id ORDER BY product_id DESC ";
                                        $stmt = $conn->prepare($query);
                                        $stmt->bindParam(':shop_id', $shopId);
                                        $stmt->execute();
                                        
                                        // Récupérer les résultats
                                        $productsInShop = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        
                                        // Fermer la connexion
                                        $conn = null;
                                        
                                        return $productsInShop;
                                    } catch(PDOException $e) {
                                        echo "Erreur: " . $e->getMessage();
                                    }
                                }
                            ?>
                            
                            <?php
                                // Récupérer l'identifiant du produit depuis l'URL
                                $prodId = isset($_GET['product_id']) ? $_GET['product_id'] : null;

                                // Récupérer l'identifiant de la boutique depuis l'URL
                                $shopId = isset($_GET['product_shop']) ? $_GET['product_shop'] : null;

                                // Récupérer les produits de la boutique depuis la base de données
                                $productsInShop = fetchProductsInShopFromDatabase($shopId); // Fonction à implémenter

                                // Afficher les produits de la boutique
                                echo "<h1>Produits dans la Boutique N°".$_GET['product_shop']." </h1>";

                                foreach ($productsInShop as $product) {
                                    echo "
                                            <a href='".BASE_URL."wemi_project/boutique-detail.php?product_shop=". $product['product_shop'] ."' >
                                                <div class='d-block d-md-flex podcast-entry bg-white mb-5' data-aos='fade-up'>
                                                    
                                                        <!--<a href='".BASE_URL."wemi_project/boutique-detail.php?product_id=". $product['product_id'] ."'>-->
                                                            <div class='image' style='background-image: url(\"product_images/". $product['product_image'] ."\"); ' ><a href='".BASE_URL."wemi_project/get_product_details.php?product_id=". $product['product_id'] ."' style=''  class='voir-produit-btn btn-success btn-xs'><i class='bi bi-eye'></i></a>
                                                            </div>
                                                        <!--</a>-->
                                                    
                                                    <div class='text'>
                                                        <div class='player'>
                                                            <h4>".$product['shop_title']."</h4>
                                                        </div>
                                                        <h3 class='font-weight-light'>". $product['product_title'] ."</h3>
                                                            <div class='text-white mb-3'>

                                                                <span class='text-black-opacity-05'><small>". $product['cat_title'] ." <span class='sep'>/</span>". $product['brand_title'] ."<span class='sep'></span></small></span>
                                                            </div>
                                                            <div class='player'>
                                                                <h4>".CURRENCY."".$product['product_price']." .00</h4>
                                                            </div>
                                                            <div class='text-black-opacity-05 mb-3'>
                                                                <h4><span class='fa fa-loc'>Trouver-nous au(à) ".$product['shop_address']."</span></h4>

                                                            </div>
                                                            <div class='text-black-opacity-05 mb-3'>
                                                                <a href='#'><h4><span class='fa fa-phone'> ".$product['shop_contact_1']."</span></h4></a>
                                                                <a href='#'><h4><span class='fa fa-whatsapp'> ".$product['shop_contact_2']."</span></h4></a>

                                                            </div>
                                                            <div class='player'>
                                                                <button pid='".$product['product_id']."' style='float:right;' id='product' class='btn btn-danger btn-xs' ><i class='bi bi-shop'></i> Ajouter au panier</button>
                                                                 
                                                               
                                                            </div>
                                                    </div>
                                                </div>
                                            </a>";


                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once 'footer.php'; ?> 

