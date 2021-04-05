<?php
define("PAGE_TITLE", "Styles");
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
        <h1>Styles</h1>
        <div class="conteneur_ajout">
            <h2>Ajouter un nouveau style</h2>
            <form action="" method="post">
                <label>
                    <h3>Nom du style :</h3>
                    <input type="text" name="style_name" required>
                </label>
                <label>
                    <h3>Nom du style :</h3>
                    <select name="style_genre_id">
                    <?php
                    $requete = "SELECT * FROM `genresCP` ORDER BY `genre_name`"; //Déclaration de la requête SQL de sélection de toute la table Genres trié par le nom genre
                    $prepare = $pdo->prepare($requete);//Préparation de la requête
                    $prepare->execute(); // Exécution de la requête sql
                    $resultat = $prepare->fetchAll();
                    foreach ($resultat as $genre) {
                        echo '<option value="' . htmlentities($genre['genre_id'], ENT_QUOTES) . '">' . htmlentities($genre['genre_name'], ENT_QUOTES) . '</option>';
                    }
                    ?>
                    </select>
                </label>
                <input type="submit" name="ajouter" value="Ajouter">
            </form>
        </div>

        <?php
        if (isset($_POST['ajouter'])) {
            $styleGenreId = $_POST['style_genre_id'];
            $styleName = $_POST['style_name'];
            
            $requete = "INSERT INTO `stylesCP` (`style_name`, `style_genre_id`) VALUES (:style_name, :style_genre_id)"; //Déclaration de la requête SQL de sélection de toute la table Genres trié par le nom genre
            $prepare = $pdo->prepare($requete);//Préparation de la requête
            $prepare->execute(array(
                ":style_name" => $styleName,
                ":style_genre_id" => $styleGenreId
            )); // Exécution de la requête sql
            $res = $prepare->rowCount();

            if (isset($res)) {
                echo "<div class='resultat'>";
                    echo "<p>Le style " . htmlentities($styleName, ENT_QUOTES) . " a bien été ajouté et associé !</p>";
                    echo "<a class='btnBack' href='style_read.php'>Retour</a>";
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