<?php include_once 'header.php'; ?>
<?php// include_once 'carousel.php'; ?>
<?php include_once 'form_recherche.php'; ?>
</header>
<!-- <hr> -->

<div class="site-section"  >
    <div class="container">

        <div class="row">
            <!--<div class="col-lg-3">
                <div class="featured-user  mb-5 mb-lg-0">
                    <h3 class="mb-4">Categorie</h3>
                    <ul class="list-unstyled" id="get_category">
                    
                        
                    </ul>
                </div>
            </div>-->

            <div class="col-lg-12" id="">
                <div class="d-block d-md-flex podcast-entry bg-white mb-5" data-aos="fade-up" id="">
                    <div class="slideshow">
                        <h2 class="font-weight-bold text-black text-center"><i class="bi bi-heart color-danger"> voici les produits les plus vues de la semaine</i> </h2>
                        
                    <?php
                        // Connexion à la base de données
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "wemi_project_db";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Vérifier la connexion
                        if ($conn->connect_error) {
                            die("Échec de la connexion : " . $conn->connect_error);
                        }

                        // Définir l'intervalle de temps
                        $start_date = '2024-01-01';
                        $end_date = '2024-01-31';

                        // Requête SQL pour récupérer les 5 produits les plus visités dans l'intervalle de temps donné
                        $sql = "SELECT t_visits.product_id, COUNT(t_visits.product_id) as visit_count, products.product_title, products.product_image 
                                FROM t_visits 
                                INNER JOIN products ON products.product_id = t_visits.product_id 
                                WHERE visit_date BETWEEN '2024-01-01' AND '2024-12-01' AND action = 'view'
                                GROUP BY product_id 
                                ORDER BY visit_count DESC 
                                LIMIT 5;
                                ";

                        $result = $conn->query($sql);

                        // Vérifier si la requête a été exécutée avec succès
                        if ($result) {
                            // Afficher les images dans le carousel
                            if ($result->num_rows > 0) {
                                echo '<html>';
                                echo '<head>';
                        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">';
                                echo '<style>';
                                echo '.carousel-item img {';
                                echo '    width: 100%;'; 
                                echo '    height: auto;'; 
                                echo '}';
                                echo '</style>';
                                echo '</head>';
                                echo '<body>';
                                echo '<div class="carousel">';
                                echo '<div class="carousel-inner">';
                                $active = true;

                                // Récupérez l'ID du produit depuis la requête AJAX
                                $productId = isset($_POST['product_id']);

                                // Récupérer l'identifiant de la boutique depuis l'URL
                                $shopId = isset($_POST['product_shop']) ;

                                // Récupérer les produits de la boutique depuis la base de données
                                //$productsInShop = result($shopId); // Fonction à implémenter

                                while ($row = $result->fetch_assoc()) {
                                    $image = $row['product_image'];
                                    // Utiliser $image pour afficher l'image dans votre carousel
                                    echo '<div class="carousel-item' . ($active ? ' active' : '') . '">';
                                    echo"<a href='".BASE_URL."wemi_project/boutique-detail.php?product_shop=".$productId."' ><i class='bi bi-eye'><img src='product_images/" . $image . "' alt='Product Image'></i></a>
                                    ";
                                    echo '';
                                    echo '</div>';
                                    $active = false;
                                }
                                echo '</div>';
                                echo '</div>';
                                echo '</body>';
                                echo '</html>';
                            } else {
                                echo "Aucun résultat trouvé.";
                            }
                        } else {
                            echo "Erreur lors de l'exécution de la requête : " . $conn->error;
                        }

                        // Fermer la connexion à la base de données
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php include_once 'footer.php'; ?> 