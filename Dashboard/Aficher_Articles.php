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


    <section class="justify-center items-center ">


        <div class="flex  mt-14 ">
            <!-- Conteneur pour l'image, le titre et le bouton -->
            <div class="flex gap-5  w-full items-center">
                <!-- Image -->
                <img src="https://icons.veryicon.com/png/o/miscellaneous/yuanql/icon-article.png" jsaction="VQAsE"
                    class="sFlh5c pT0Scc iPVvYb" style="max-width: 23px; height: 23px; width: 23px;"
                    alt="icon-article Vector Icons free download in SVG, PNG Format" jsname="kn3ccd"
                    aria-hidden="false">
                <!-- Titre -->
                <span class="text-2xl text-blue-600 font-bold">Mes Articles</span>
            </div>

            <!-- Bouton -->
           <!-- Bouton -->
           <div class="flex justify-end w-full">
           <a href="ajouter_Article.php" class="sidebar-link bg-[#245DCA] text-white px-3 py-1 rounded-lg text-xl">Ajouter</a>
           </div>



        </div>
        <div class="overflow-y-auto mt-10 justify-center   h-3/4 w-full border border-gray-400 bg-[#e8ecef]">
            <div
                class="grid items-center   py-5 px-10 justify-center  gap-20 max-w-6xl mt-4   grid-cols-1  mx-auto lg:grid-cols-3">
                <!-- la connexion de base de données  -->

                <?php
    // Inclure le fichier de connexion
    include '../connection.php';

    $requete = "SELECT * FROM articles ORDER BY date_publication ASC";
    $result = $bddPDO->query($requete);
    if (!$result) {
        echo "La récupération des données a rencontré un problème";
    } else {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    ?>
                <!-- cadrs1 -->
                <div
                    class="relative justify-center w-72 px-4 py-2 bg-white border border-gray-200 shadow-lg rounded-2xl ">
                    <!-- Ajustements de taille -->
                    <!-- Barre à gauche de couleur personnalisée -->
                    <div class="absolute top-0 left-0 h-full bg-[#555555] w-2 rounded-tl-2xl rounded-bl-2xl">
                        <!-- Barre colorée -->
                    </div>

                    <!-- Contenu centré -->
                    <img class="object-cover object-center w-4/5 mb-2 lg:h-36 md:h-32 rounded-xl"
                        src="../<?php echo $row['image_article']; ?>" alt="Image"> <!-- Ajustements de taille -->

                    <h1
                        class="text-lg mt-2 font-semibold leading-tight tracking-tighter text-start text-[#000000] lg:text-lg">
                        <?php echo $row['titre']; ?></h1>
                    <h6 class="text-sm mt-1 leading-none font-semibold tracking-tighter text-start text-[#000000]">
                        <?php echo $row['sous_titre']; ?></h6>
                    <p class="text-sm mt-2 leading-relaxed text-[#000000]">
                        <?php 
                          // Couper le contenu à environ 80 mots
                          $content = $row['contenu'];
                          $content_words = explode(" ", $content); // Diviser le contenu en mots
                          $limited_content = implode(" ", array_slice($content_words, 0, 20)); // Prendre les 80 premiers mots
                          echo $limited_content;
                          ?>
                        ....
                    </p>




                    <div class="flex items-center space-x-3 justify-end">
                        <!-- Div avec des icônes espacées -->
                        <!-- Icône de "like" -->
                        <div class="flex items-center gap-1 text-gray-600 hover:text-gray-900 cursor-pointer">
                            <!-- Icône de "like" -->

                            <svg aria-label="Notifications" class="x1lliihq x1n2onr6 x5n08af text-[#464646]"
                                fill="currentColor" height="16" role="img" viewBox="0 0 24 24" width="16">
                                <!-- Ajustement de taille -->

                                <path
                                    d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 
                                                    14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z">
                                </path>
                            </svg>
                            <span class="text-[#464646]">5k</span> <!-- Nombre de "likes" -->
                        </div>
                        <!-- Icône de commentaire -->
                        <div class="flex items-center gap-1">
                            <!-- Ajustement de taille -->
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXMjNvC8B_jmTrgCxLhnjEsVatUlZcgdvJiKKndG3OBvBR3WCvokt2J_RiDgrsNea9jZA&amp;usqp=CAU"
                                jsaction="VQAsE" class="sFlh5c pT0Scc"
                                alt="IconExperience » I-Collection » Message Icon" jsname="JuXqh"
                                style="max-width: 20px; width: 20px; height: 20px; " data-ilt="1715556188512">
                            <!-- Ajustement de taille -->
                            <span class="text-[#464646]">56</span> <!-- Nombre de "likes" -->
                        </div>
                        <div>
                            <td class="py-4 px-6 border-b border-gray-200">
                                <span
                                    class="text-[#E53902] py-1 px-2 rounded-full text-xl flex items-center justify-center">
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                            </td>
                        </div>

                    </div>


                </div>
                <?php
                    }
                }
                ?>

            </div>

        </div>
    </section>

</body>

</html>