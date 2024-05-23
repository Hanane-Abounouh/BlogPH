<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <div class="flex gap-5 mt-4 items-start text-gray-600 hover:text-gray-900">
        <!-- Intégration de l'icône SVG -->
        <img src="https://icons.veryicon.com/png/o/commerce-shopping/online-retailers/comment-42.png" jsaction="VQAsE"
            class="sFlh5c pT0Scc iPVvYb" style="max-width: 30px; height: 30px; width: 30px;"
            alt="icon-article Vector Icons free download in SVG, PNG Format" jsname="kn3ccd" aria-hidden="false">
        <span class="text-2xl text-blue-600 font-bold">Comments</span>
        <!-- Titre "Articles" -->
    </div>

    <!-- comment -->
    <div class="shadow-lg rounded-lg overflow-hidden mx-4 mt-20 md:mx-10">
        <!-- Table -->
        <table class="w-full table-fixed">
            <thead>
                <tr class="bg-blue-700">
                    <th class="w-1/4 py-4 px-6 text-center text-white font-bold uppercase">ID</th>
                    <th class="w-1/4 py-4 px-6 text-center text-white font-bold uppercase">Content</th>
                    <th class="w-1/4 py-4 px-6 text-center text-white font-bold uppercase">Article Title</th>
                    <th class="w-1/4 py-4 px-6 text-center text-white font-bold uppercase">User Name</th>
                    <th class="w-1/4 py-4 px-6 text-center text-white font-bold uppercase">Date Created</th>
                    <th class="w-1/4 py-4 px-6 text-center text-orange-500 font-bold uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white overflow-auto h-96">
                <?php
                include '../connection.php';

                // Affichage des commentaires
                $requete = "SELECT commentaires.*, articles.titre, utilisateurs.nom_utilisateur FROM commentaires 
                            LEFT JOIN articles ON commentaires.id_article = articles.id_article 
                            LEFT JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id_utilisateur
                            ORDER BY commentaires.date_commentaire ASC";
                $result = $bddPDO->query($requete);
                if ($result) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td class="py-4 px-6 text-center border-b border-gray-200"><?php echo htmlspecialchars($row['id_commentaire']); ?></td>
                    <td class="py-4 px-6 text-center border-b border-gray-200 truncate"><?php echo htmlspecialchars($row['contenu']); ?></td>
                    <td class="py-4 px-6 text-center border-b border-gray-200"><?php echo htmlspecialchars($row['titre']); ?></td>
                    <td class="py-4 px-6 text-center border-b border-gray-200"><?php echo htmlspecialchars($row['nom_utilisateur']); ?></td>
                    <td class="py-4 px-6 text-center border-b border-gray-200"><?php echo htmlspecialchars($row['date_commentaire']); ?></td>
                    <td class="py-4 px-6 border-b flex border-gray-200">
                        <!-- Lien pour supprimer le commentaire -->
                        <a href="delete_comment.php?id=<?php echo htmlspecialchars($row['id_commentaire']); ?>" class="text-orange-500 py-1 px-2 rounded-full text-xl flex items-center justify-center">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <!-- Lien pour afficher le formulaire de modification -->
                        <a href="#" onclick="showModifyForm('<?php echo htmlspecialchars($row['id_commentaire']); ?>')" class="text-orange-500 py-1 px-2 rounded-full text-xl flex items-center justify-center">
                           Modify
                        </a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "La récupération des données a rencontré un problème.";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Formulaire de modification du commentaire (initialement masqué) -->
    <div id="modifyFormContainer" class="hidden mx-4 mt-4">
        <form id="modifyForm" action="modify_comment.php" method="POST">
            <input type="hidden" id="commentId" name="comment_id">
            <label for="newContent" class="block text-gray-700 font-bold">New Content:</label>
            <textarea name="new_content" id="newContent" class="w-full px-3 py-2 mt-1 mb-5 text-gray-700 border rounded-lg focus:outline-none" rows="4" required></textarea>
            <button type="submit" name="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
        </form>
    </div>

    <script>
        // Fonction pour afficher le formulaire de modification avec l'ID du commentaire
        function showModifyForm(commentId) {
            // Mettre à jour la valeur de l'ID du commentaire dans le formulaire
            document.getElementById('commentId').value = commentId;
            // Afficher le conteneur du formulaire de modification
            document.getElementById('modifyFormContainer').classList.remove('hidden');
        }
    </script>

</body>

</html>
