<?php
include '../connection.php';

// Vérifie si une requête POST a été envoyée pour modifier un commentaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Récupère les données du formulaire
    $comment_id = $_POST['comment_id'];
    $new_content = $_POST['new_content'];

    // Met à jour le contenu du commentaire dans la base de données
    $sql = "UPDATE commentaires SET contenu = :new_content WHERE id_commentaire = :comment_id";
    $stmt = $bddPDO->prepare($sql);
    $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $stmt->bindParam(':new_content', $new_content, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        // Redirection vers la page des commentaires après la modification
        header("Location: Dashboard.php");
        exit();
    } else {
        echo "Erreur lors de la modification du commentaire.";
    }
}
?>
