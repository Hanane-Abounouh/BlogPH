<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>
<body>

    
<?php include 'navbar.php'; ?>
<header class="header mt-20 "> <!-- Ajustez 4rem en fonction de la hauteur exacte de votre barre de navigation -->
   <!-- <div class="w-full bg-cover bg-center  md:rounded-xl" style="height:32rem; background-image: url('../image/Article-writing.jpg');"> -->
        <div class="flex   items-center px-56 pu-5 h-full w-full bg-gray-300 bg-opacity-50">
            <div class="justify-start">
                <div class="flex gap-5 items-center text-gray-600 hover:text-gray-900 cursor-pointer">
                    <!-- Intégration de l'icône SVG -->
                    <img src="https://icons.veryicon.com/png/o/miscellaneous/yuanql/icon-article.png" jsaction="VQAsE" class="sFlh5c pT0Scc iPVvYb" 
                    style="max-width: 30px; height: 30px; width: 30px;" alt="icon-article Vector Icons free download in SVG, PNG Format" jsname="kn3ccd" aria-hidden="false">
                    <span class="text-xl text-blue-600 font-semibold">Articles</span> <!-- Titre "Articles" -->
                </div>
                
                <h1 class="text-[#000000] text-2xl mt-5 font-semibold uppercase md:text-3xl">Bienvenue sur Notre Site</h1>
                <button class="mt-5 px-4 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Login</button>
            </div>

        </div>
    <!-- </div> -->

   
</header>


<main>
   


<section class="relative mt-12 items-center justify-center w-full px-4 py-10 mx-auto max-w-7xl shadow-lg">
    <div class="grid w-full justify-center mr-40 items-center grid-cols-1 gap-12 mx-auto lg:grid-cols-3">
        <?php
        // Connexion à la base de données (remplacez les valeurs par les vôtres)
        $host = 'localhost';
        $dbname = 'phblog';

        // Création de la connexion
        $conn = new mysqli($host, 'root', '', $dbname);

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        // Requête SQL pour récupérer les trois derniers articles par date
        $sql = "SELECT * FROM articles ORDER BY date_publication DESC LIMIT 3";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Parcourir chaque ligne de résultat
            while($row = $result->fetch_assoc()) {
                // Afficher les données dans les balises HTML
        ?>
        <div class="relative justify-center w-96 px-8 py-4 bg-white border border-gray-200 shadow-lg rounded-2xl">
            <!-- Bordure grise, ombre, coins arrondis, texte centré -->
            <!-- Barre à gauche de couleur personnalisée -->
            <div class="absolute top-0 left-0 h-full bg-[#555555] w-2 rounded-tl-2xl rounded-bl-2xl">
                <!-- Barre colorée -->
            </div>

            <!-- Contenu centré -->
            <img class="object-cover object-center w-full mb-4 lg:h-48 md:h-36 rounded-xl" src="<?php echo $row['image_article']; ?>" alt="Image">
            <h1 class="text-2xl mt-2 font-semibold leading-none tracking-tighter text-center text-[#000000] lg:text-2xl"><?php echo $row['titre']; ?></h1>
            <h6 class="mt-1 leading-none font-semibold tracking-tighter text-center text-[#000000]"><?php echo $row['sous_titre']; ?></h6>


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

            <!-- Mettre ici le code pour afficher les icônes de like et de commentaire -->
        </div>
        <?php
            }
        } else {
            echo "0 résultats";
        }
        // Fermeture de la connexion à la base de données
        $conn->close();
        ?>
    </div>
    <div class="flex justify-center items-center text-center mt-10">
        <a href="./Blog.php" class="block pb-1 mt-2 text-base text-[#FFCD05] w-48 uppercase border-b border-transparent hover:border-[#FFCD05]">View All Articles  -></a>
    </div>
</section>




    <section class="fixed w-full bottom-0 right-0 flex flex-col  "> <!-- Section fixe en bas à droite -->
        <!-- Conteneur de boutons centré -->
        <div class="flex justify-end mr-4 "> <!-- Centre les éléments -->
          <!-- Bouton "Remonter en haut" -->
          <button 
            id="scroll-top-btn" 
            class=" text-black py-2 px-2 w-14 h-14 bg-[#FFCD05] rounded-full" 
            title="Remonter en haut"
            style="display: block;"> <!-- Afficher par défaut -->
            <i class="fas fa-arrow-up fa-2x"></i> <!-- Icône de flèche vers le haut -->
          </button>
        </div>
    </section>

    
</main>


<?php include 'footer.php'; ?>










</body>
</html>