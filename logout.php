<?php                   //förstör session. Kunde möjligen lagts i Users. 
session_start();
session_unset();
session_destroy();

header("Location: index.php");
exit();
