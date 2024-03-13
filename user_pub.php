<?php
// Connexion à la base de données (remplacez les valeurs par les vôtres)
$serveur = "localhost";
$utilisateur = "votre_nom_utilisateur";
$motdepasse = "votre_mot_de_passe";
$basededonnees = "nom_de_votre_base_de_donnees";

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué: " . $connexion->connect_error);
}

// Récupérer les données du formulaire et les insérer dans la base de données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $type = $_POST['type']; // Type d'annonce (texte, vidéo, etc.)

    // Insérer les données dans la base de données
    $requete = "INSERT INTO annonces (titre, contenu, type) VALUES ('$titre', '$contenu', '$type')";

    if ($connexion->query($requete) === TRUE) {
        echo "Annonce publiée avec succès.";
    } else {
        echo "Erreur lors de la publication de l'annonce: " . $connexion->error;
    }
}

// Formulaire HTML pour permettre aux utilisateurs de publier des annonces
?>
<!DOCTYPE html>
<html>
<head>
    <title>Publier une annonce</title>
</head>
<body>

<h2>Publier une annonce</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="titre">Titre:</label><br>
    <input type="text" id="titre" name="titre" required><br>
    <label for="contenu">Contenu:</label><br>
    <textarea id="contenu" name="contenu" rows="4" cols="50" required></textarea><br>
    <label for="type">Type:</label><br>
    <select id="type" name="type">
        <option value="texte">Texte</option>
        <option value="video">Vidéo</option>
    </select><br><br>
    <input type="submit" value="Publier">
</form>

</body>
</html>

<?php
// Fermer la connexion à la base de données
$connexion->close();
?>
