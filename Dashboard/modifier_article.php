<?php
// Connexion à la base de données
include '../connection.php';

function getUsers($bddPDO) {
    $stmt = $bddPDO->query("SELECT id_utilisateur, nom_utilisateur FROM utilisateurs");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCategories($bddPDO) {
    $stmt = $bddPDO->query("SELECT id_categorie, nom_categorie FROM categories");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Vérification si l'article existe avant de le charger pour la modification
if(isset($_GET['id'])) {
    $id_article = $_GET['id'];
    $stmt = $bddPDO->prepare("SELECT * FROM articles WHERE id_article = :id_article");
    $stmt->bindParam(':id_article', $id_article);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$article) {
        echo "Article non trouvé.";
        exit;
    }
} else {
    echo "ID d'article non spécifié.";
    exit;
}

// Traitement de la soumission du formulaire de mise à jour
if(isset($_POST['update_article'])) {
    $id_article = $_POST['id_article'];
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $sous_titre = $_POST['sous_titre'];
    $date_publication = $_POST['date_publication'];
    $id_utilisateur = $_POST['id_utilisateur'];
    $id_categorie = $_POST['id_categorie'];

    // Gestion de l'image
    $target_dir = "../image/";
    $image_article = null;
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $image_article = $target_dir . uniqid() . '.' . $imageFileType;

        // Vérification et déplacement du fichier image
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $image_article)) {
            echo "Erreur lors du téléchargement de l'image.";
            exit;
        }
    }

    // Préparation et exécution de la requête SQL pour mettre à jour l'article dans la base de données
    $query = "UPDATE articles SET titre = :titre, contenu = :contenu, sous_titre = :sous_titre, date_publication = :date_publication, id_utilisateur = :id_utilisateur, id_categorie = :id_categorie";
    if ($image_article) {
        $query .= ", image_article = :image_article";
    }
    $query .= " WHERE id_article = :id_article";

    $stmt = $bddPDO->prepare($query);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':contenu', $contenu);
    $stmt->bindParam(':sous_titre', $sous_titre);
    $stmt->bindParam(':date_publication', $date_publication);
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->bindParam(':id_categorie', $id_categorie);
    $stmt->bindParam(':id_article', $id_article);
    if ($image_article) {
        $stmt->bindParam(':image_article', $image_article);
    }

    // Exécution de la requête
    if ($stmt->execute()) {
        echo "Article mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de l'article.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Article</title>
    <link href="../style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<section class="px-20 Modifier py-5 flex flex-col justify-center items-center w-full">
    <div class="my-6">
        <div class="flex mt-5 gap-5 items-center text-gray-600 hover:text-gray-900">
            <img src="https://icons.veryicon.com/png/o/system/content-management-system-background/add-article.png" 
                 style="max-width: 30px; height: 30px; width: 30px;" 
                 alt="icon-article Vector Icons free download in SVG, PNG Format">
            <span class="text-2xl text-blue-600 font-bold">Modifier Article</span>
            <a href="Dashboard.php" class="text-blue-600 text-2xl">Article</a>
        </div>
        <div class="grid mt-2 sm:grid-cols-2 items-center gap-16 p-8 mx-auto max-w-4xl border border-gray-300 bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md text-[#333] font-[sans-serif]">
            <form method="post" enctype="multipart/form-data" class="ml-auo space-y-4">
                <input type="hidden" name="id_article" value="<?php echo htmlspecialchars($article['id_article']); ?>">
                <label for="Titre" class="block text-sm font-semibold leading-6 text-gray-900">Titre</label>
                <input id="titre" name="titre" placeholder='Titre' class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#007bff]"
                       value="<?php echo isset($article['titre']) ? htmlspecialchars($article['titre']) : ''; ?>" />
                <div class="col-span-full">
                    <label for="Subject" class="block text-sm font-semibold leading-6 text-gray-900">Sous-titre</label>
                    <input type='text' placeholder='Sous-titre' name='sous_titre' class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#007bff]"
                           value="<?php echo isset($article['sous_titre']) ? htmlspecialchars($article['sous_titre']) : ''; ?>" />
                </div>
                <div>
                    <label for="image" class="block text-sm font-semibold leading-6 text-gray-900">Image</label>
                    <input type="file" name="image" id="image" class="rounded-md bg-gray px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-600 hover:bg-gray-500"></input>
                </div>
                <div class="mb-2"></div>
                <label for="contenu" class="block text-sm font-semibold leading-6 text-gray-900">Contenu</label>
                <textarea placeholder='Contenu' name='contenu' class="w-full h-32 rounded-md py-2.5 px-4 border text-sm outline-[#007bff]"><?php echo isset($article['contenu']) ? htmlspecialchars($article['contenu']) : ''; ?></textarea>
<label for="date_publication" class="block text-sm font-semibold leading-6 text-gray-900">Date de publication</label>
<input type="date" name="date_publication" id="date_publication" class="rounded-md bg-gray px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-600 hover:bg-gray-500" value="<?php echo isset($article['date_publication']) ? htmlspecialchars($article['date_publication']) : ''; ?>">
<label for="id_utilisateur" class="block text-sm font-semibold leading-6 text-gray-900">Auteur</label>
<select name="id_utilisateur" id="id_utilisateur" class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#007bff]">
    <?php foreach (getUsers($bddPDO) as $user): ?>
        <option value="<?php echo $user['id_utilisateur']; ?>" <?php echo ($user['id_utilisateur'] == $article['id_utilisateur']) ? 'selected' : ''; ?>><?php echo $user['nom_utilisateur']; ?></option>
    <?php endforeach; ?>
</select>
<label for="id_categorie" class="block text-sm font-semibold leading-6 text-gray-900">Catégorie</label>
<select name="id_categorie" id="id_categorie" class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#007bff]">
    <?php foreach (getCategories($bddPDO) as $categorie): ?>
        <option value="<?php echo $categorie['id_categorie']; ?>" <?php echo ($categorie['id_categorie'] == $article['id_categorie']) ? 'selected' : ''; ?>><?php echo $categorie['nom_categorie']; ?></option>
    <?php endforeach; ?>
</select>
<div class="flex justify-between mt-8">
    <button type="submit" name="update_article" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Mettre à jour</button>
    <a href="Dashboard.php" class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Annuler</a>
</div>
</form>
</div>
</div>
</section>
</body>
</html>
