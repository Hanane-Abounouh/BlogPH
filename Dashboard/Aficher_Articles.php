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
    <section class="justify-center items-center">
        <div class="flex mt-14">
            <div class="flex gap-5 w-full items-center">
                <img src="https://icons.veryicon.com/png/o/miscellaneous/yuanql/icon-article.png" class="sFlh5c pT0Scc iPVvYb" style="max-width: 23px; height: 23px; width: 23px;" alt="icon-article Vector Icons free download in SVG, PNG Format">
                <span class="text-2xl text-blue-600 font-bold">Mes Articles</span>
            </div>
            <div class="flex justify-end w-full">
                <a href="/BlogPH/Dashboard/ajouter_Article.php" class="sidebar-link bg-[#245DCA] text-white px-3 py-1 rounded-lg text-xl">Ajouter</a>
            </div>
        </div>
        <div class="overflow-y-auto mt-10 justify-center h-3/4 w-full border border-gray-400 bg-[#e8ecef]">
            <div class="grid items-center py-5 px-10 justify-center gap-20 max-w-6xl mt-4 grid-cols-1 mx-auto lg:grid-cols-3">
                <?php
                include '../connection.php';
                $requete = "SELECT * FROM articles ORDER BY date_publication ASC";
                $result = $bddPDO->query($requete);
                if ($result) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="relative justify-center w-72 px-4 py-2 bg-white border border-gray-200 shadow-lg rounded-2xl">
                    <div class="absolute top-0 left-0 h-full bg-[#555555] w-2 rounded-tl-2xl rounded-bl-2xl"></div>
                    <img class="object-cover object-center w-4/5 mb-2 lg:h-36 md:h-32 rounded-xl" src="../<?php echo htmlspecialchars($row['image_article']); ?>" alt="Image">
                    <h1 class="text-lg mt-2 font-semibold leading-tight tracking-tighter text-start text-[#000000] lg:text-lg"><?php echo htmlspecialchars($row['titre']); ?></h1>
                    <h6 class="text-sm mt-1 leading-none font-semibold tracking-tighter text-start text-[#000000]"><?php echo htmlspecialchars($row['sous_titre']); ?></h6>
                    <p class="text-sm mt-2 leading-relaxed text-[#000000]">
                        <?php
                        $content = $row['contenu'];
                        $content_words = explode(" ", $content);
                        $limited_content = implode(" ", array_slice($content_words, 0, 20));
                        echo htmlspecialchars($limited_content);
                        ?>
                        ....
                    </p>
                    <div class="flex items-center space-x-3 mt-5 justify-end">
                       
                        <a href="modifier_article.php?id=<?php echo htmlspecialchars($row['id_article']); ?>" class="text-blue-600 text-2xl">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2lfFEP7nC0SFy-ExtRX1Dn9-kaRi7pwprWx1sGp0bGA&s" class="sFlh5c pT0Scc" alt="Modify Svg Png Icon Free Download" style="max-width: 20px; width: 20px; height: 20px;">
                        </a>
                        <a href="delete_article.php?id=<?php echo htmlspecialchars($row['id_article']); ?>" class="text-[#E53902] py-1 px-2 rounded-full text-xl flex items-center justify-center">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "La récupération des données a rencontré un problème.";
                }
                ?>
            </div>
        </div>
    </section>
</body>
</html>
