<?php
define("PAGE_TITLE", "accueil");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cameron Findlay, <?php echo PAGE_TITLE; ?></title>
    <meta name="description" content="Cameron Findlay, est une application web qui lui permettra de référencer l'ensemble des artistes présents dans son immense catalogue.">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="index.php">
            <img src="assets/logoCameron.png" alt="Logo Cameron Findlay">
        </a>
    </header>
    <main class="accueil">
        <a href="genres/genre_read.php">GENRES</a>
        <a href="styles/style_read.php">STYLES</a>
        <a href="artists/artist_read.php">ARTISTS</a>
  </main> 
  <footer>
        <p>Tous droits réservés à Cameron Findlay</p>
    </footer>
</body>
</html>