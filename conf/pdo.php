<?php

include "conf.php";
try {
  //----------------READ--------------
    $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
} //END TRY
catch (PDOException $e) {
  // en cas d'erreur, on récup et on affiche, grâce à notre try/catch
  echo "<pre>✖️ Erreur liée à la requête SQL :\n" . $e->getMessage() . "</pre>";
}//END CATCH
