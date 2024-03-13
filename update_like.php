<?php
// Assurez-vous d'avoir une connexion à votre base de données
// Remplacez les valeurs de connexion par les vôtres
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wemi_project_db";

// Créez une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérez l'ID du produit depuis la requête AJAX
$productId = $_POST['productId'];

// Effectuez la mise à jour de l'état "like" dans la table "t_visits"
$sql = "UPDATE t_visits SET action = 'like' WHERE product_id = $productId";

if ($conn->query($sql) === TRUE) {
    echo "L'état 'like' a été mis à jour avec succès";
} else {
    echo "Erreur lors de la mise à jour de l'état 'like': " . $conn->error;
}

// Fermez la connexion
$conn->close();
?>
