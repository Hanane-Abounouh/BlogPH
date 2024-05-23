<?php
session_start();
include 'connection.php';

// Vérifier si l'identifiant de l'article est présent dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_article = $_GET['id'];
    $current_user_id = $_SESSION['id_utilisateur']; // ID de l'utilisateur connecté

    // Récupérer les détails de l'article
    $requete = "SELECT articles.*, utilisateurs.nom_utilisateur 
                FROM articles 
                JOIN utilisateurs ON articles.id_utilisateur = utilisateurs.id_utilisateur 
                WHERE articles.id_article = :id_article";
    $statement = $bddPDO->prepare($requete);
    $statement->execute(array(':id_article' => $id_article));
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        echo "Aucun article trouvé avec cet identifiant.";
        exit;
    }

    // Récupérer les commentaires de l'article
    $commentQuery = "SELECT commentaires.*, utilisateurs.nom_utilisateur 
                     FROM commentaires 
                     JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id_utilisateur 
                     WHERE commentaires.id_article = :id_article 
                     ORDER BY date_commentaire DESC";
    $commentStatement = $bddPDO->prepare($commentQuery);
    $commentStatement->execute(array(':id_article' => $id_article));
    $comments = $commentStatement->fetchAll(PDO::FETCH_OBJ);
} else {
    echo "Identifiant de l'article non spécifié dans l'URL.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="flex flex-col items-center justify-center">
<?php include 'navbar.php'; ?>

<section class="container items-center flex justify-center py-20 mt-20">
    <div class="mb-32 relative items-center justify-center py-10 md:w-9/12 bg-white border border-gray-200 shadow-lg rounded-2xl">
        <div class="mb-12 flex flex-wrap justify-center">
            <div class="w-full shrink-0 grow-0 basis-auto px-3 md:w-10/12">
                <div class="relative mb-6 img-article overflow-hidden rounded-lg bg-cover bg-no-repeat shadow-lg dark:shadow-black/20" data-te-ripple-init data-te-ripple-color="light">
                    <img src="<?php echo htmlspecialchars($row['image_article'], ENT_QUOTES, 'UTF-8'); ?>" class="w-full" alt="Article Image"/>
                </div>
            </div>

            <div class="w-full shrink-0 grow-0 basis-auto md:w-10/12 px-3">
                <div class="text-center">
                    <h5 class="mb-3 text-lg font-bold"><?php echo htmlspecialchars($row['titre'], ENT_QUOTES, 'UTF-8'); ?></h5>
                    <h5 class="mb-3 text-lg"><?php echo htmlspecialchars($row['sous_titre'], ENT_QUOTES, 'UTF-8'); ?></h5>
                </div>
                <p class="mb-6 w-full"><?php echo htmlspecialchars($row['contenu'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="justify-end">
                    <p class="mb-4 text-blue-600 dark:text-neutral-300 text-xl">
                        <small>Published <u><?php echo htmlspecialchars($row['date_publication'], ENT_QUOTES, 'UTF-8'); ?></u> by <a href="#!"><?php echo htmlspecialchars($row['nom_utilisateur'], ENT_QUOTES, 'UTF-8'); ?></a></small>
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-3 ml-28">

           <div class="flex items-center gap-1 text-gray-600 hover:text-gray-900 cursor-pointer" onclick="likeArticle(<?php echo $row['id_article']; ?>)">
    <!-- Icône de "like" -->
    <svg id="likeIcon" aria-label="Like" class="x1lliihq x1n2onr6 x5n08af text-[#464646]" fill="currentColor" height="20" role="img" viewBox="0 0 24 24" width="20">
        <path d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 
   14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z"></path>
    </svg>
    <span class="text-[#464646]">5k</span> <!-- Nombre de "likes" -->
</div>
            <button id="comment-btn" class="flex gap-1">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXMjNvC8B_jmTrgCxLhnjEsVatUlZcgdvJiKKndG3OBvBR3WCvokt2J_RiDgrsNea9jZA&amp;usqp=CAU" class="sFlh5c pT0Scc" alt="Comment Icon" style="max-width: 25px; width: 25px; height: 25px;">
                <span class="text-[#464646]"><?php echo count($comments); ?></span>
            </button>
        </div>
    </div>
</section>

<section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased comment-section" style="display:none;">
    <div class="max-w-2xl max-h-2xl mx-auto px-4 border border-gray-300">
        <div class="flex justify-between items-center mb-6">
        <h2 id="comment-count" class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion (<?php echo count($comments); ?>)</h2>

        </div>
        <form id="comment-form" class="mb-6">
            <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <textarea id="comment" name="comment" rows="6" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" placeholder="Write a comment..." required></textarea>
            </div>
            <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">Post comment</button>
        </form>

        <!-- Edit Comment Form -->
        <form id="edit-comment-form" style="display:none;">
            <textarea id="edited-comment" name="edited-comment" rows="6" class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" required></textarea>
            <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">Enregistrer</button>
        </form>

        <article id="comments-list" class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 overflow-y-auto max-h-80">
            <?php foreach ($comments as $comment): ?>
                <footer class="flex justify-between items-center mb-2 comment-item" data-comment-id="<?php echo $comment->id_commentaire; ?>">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img class="mr-2 w-6 h-6 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Profile picture"><?php echo htmlspecialchars($comment->nom_utilisateur, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="<?php echo htmlspecialchars($comment->date_commentaire, ENT_QUOTES, 'UTF-8'); ?>" title="<?php echo htmlspecialchars($comment->date_commentaire, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($comment->date_commentaire, ENT_QUOTES, 'UTF-8'); ?></time></p>
                    </div>
                    <?php if ($current_user_id == $comment->id_utilisateur): ?>
                    <div>
                        <button class="edit-comment-btn" data-comment-id="<?php echo $comment->id_commentaire; ?>">Modifier</button>
                        <button class="delete-comment-btn" data-comment-id="<?php echo $comment->id_commentaire; ?>">Supprimer</button>
                    </div>
                    <?php endif; ?>
                </footer>
                <p class="text-base text-gray-900 dark:text-white comment-content"><?php echo htmlspecialchars($comment->contenu, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endforeach; ?>
        </article>
    </div>
</section>

<?php include 'footer.php'; ?>

<script>
$(document).ready(function() {
    // Afficher/Masquer la section des commentaires
    $('#comment-btn').on('click', function() {
        $('.comment-section').toggle();
    });

    // Fonction pour ajouter un commentaire
    $('#comment-form').on('submit', function(e) {
        e.preventDefault();
        var comment = $('#comment').val();
        var id_article = <?php echo json_encode($id_article); ?>;

        $.ajax({
            url: 'comment_handler.php',
            method: 'POST',
            data: {
                action: 'add',
                comment: comment,
                id_article: id_article
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var newComment = response.comment;
                    var commentHtml = '<article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 overflow-y-auto max-h-80 comment-item" data-comment-id="' + newComment.id_commentaire + '">' +
                        '<footer class="flex justify-between items-center mb-2">' +
                        '<div class="flex items-center">' +
                        '<p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img class="mr-2 w-6 h-6 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Profile picture">' + newComment.nom_utilisateur + '</p>' +
                        '<p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="' + newComment.date_commentaire + '" title="' + newComment.date_commentaire + '">' + newComment.date_commentaire + '</time></p>' +
                        '</div>' +
                        '<div>' +
                        '<button class="edit-comment-btn" data-comment-id="' + newComment.id_commentaire + '">Modifier</button>' +
                        '<button class="delete-comment-btn" data-comment-id="' + newComment.id_commentaire + '">Supprimer</button>' +
                        '</div>' +
                        '</footer>' +
                        '<p class="text-base text-gray-900 dark:text-white comment-content">' + newComment.contenu + '</p>' +
                        '</article>';
                    $('#comments-list').append(commentHtml);
                    $('#comment').val('');

                    // Mettre à jour le compteur de commentaires
                    var currentCount = parseInt($('#comment-count').text());
                    $('#comment-count').text(currentCount + 1);
                } else {
                    alert(response.message);
                }
            }
        });
    });


    // Gestionnaire d'événement pour le clic sur le bouton de modification (avec délégation)
    $(document).on('click', '.edit-comment-btn', function() {
        var commentId = $(this).data('comment-id');
        var commentContent = $('[data-comment-id="' + commentId + '"] .comment-content').text();
        showEditCommentForm(commentId, commentContent);
    });

    // Fonction pour afficher le formulaire de modification du commentaire
    function showEditCommentForm(commentId, currentContent) {
        var editField = $('<textarea class="edit-comment-input w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" required></textarea>');
        editField.val(currentContent);
        $('[data-comment-id="' + commentId + '"] .comment-content').replaceWith(editField);
        editField.after('<button class="save-comment-btn bg-blue-500 text-white p-2 rounded">Enregistrer</button>');
    }

    // Gestionnaire d'événement pour l'enregistrement du commentaire modifié (avec délégation)
    $(document).on('click', '.save-comment-btn', function() {
        var commentId = $(this).closest('.comment-item').data('comment-id');
        var editedContent = $(this).prev('textarea').val();
        
        // Envoyer une requête AJAX pour mettre à jour le commentaire
        $.ajax({
            url: 'comment_handler.php',
            method: 'POST',
            data: {
                action: 'edit',
                commentId: commentId,
                editedComment: editedContent
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('[data-comment-id="' + commentId + '"] .edit-comment-input').replaceWith('<p class="text-base text-gray-900 dark:text-white comment-content">' + editedContent + '</p>');
                    $('.save-comment-btn').remove();
                } else {
                    alert(response.message);
                }
            }
        });
    });

    // Gestionnaire d'événement pour la suppression du commentaire (avec délégation)
    $(document).on('click', '.delete-comment-btn', function() {
        var commentId = $(this).data('comment-id');
        
        // Envoyer une requête AJAX pour supprimer le commentaire
        $.ajax({
            url: 'comment_handler.php',
            method: 'POST',
            data: {
                action: 'delete',
                id_commentaire: commentId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('[data-comment-id="' + commentId + '"]').remove();
                } else {
                    alert(response.message);
                }
            }
        });
    });
});


</script>
</body>
</html>
