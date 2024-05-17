
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
// Vérification de la soumission du formulaire
if(isset($_POST['add_article'])) {
    $titre = $_POST['titre'];
    $Contenu = $_POST['contenu'];
    $sous_titre = $_POST['sous_titre'];
    $date_publication = $_POST['date_publication'];
    $id_utilisateur = $_POST['id_utilisateur'];
    $id_categorie = $_POST['id_categorie'];

    // Gestion de l'image
    $target_dir = "../image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image_article = $target_dir . uniqid() . '.' . $imageFileType;

    // Vérification et déplacement du fichier image
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_article)) {
        // Préparation et exécution de la requête SQL pour insérer l'article dans la base de données
        $stmt = $bddPDO->prepare("INSERT INTO articles (titre, image_article, contenu, sous_titre, date_publication, id_utilisateur, id_categorie) VALUES (:titre, :image_article, :contenu, :sous_titre, :date_publication, :id_utilisateur, :id_categorie)");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':image_article', $image_article);
        $stmt->bindParam(':contenu', $Contenu);
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
    <title>Document</title>
    <link href="../style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>



<section class="px-20 Ajouter py-5 flex flex-col justify-center items-center w-full"  >
<div class="my-6">
<div class="flex mt-5  gap-5 items-center text-gray-600  hover:text-gray-900 ">
                    <!-- Intégration de l'icône SVG -->
                    <img src="https://icons.veryicon.com/png/o/system/content-management-system-background/add-article.png" jsaction="VQAsE" class="sFlh5c pT0Scc iPVvYb" 
                        style="max-width: 30px; height: 30px; width: 30px;" alt="icon-article Vector Icons free download in SVG, PNG Format" jsname="kn3ccd" aria-hidden="false">
                        <span class="text-2xl text-blue-600 font-bold">Add Article</span> 
                        <!-- Titre "Articles" -->
                        <a href="Dashboard.php" class="text-blue-600 text-2xl">Article</a>
                        
                </div>
            <div class="grid mt-2 sm:grid-cols-2 items-center gap-16 p-8 mx-auto max-w-4xl border border-gray-300 bg-white shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md text-[#333] font-[sans-serif]">    
         
                <form method="post" enctype="multipart/form-data"" class="ml-auo space-y-4">
                    <label for="Titre" class="block text-sm font-semibold leading-6 text-gray-900">Titre</label>
                    <input id="titre" name="titre" placeholder='Titre' class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#007bff]" />
                    <div class="col-span-full">
                    <label for="Subject" class="block text-sm font-semibold leading-6 text-gray-900">sous-titre</label>
                    <input type='text' placeholder='Subject'name='sous_titre' class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#007bff]" />

                    <div>
                    <label for="image" class="block text-sm font-semibold leading-6 text-gray-900">Image</label>
                        <input  type="file" name="image" id="image"class="rounded-md bg-gray px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-600 hover:bg-gray-500"></input>
                    </div>
                    <div class="mb-2">
              
                    
                    </div>
                    <label for="contenu" class="block text-sm font-semibold leading-6 text-gray-900">contenu</label>
                    <textarea placeholder='Subtitle' rows="6" id="Contenu" name="contenu"
                        class="w-full rounded-md px-4 border text-sm pt-2.5 outline-[#007bff]"></textarea>


              
                        <label for="date_publication" class="block text-sm font-semibold leading-6 text-gray-900">Date de publication:</label><br>
                        <input type="date" id="date_publication" name="date_publication"><br>


                  
            <div class="mb-2">
                <label for="id_utilisateur" class="block font-semibold mb-2">Utilisateur:</label></br>
                <select id="id_utilisateur" name="id_utilisateur" class="w-full border rounded-md px-3 py-2">
                    <?php foreach (getUsers($bddPDO) as $user): ?>
                        <option value="<?php echo $user['id_utilisateur']; ?>"><?php echo $user['nom_utilisateur']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-2">
                <label for="id_categorie" class="block font-semibold mb-2">Catégorie:</label></br>
                <select id="id_categorie" name="id_categorie" class="w-full border rounded-md px-3 py-2">
                    <?php foreach (getCategories($bddPDO) as $category): ?>
                        <option  value="<?php echo $category['id_categorie']; ?>"><?php echo $category['nom_categorie']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
                   
                    <button type="submit" name="add_article"
                        class="text-white bg-[#E53902] hover:bg-orange-500 font-semibold rounded-md text-l px-4 ">Send</button>
                </form>
            </div>
        </div>
                </section>
</body>