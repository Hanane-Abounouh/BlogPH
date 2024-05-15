<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'phblog';


try {
    $con = new PDO("mysql:host=$host;dbname=$dbname", 'root', '');
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
}

// Vérification de la soumission du formulaire
if(isset($_POST['add_article'])) {
    $titre = $_POST['titre'];
    $Contenu = $_POST['Contenu'];
    $sous_titre = $_POST['sous_titre'];
    $date_publication = $_POST['date_publication'];
    $id_utilisateur = $_POST['id_utilisateur'];
    $id_categorie = $_POST['id_categorie'];

    // Gestion de l'image
    $target_dir = "./image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image_article = $target_dir . uniqid() . '.' . $imageFileType;

    // Vérification et déplacement du fichier image
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_article)) {
        // Préparation et exécution de la requête SQL pour insérer l'article dans la base de données
        $stmt = $con->prepare("INSERT INTO articles (titre, image_article, Contenu, sous_titre, date_publication, id_utilisateur, id_categorie) VALUES (:titre, :image_article, :Contenu, :sous_titre, :date_publication, :id_utilisateur, :id_categorie)");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':image_article', $image_article);
        $stmt->bindParam(':Contenu', $Contenu);
        $stmt->bindParam(':sous_titre', $sous_titre);
        $stmt->bindParam(':date_publication', $date_publication);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->bindParam(':id_categorie', $id_categorie);

        // Exécution de la requête
        if ($stmt->execute()) {
            echo "Article ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout de l'article.";
        }
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Article</title>
</head>
<body>
    <h2>Ajouter un Article</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="titre">Titre:</label><br>
        <input type="text" id="titre" name="titre"><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br>

        <label for="Contenu">Contenu:</label><br>
        <textarea id="Contenu" name="Contenu"></textarea><br>

        <label for="sous_titre">Sous-titre:</label><br>
        <input type="text" id="sous_titre" name="sous_titre"><br>

        <label for="date_publication">Date de publication:</label><br>
        <input type="date" id="date_publication" name="date_publication"><br>

        <label for="id_utilisateur">ID Utilisateur:</label><br>
        <input type="text" id="id_utilisateur" name="id_utilisateur"><br>

        <label for="id_categorie">ID Catégorie:</label><br>
        <input type="text" id="id_categorie" name="id_categorie"><br>

        <button type="submit" name="add_article">Ajouter l'Article</button>
    </form>
</body>
</html>
