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
    <main class="add">
        <h1>Artists</h1>
        <div class="conteneur_ajout">
            <h2>Ajouter un nouveau style</h2>
            <form action="" method="post">
                <label>
                    <h3>Nom de l'artiste :</h2>
                    <input type="text" name="artist_name" required>
                </label>
                <label>
                    <h3>Choix styles musicaux :</h2>
                    <div class="choix_Style">
                    <?php
                    $requete = "SELECT * FROM `styles` ORDER BY `style_name`"; //Déclaration de la requête SQL de sélection de toute la table Genres trié par le nom genre
                    $prepare = $pdo->prepare($requete);//Préparation de la requête
                    $prepare->execute(); // Exécution de la requête sql
                    $resultat = $prepare->fetchAll();
                    foreach ($resultat as $style) {
                        echo '<div class="selected_style">'
                                . '<input type="checkbox" name="artist_style_id[]" value="' . htmlentities($style['style_id'], ENT_QUOTES) . '">'
                                . '<label for="">' . htmlentities($style['style_name'], ENT_QUOTES) . '</label>'
                            . '</div>';
                    }
                    ?>
                    </div>
                </label>
                    <input type="submit" name="ajouter" value="Ajouter">
            </form>
        </div>
        <div class="Resultat">
        <?php
            if (isset($_POST['ajouter'])) {
                $artistStyleId = $_POST['artist_style_id'];
                $artistName = $_POST['artist_name'];
                
                $requete = "INSERT INTO `artistsCP` (`artist_name`) VALUES (:artist_name)"; //Déclaration de la requête SQL de sélection de toute la table Genres trié par le nom genre
                $prepare = $pdo->prepare($requete);//Préparation de la requête
                $prepare->execute(array(
                    ":artist_name" => $artistName,
                )); // Exécution de la requête sql
                $result = $prepare->rowCount();
                $lastInsertedArtistId = $pdo->lastInsertId();


                if (isset($result)) {
                    echo "<p>L'artist a bien été ajouté !</p>";
                    foreach ($artistStyleId as $StyleId) {
                        $requete = "INSERT INTO `assoc_artists_stylesCP` (`assoc_artist_id`, `assoc_style_id`) VALUES (:assoc_artist_id, :assoc_style_id)"; //Déclaration de la requête SQL de sélection de toute la table Genres trié par le nom genre
                        $prepare = $pdo->prepare($requete);//Préparation de la requête
                        $prepare->execute(array(
                            ":assoc_artist_id" => $lastInsertedArtistId,
                            ":assoc_style_id" => $StyleId
                        )); // Exécution de la requête sql
                    }
                    echo "<p>Le style et l'artist ont bien été associé !</p>";
                    echo "<a class='btnBack' href='artist_read.php'>Retour</a>";
                }
            
            }

            ?>
        </div>
    </main>
    <footer>
        <p>Tous droits réservés à Cameron Findlay</p>
    </footer>
</body>
</html>