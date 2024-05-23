<?php
// Vérifiez si l'identifiant de l'article est défini dans l'URL
if(isset($_GET['id'])) {
    // Inclure le fichier de connexion à la base de données
    include '../connection.php';

    // Récupérer l'identifiant de l'article à partir de l'URL
    $article_id = $_GET['id'];

    // Préparez la requête de suppression
    $requete = "DELETE FROM articles WHERE id_article = :id";

    // Préparez et exécutez la requête en utilisant une déclaration préparée pour éviter les injections SQL
    $stmt = $bddPDO->prepare($requete);
    $stmt->bindParam(':id', $article_id, PDO::PARAM_INT);
    
    // Exécutez la requête
    if($stmt->execute()) {
        // Article supprimé avec succès, redirigez l'utilisateur vers une page appropriée
        header('Location: Dashboard.php');
        exit();
    } else {
        // Une erreur s'est produite lors de la suppression de l'article
        echo "Une erreur s'est produite lors de la suppression de l'article.";
    }
} else {
    // L'identifiant de l'article n'est pas défini dans l'URL
    echo "Identifiant de l'article non spécifié.";
}
?>
