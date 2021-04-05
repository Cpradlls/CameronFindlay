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
    <main class="Read">
        <h1>STYLES</h1>
        <div class="add">
            <a class="btnAdd" href="style_add.php">Ajouter un nouveau style</a>
        </div>
        <div class="conteneur">
            <?php

                $requete = "SELECT * FROM `stylesCP` ORDER BY `style_name`"; //Déclaration de la requête SQL de sélection de toute la table Style trié par le nom style
                $prepare = $pdo->prepare($requete);//Préparation de la requête
                $prepare->execute(); // Exécution de la requête sql
                $resultat = $prepare->fetchAll(); // on stocke toutes les lignes dans un tableau 
                echo '<div class="contenu">';
                    foreach ($resultat as $style) { //On lit tout le tableau en bouclant avec la fonction Foreach
                            echo '<div class="SGA">';
                                echo '<p>' . htmlentities($style["style_name"], ENT_QUOTES) . '</p>'; // Affiche chaque style en protégeant la sortie avec la fonction htmlentities
                                echo '<form action="" method="POST">'
                                        . '<input type="hidden" name="style_id" value="' . htmlentities($style['style_id'], ENT_QUOTES) . '">' // Récupération de l'id du style que l'on veut modifier en mode caché 
                                        . '<input type="submit" class="image" name="update" value="Modifier">'
                                    . '</form>';
                                echo '<form action="style_delete.php" method="POST">'
                                            . '<input type="hidden" name="style_id" value="' . htmlentities($style['style_id'], ENT_QUOTES) . '">' // Récupération de l'id du style que l'on veut modifier en mode caché 
                                            . '<input type="submit" class="image" name="delete" value="Supprimer">'
                                    . '</form>';
                            echo '</div>';
                    }
                echo '</div>';

                if (isset($_POST['update'])) { //Condition si on appuit sur le bouton Modifier :

                    $styleId = $_POST['style_id'] ?? false; // On récupère l'id du style que l'on veut supprimer
                
                    //////////////////Affichage du style à modifier //////////
                    $requete = "SELECT * FROM `stylesCP` WHERE `style_id` = :style_id";
                    $prepare = $pdo->prepare($requete);//Préparation de la requête
                    $prepare->execute(array(
                        ":style_id" => $styleId
                    )); // Exécution de la requête sql
                    
                    $resultat = $prepare->fetch(); // Récupération du nombre de ligne affectée par la requete sql

                    
                    ////////////////// Choix association genre et style pour la modification //////////
                    $requete2 = "SELECT * FROM `genresCP` ORDER BY `genre_name`"; //Déclaration de la requête SQL de sélection de toute la table Genres trié par le nom genre
                    $prep = $pdo->prepare($requete2);//Préparation de la requête
                    $prep->execute(); // Exécution de la requête sql
                    $res = $prep->fetchAll();
                
    
            
            echo '<div class="resultat">'
                . '<h2>Modification du style</h2>'
                . '<form action="style_update.php" method="POST">'
                    . '<label>'
                    . '<h3>Nom du style :</h3>'
                    . '<input type="hidden" name="style_id_Up" value="' . htmlentities($resultat['style_id'], ENT_QUOTES) . '" required>'
                    . '<input type="text" name="style_name_Up" value="' . htmlentities($resultat['style_name'], ENT_QUOTES) . '" required>'
                    . '<select name="style_genre_id">';
                        foreach ($res as $genre) {
                            echo '<option value="' . htmlentities($genre['genre_id'], ENT_QUOTES) . '">' . htmlentities($genre['genre_name'], ENT_QUOTES) . '</option>';
                        }
                echo '</select>'
                    . '<input type="submit" value="Modifier">'
                . '</form>'
            . '</div';
            
            
            }
            ?>
        </div>
    </main>
    <footer>
        <p>Tous droits réservés à Cameron Findlay</p>
    </footer>
</body>
</html>