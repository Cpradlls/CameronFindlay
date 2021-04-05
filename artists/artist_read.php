<?php
define("PAGE_TITLE", "Artists");
include "../conf/conf.php";
function afficheArtists()
{  
    try {
        //----------------LECTURE--------------
          $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
          $requete = "SELECT * FROM `artistsCP`;";
          $prepare = $pdo->prepare($requete);
          $prepare->execute();
          $resultat = $prepare->fetchAll();
          return $resultat;
      } //FIN DE L'ESSAI
      catch (PDOException $e) {
        // en cas d'erreur, on récup et on affiche, grâce à notre try/catch
        echo "<pre>✖️ Erreur liée à la requête SQL :\n" . $e->getMessage() . "</pre>";
      }//FIN DE CATCH
}
$listArtist = afficheArtists();

function artistStyles($artistId)
{   
    try {
        //----------------READ--------------
            $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
            $requete = "SELECT * FROM `stylesCP`
            JOIN assoc_artists_stylesCP ON assoc_style_id = style_id
            WHERE assoc_artist_id = :artist_id;";
            $prepare = $pdo->prepare($requete);
            $prepare->execute(array(
                ':artist_id' => $artistId
            ));
            $resultat = $prepare->fetchAll();
            return $resultat;
        } //END TRY
        catch (PDOException $e) {
        // en cas d'erreur, on récup et on affiche, grâce à notre try/catch
        echo "<pre>✖️ Erreur liée à la requête SQL :\n" . $e->getMessage() . "</pre>";
        }//END CATCH
}
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
        <h1>ARTISTS</h1>
        <div class="add">
            <a class="btnAdd" href="artist_add.php">Ajouter un nouvel artist</a>
        </div>
        <div class="conteneur">
            <?php
                echo '<div class="contenu">';
                    foreach($listArtist as $key => $value) {
                        echo '<div class="SGA"';
                            $styles = artistStyles($value['artist_id']);
                            echo '<p> Artist : ' . htmlentities($value['artist_name'], ENT_QUOTES) . '</p>';
                            echo '<form action="" method="POST">'
                                    . '<input type="hidden" name="artist_id" value="' . htmlentities($value['artist_id'], ENT_QUOTES) . '">' // Récupération de l'id du genre que l'on veut modifier en mode caché 
                                    . '<input type="submit" class="image" name="update" value="Modifier">'
                                . '</form>';
                            echo '<form action="artist_delete.php" method="POST">'
                                    . '<input type="hidden" name="artist_id" value="' . htmlentities($value['artist_id'], ENT_QUOTES) . '">' // Récupération de l'id du genre que l'on veut modifier en mode caché 
                                    . '<input type="submit" class="image" name="delete" value="Supprimer">'
                                . '</form>';
                            echo '<p>Styles : ';
                                foreach ($styles as $key => $value) {
                                    echo htmlentities($value['style_name'], ENT_QUOTES) . ' ';
                                }
                            echo "</p>";
                        echo "</div>";
                    }
                echo "</div>";
                

                if (isset($_POST['update'])) { //Condition si on appuit sur le bouton Modifier :

                    $artistId = $_POST['artist_id'] ?? false; // On récupère l'id de l'Artist que l'on veut supprimer
                
                    //////////////////Affichage de l'Artist à modifier //////////
                    try {
                        //----------------LECTURE--------------
                        $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
                        $requete = "SELECT * FROM `artistsCP` WHERE `artist_id` = :artist_id";
                        $prepare = $pdo->prepare($requete);//Préparation de la requête
                        $prepare->execute(array(
                            ":artist_id" => $artistId
                        )); // Exécution de la requête sql
                        
                        $resultat = $prepare->fetch(); // Récupération du nombre de ligne affectée par la requete sql
                    } //END TRY
                    catch (PDOException $e) {
                        // en cas d'erreur, on récup et on affiche, grâce à notre try/catch
                        echo "<pre>✖️ Erreur liée à la requête SQL :\n" . $e->getMessage() . "</pre>";
                    }//END CATCH
                
    
            
            echo '<div class="resultat">'
                . '<h2>Modification de l\'artist</h2>'
                . '<form action="artist_update.php" method="POST">'
                    . '<label>'
                    . '<h3>Nom de l\'artist :</h3>'
                    . '<input type="hidden" name="artist_id_Up" value="' . htmlentities($resultat['artist_id'], ENT_QUOTES) . '">'
                    . '<input type="text" name="artist_name_Up" value="' . htmlentities($resultat['artist_name'], ENT_QUOTES) . '" required>'
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