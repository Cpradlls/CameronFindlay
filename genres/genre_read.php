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
    <main class="Read">
        <h1>GENRES</h1>
        <div class="add">
            <a class="btnAdd" href="genre_add.php">Ajouter un nouveau genre</a>
        </div>
        <div class="conteneur">
            <?php

            $requete = "SELECT * FROM `genresCP` ORDER BY `genre_name`"; //Déclaration de la requête SQL de sélection de toute la table Genres trié par le nom genre
            $prepare = $pdo->prepare($requete);//Préparation de la requête
            $prepare->execute(); // Exécution de la requête sql
            $resultat = $prepare->fetchAll(); // on stocke toutes les lignes dans un tableau 

            echo '<div class="contenu">';
                foreach ($resultat as $genre) { //On lit tout le tableau en bouclant avec la fonction Foreach
                    echo '<div class="SGA">';
                        echo '<p>' . htmlentities($genre["genre_name"], ENT_QUOTES) . '</p>'; // Affiche chaque genre en protégeant la sortie avec la fonction htmlentities
                        echo '<form action="" method="POST">'
                                . '<input type="hidden" name="genre_id" value="' . htmlentities($genre['genre_id'], ENT_QUOTES) . '">' // Récupération de l'id du genre que l'on veut modifier en mode caché 
                                . '<input type="submit" class="image" name="update" value="Modifier">'
                            . '</form>';
                        echo '<form action="genre_delete.php" method="POST">'
                                    . '<input type="hidden" name="genre_id" value="' . htmlentities($genre['genre_id'], ENT_QUOTES) . '">' // Récupération de l'id du genre que l'on veut modifier en mode caché 
                                    . '<input type="submit" class="image" name="delete" value="Supprimer">'
                            . '</form>';
                    echo '</div>';
                }
            echo '</div>';

            

            if (isset($_POST['update'])) { //Condition si on appuit sur le bouton Modifier :

                $genreId = $_POST['genre_id'] ?? false; // On récupère l'id du genre que l'on veut supprimer
            
                //////////////////Affichage du genre à modifier //////////
                $requete = "SELECT * FROM `genresCP` WHERE `genre_id` = :genre_id";
                $prepare = $pdo->prepare($requete);//Préparation de la requête
                $prepare->execute(array(
                    ":genre_id" => $genreId
                )); // Exécution de la requête sql
                
                $resultat = $prepare->fetch(); // Récupération du nombre de ligne affectée par la requete sql
            
                echo '<div class="resultat">'
                        .'<form action="genre_update.php" method="POST">'
                            . '<label>'
                            . '<h3>Nom du genre :</h3>'
                            . '<input type="hidden" name="genre_id_Up" value="' . htmlentities($resultat['genre_id'], ENT_QUOTES) . '" required>'
                            . '<input type="text" name="genre_name_Up" value="' . htmlentities($resultat['genre_name'], ENT_QUOTES) . '" required>'
                            . '<input type="submit" value="Modifier">'
                        . '</form>'
                    . '</div>';

            }       

            ?>
        </div>
    </main>
    <footer>
        <p>Tous droits réservés à Cameron Findlay</p>
    </footer>
</body>
</html>