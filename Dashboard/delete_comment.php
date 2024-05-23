<?php
include '../connection.php';

// Récupérer l'identifiant du commentaire à partir de l'URL
$comment_id = $_GET['id'];

// Préparez la requête de suppression
$requete = "DELETE FROM commentaires WHERE id_commentaire = :id";

// Préparez et exécutez la requête en utilisant une déclaration préparée pour éviter les injections SQL
$stmt = $bddPDO->prepare($requete);
$stmt->bindParam(':id', $comment_id, PDO::PARAM_INT);

// Exécutez la requête
if($stmt->execute()) {
    // Commentaire supprimé avec succès, redirigez l'utilisateur vers une page appropriée
    header('Location: Dashboard.php');
    exit();
} else {
    // Une erreur s'est produite lors de la suppression du commentaire
    echo "Une erreur s'est produite lors de la suppression du commentaire.";
}
?>
