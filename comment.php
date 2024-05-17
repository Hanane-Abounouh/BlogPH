<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
require "connection.php";
session_start();
echo "<br>SESSION -> " . $_SESSION["id_utilisateur"];
echo "<br>SESSION -> " . $_SESSION["id_article"];

// Fetch article data
$articleStmt = $bddPDO->prepare("SELECT * FROM articles WHERE id_article = :id_article");
$articleStmt->execute([':id_article' => $_SESSION["id_article"]]);
$articles_row = $articleStmt->fetch(PDO::FETCH_ASSOC);

// Fetch user data
$userStmt = $bddPDO->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur");
$userStmt->execute([':id_utilisateur' => $articles_row["id_utilisateur"]]);
$user_row = $userStmt->fetch(PDO::FETCH_ASSOC);


if (!isset($_SESSION["id_utilisateur"]) || !isset($_SESSION["id_article"])) {
    echo "Session variables are not set. Please make sure you are logged in and viewing an article.";
    exit;
}

$id_utilisateur = $_SESSION["id_utilisateur"];
$id_article = $_SESSION["id_article"];

echo "<br>SESSION -> " . $id_utilisateur;
echo "<br>SESSION -> " . $id_article;

// Fetch article data
$articleStmt = $bddPDO->prepare("SELECT * FROM articles WHERE id_article = :id_article");
$articleStmt->execute([':id_article' => $id_article]);
$articles_row = $articleStmt->fetch(PDO::FETCH_ASSOC);

// Fetch user data
$userStmt = $bddPDO->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur");
$userStmt->execute([':id_utilisateur' => $articles_row["id_utilisateur"]]);
$user_row = $userStmt->fetch(PDO::FETCH_ASSOC);

// Add comment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $_POST['comment'];
    $response = [];

    if (empty($comment)) {
        $response['status'] = 'error';
        $response['message'] = 'Comment cannot be empty.';
        header("location:Blog.php.?error=" . $response['message']);
        exit;
    } else {
        $insert = $bddPDO->prepare("INSERT INTO commentaires (Contenu, id_utilisateur, id_article, date_commentaire) VALUES (:Contenu, :id_utilisateur, :id_article, :date_commentaire)");
        $insert->execute([
            ':Contenu' => $comment,
            ':id_utilisateur' => $id_utilisateur,
            ':id_article' => $id_article,
            ':date_commentaire' => date("Y-m-d")
        ]);
    }
}

// Fetch comments along with the username of the user who posted the comment
$commentsStmt = $bddPDO->prepare("
    SELECT commentaires.*, utilisateurs.nom_utilisateur 
    FROM commentaires 
    JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id_utilisateur 
    WHERE commentaires.id_article = :id_article
");
$commentsStmt->execute([':id_article' => $id_article]);
$comments = $commentsStmt->fetchAll(PDO::FETCH_OBJ);
?>

<section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased comment-section">
  <div class="max-w-2xl max-h-2xl mx-auto px-4 border border-gray-300">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion (<?php echo count($comments); ?>)</h2>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mb-6">
        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <label for="comment" class="sr-only">Your comment</label>
            <?php if(isset($_GET['error'])) { ?>
                <p class="error"><?php echo htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php } ?>
            <textarea id="comment" name="comment" rows="6"
                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                placeholder="Write a comment..." required></textarea>
        </div>
        <button type="submit"
            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
            Post comment
        </button>
    </form>
    <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 overflow-y-auto max-h-80">
    <?php foreach ($comments as $comment): ?>
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img
                        class="mr-2 w-6 h-6 rounded-full"
                        src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                        alt="Profile picture"><?php echo htmlspecialchars($comment->nom_utilisateur, ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="<?php echo htmlspecialchars($comment->date_commentaire, ENT_QUOTES, 'UTF-8'); ?>"
                        title="<?php echo htmlspecialchars($comment->date_commentaire, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($comment->date_commentaire, ENT_QUOTES, 'UTF-8'); ?></time></p>
            </div>
            <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                type="button">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                </svg>
                <span class="sr-only">Comment settings</span>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownComment1"
                class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownMenuIconHorizontalButton">
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                    </li>
                </ul>
            </div>
        </footer>
        <p class="text-base text-gray-900 dark:text-white"><?php echo htmlspecialchars($comment->Contenu, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endforeach; ?>
    </article>
</div>
</section>

</body>
</html>
