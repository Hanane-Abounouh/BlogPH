<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['id_utilisateur'])) {
    echo json_encode(['success' => false, 'message' => 'Veuillez vous connecter pour effectuer cette action']);
    exit;
}

if (!isset($_POST['action'])) {
    echo json_encode(['success' => false, 'message' => 'Action non spécifiée']);
    exit;
}

$action = $_POST['action'];

if ($action == 'add') {
    if (isset($_POST['comment']) && isset($_POST['id_article'])) {
        $comment = $_POST['comment'];
        $id_article = $_POST['id_article'];
        $id_utilisateur = $_SESSION['id_utilisateur'];

        $requete = "INSERT INTO commentaires (id_article, id_utilisateur, contenu, date_commentaire) VALUES (:id_article, :id_utilisateur, :contenu, NOW())";
        $statement = $bddPDO->prepare($requete);
        $statement->execute(array(
            ':id_article' => $id_article,
            ':id_utilisateur' => $id_utilisateur,
            ':contenu' => $comment
        ));

        $id_commentaire = $bddPDO->lastInsertId();
        $date_commentaire = date('Y-m-d H:i:s');

        echo json_encode(['success' => true, 'comment' => [
            'id_commentaire' => $id_commentaire,
            'nom_utilisateur' => $_SESSION['nom_utilisateur'],
            'date_commentaire' => $date_commentaire,
            'contenu' => htmlspecialchars($comment, ENT_QUOTES, 'UTF-8')
        ]]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Données manquantes']);
    }
} elseif ($action == 'delete') {
    if (isset($_POST['id_commentaire'])) {
        $id_commentaire = $_POST['id_commentaire'];
        $id_utilisateur = $_SESSION['id_utilisateur'];

        $requete = "SELECT id_utilisateur FROM commentaires WHERE id_commentaire = :id_commentaire";
        $statement = $bddPDO->prepare($requete);
        $statement->execute(array(':id_commentaire' => $id_commentaire));
        $comment = $statement->fetch(PDO::FETCH_ASSOC);

        if ($comment && $comment['id_utilisateur'] == $id_utilisateur) {
            $requete = "DELETE FROM commentaires WHERE id_commentaire = :id_commentaire";
            $statement = $bddPDO->prepare($requete);
            $statement->execute(array(':id_commentaire' => $id_commentaire));

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Action non autorisée']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Données manquantes']);
    }
} elseif ($action == 'edit') {
    if (isset($_POST['commentId']) && isset($_POST['editedComment'])) {
        $id_commentaire = $_POST['commentId'];
        $editedComment = $_POST['editedComment'];
        $id_utilisateur = $_SESSION['id_utilisateur'];

        $requete = "SELECT id_utilisateur FROM commentaires WHERE id_commentaire = :id_commentaire";
        $statement = $bddPDO->prepare($requete);
        $statement->execute(array(':id_commentaire' => $id_commentaire));
        $comment = $statement->fetch(PDO::FETCH_ASSOC);

        if ($comment && $comment['id_utilisateur'] == $id_utilisateur) {
            $requete = "UPDATE commentaires SET contenu = :contenu, date_commentaire = NOW() WHERE id_commentaire = :id_commentaire";
            $statement = $bddPDO->prepare($requete);
            $statement->execute(array(
                ':contenu' => $editedComment,
                ':id_commentaire' => $id_commentaire
            ));

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Action non autorisée']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Données manquantes']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Action non valide']);
    exit;
}
?>
