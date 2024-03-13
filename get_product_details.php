<?php include_once 'header.php'; ?>
<?php include_once 'carousel.php'; ?>
<?php include_once 'form_recherche.php'; ?>

<?php

// Vérifiez si l'identifiant du produit a été envoyé via une requête AJAX
//if (isset($_GET['product_id'])) {
    // Récupérez l'identifiant du produit
    //global $pdo;
    //$productId = $_GET['product_id'];
    //$visitDate = 'visit_date';
    //Requete pour ajouter la vue dans la table visite
    //$sql="INSERT INTO t_visits ($productId, $visitDate) VALUES (product_id, visit_date)";
    //$stmt= $bdd->prepare($sql);
    //$stmt->bindParam($productId, $visitDate);
    //$stmt->execute($sql($bdd));
    
    //$date = date('Y-m-d');
    //$sql="INSERT INTO visits_product (product_id, visit_date) VALUES (?,?)";
    //$stmt = $bdd->prepare($sql);
    //$stmt->execute([$productId, $visitDate]);
    //var_dump($stmt);
    //echo "La vue du produit a ete ajouter avec success";
    
//} else{
   // echo " Erreur : ID du produit non trouvé.";
//}
  // Connexion à la base de données (à remplacer avec tes propres paramètres de connexion)
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
  // Fonction pour enregistrer une visite d'product dans la base de données
  function logProductVisit($productId) {
      global $pdo;
      $productId = $_GET['product_id'];
      $date = date('Y-m-d');
      $stmt = $pdo->prepare("INSERT INTO t_visits (product_id, visit_date) VALUES (?, ?)");
      $stmt->execute([$productId, $date]);
  }
?>
</header>
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="featured-user  mb-5 mb-lg-0">
                    <h3 class="mb-4">Categorie</h3>
                    <ul class="list-unstyled" id="get_category">
                    </ul>
                </div>
            </div>

            <div class="col-lg-9" id="get_product_one"> 
            </div>
        </div>
    </div>
</div>
<?php
  // Enregistrer une visite pour un product (exemple)
  logProductVisit(1);
  //var_dump(logProductVisit(1))
?>
<div id="nav_marque"></div>  
<?php include_once 'footer.php'; ?> 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#like').forEach(function(button) {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('pid');
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_like.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Vous pouvez ajouter ici des actions à effectuer après la mise à jour de l'état "like"
                        console.log('État "like" mis à jour avec succès');
                    }
                };
                xhr.send('productId=' + productId);
            });
        });
    });
</script>

