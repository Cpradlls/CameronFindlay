<?php
define("PAGE_TITLE", "Genres");
require "../conf/pdo.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cameron Findlay, <?php echo PAGE_TITLE; ?></title>
    <meta name="description" content="Cameron Findlay, est une application web qui lui permettra de référencer l'ensemble des artistes présents dans son immense catalogue.">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="../index.php">
            <img src="../assets/logoCameron.png" alt="Logo Cameron Findlay">
        </a>
    </header>
    <main class="upDe">
        <h1>Genres</h1>
        <?php
        ////////////////// MODIFIER UN GENRE //////////////////////////////

        $genreId = $_POST['genre_id_Up'] ?? false; // On récupère l'id du genre que l'on veut supprimer
        $genreName = $_POST['genre_name_Up'] ?? false;

        //////////////////Préparation de la requete modifier //////////
        $requete = "UPDATE `genresCP` SET `genre_name` = :genre_name WHERE `genre_id` = :genre_id";
        $prepare = $pdo->prepare($requete);//Préparation de la requête
        $prepare->execute(array(
            ":genre_id" => $genreId,
            ":genre_name" => $genreName
        )); // Exécution de la requête sql

        $resultat = $prepare->rowCount();

        if (isset($resultat)) {
            echo "<div class='resultat'>";
                echo "<p>Le genre a bien été modifié !</p>";
                echo "<a class='btnBack' href='genre_read.php'>Retour</a>";
            echo "</div>";
        }
        ?>
    </main>
    <footer>
        <p>Tous droits réservés à Cameron Findlay</p>
    </footer>
</body>
</html>
