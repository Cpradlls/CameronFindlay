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
    <main class="add">
        <h1>Genres</h1>
        <div class="conteneur_ajout">
            <h2>Ajouter un nouveau genre</h2>
            <form action="" method="post">
                <label>
                    <h3>Nom du genre :</h2>
                    <input type="text" name="genre_name" required>
                </label>
                <input type="submit" name="ajouter">
            </form>
        </div>

        <?php
        if (isset($_POST['ajouter'])) {
            $genreName = $_POST['genre_name'] ?? false;
            $requete = "INSERT INTO `genresCP` (`genre_name`) VALUES (:genre_name)"; //Déclaration de la requête SQL de sélection de toute la table Genres trié par le nom genre
            $prepare = $pdo->prepare($requete);//Préparation de la requête
            $prepare->execute(array(
                ":genre_name" => $genreName
            )); // Exécution de la requête sql
            $res = $prepare->rowCount();

            if (isset($res)) {
                echo "<div class='resultat'>";
                    echo "<p>Le genre " . htmlentities($genreName, ENT_QUOTES) . " a bien été ajouté !</p>";
                    echo "<a class='btnBack' href='genre_read.php'>Retour</a>";
                echo "</div>";
            }
        }

        ?>
    </main>
    <footer>
        <p>Tous droits réservés à Cameron Findlay</p>
    </footer>
</body>
</html>