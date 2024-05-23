<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="flex flex-col items-center justify-center ">


<!-- la connexion de base de données  -->

      <?php include 'navbar.php'; ?>
      
    <section class=" py-20 justify-center mt-20 items-center">
        <div class="flex gap-5 items-center text-gray-600 mt-5 hover:text-gray-900 cursor-pointer">
            <!-- Intégration de l'icône SVG -->
            <img src="https://icons.veryicon.com/png/o/miscellaneous/yuanql/icon-article.png" jsaction="VQAsE" class="sFlh5c pT0Scc iPVvYb" 
            style="max-width: 30px; height: 30px; width: 30px;" alt="icon-article Vector Icons free download in SVG, PNG Format" jsname="kn3ccd" aria-hidden="false">
            <span class="text-2xl ml-10 text-blue-600 font-bold">Articles</span> <!-- Titre "Articles" -->
        </div>
        <div class="grid items-center justify-center w-full   gap-40 max-w-7xl mt-10   grid-cols-1  mx-auto lg:grid-cols-3">

        <?php 
try {
    $bddPDO = new PDO('mysql:host=localhost;dbname=phblog','root','');
}
catch (PDOException $e) {
    echo "<p>Erreur:".$e->getMessage();
    die();
}

$requete = "SELECT * FROM articles ORDER BY date_publication ASC";
$result = $bddPDO->query($requete);
if (!$result) {
    echo "La récupération des données a rencontré un problème";
} else {
   
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        ?>


       

            <!-- cadrs1 -->
            <div class="relative  justify-center w-96 px-8 py-4 bg-white border  border-gray-200 shadow-lg rounded-2xl "> <!-- Bordure grise, ombre, coins arrondis, texte centré -->
             <!-- Barre à gauche de couleur personnalisée -->
             <div class="absolute top-0 left-0 h-full bg-[#555555] w-2 rounded-tl-2xl rounded-bl-2xl"> <!-- Barre colorée -->
             </div>
         
             <!-- Contenu centré -->
             <img class="object-cover  object-center w-full mb-4 lg:h-48 md:h-36 rounded-xl" src="<?php echo $row['image_article']; ?>" alt="Image">
         
             <h1 class="text-2xl mt-2  font-semibold leading-none tracking-tighter text-center text-[#000000] lg:text-2xl"><?php echo $row['titre']; ?></h1></h1>
             <h6 class="  mt-1 leading-none  font-semibold tracking-tighter text-center text-[#000000]"><?php echo $row['sous_titre']; ?></h6>

                     <p class="text-base mt-6 justify-center leading-relaxed text-[#000000]">
             <?php 
             // Couper le contenu à environ 80 mots
             $content = $row['contenu'];
             $content_words = explode(" ", $content); // Diviser le contenu en mots
             $limited_content = implode(" ", array_slice($content_words, 0, 30)); // Prendre les 80 premiers mots
             echo $limited_content;
            ?>
            ....
           
        </p>


             <div class="mt-6">
              <?php if(isset($row['id_article']) && !empty($row['id_article'])): ?>
             <a href="./Article.php?id=<?php echo $row['id_article']; ?>" class="inline-flex items-center font-semibold text-blue-600 hover:text-neutral-600">Read More »</a>
             <?php endif; ?>
             </div>

             
             

             <div class="flex items-center space-x-3 justify-end">
    <!-- Bouton "J'aime" -->
    <button class="flex items-center gap-1 text-gray-600 hover:text-gray-900 cursor-pointer">
        <svg aria-label="Notifications" class="x1lliihq x1n2onr6 x5n08af text-[#464646]" fill="currentColor" height="20" role="img" viewBox="0 0 24 24" width="20">
            <!-- Icône "J'aime" -->
            <path d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 
                14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z"></path>
        </svg>
        <!-- Texte "J'aime" -->
        <span class="text-[#464646]">J'aime</span>
    </button>

    <button  class="flex gap-1">
    <!-- Icône de commentaire -->
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXMjNvC8B_jmTrgCxLhnjEsVatUlZcgdvJiKKndG3OBvBR3WCvokt2J_RiDgrsNea9jZA&amp;usqp=CAU" 
        jsaction="VQAsE" class="sFlh5c pT0Scc" alt="IconExperience » I-Collection » Message Icon" 
        jsname="JuXqh" style="max-width: 25px; width: 25px; height: 25px; " data-ilt="1715556188512">
    <!-- Texte "Commenter" -->
    <span class="text-[#464646]">Commenter</span>
</button>

</div>


         </div>

         <?php
            }
        }
        ?>

     </div>
        
    </section>
    <?php include 'footer.php'; ?>

   
    
</body>
</html>