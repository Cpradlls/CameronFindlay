<?php
define("PAGE_TITLE", "Artists");
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
        <h1>Artists</h1>
        <?php
                if (isset($_POST['delete'])) { //Condition si on appuit sur le bouton delete :

                    $artistId = $_POST['artist_id'] ?? false; // On récupère l'id du genre que l'on veut supprimer

                    //////////////////Affichage du genre à modifier //////////
                    $requete = "DELETE FROM `artistsCP` WHERE `artist_id` = :artist_id";
                    $prepare = $pdo->prepare($requete);//Préparation de la requête
                    $prepare->execute(array(
                        ":artist_id" => $artistId
                    )); // Exécution de la requête sql
                    
                    $resultat = $prepare->rowCount();

                    if (isset($resultat)) {
                        echo "<div class='resultat'>"
                                ."<p>L'artist a été supprimé !</p>"
                                . "<a class='btnBack' href='artist_read.php'>Retour</a>"
                            . "</div>";
                    }
                }
                ?>
    </main>
    <footer>
        <p>Tous droits réservés à Cameron Findlay</p>
    </footer>
</body>
</html>