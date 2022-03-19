<?php 
/*
* Skapad av: Tobias Dahlberg
* konfigfil för huvudmeny bloggprojekt
*/
?>

<?php
    $site_title = "Livet vid Bodensee";
    $divider = " | ";
    
session_start(); //starta session

// if (session_status() == PHP_SESSION_NONE) {
//    session_start();
// }

spl_autoload_register(function($class_name) {   //autoinkl klasser via argument class_name-->
    include "classes/" . $class_name . ".class.php";
});


/* Databasinställningar */    
$dev = true;

if ($dev) {

error_reporting(-1);
ini_set("display_errors", 1); 

    define("DBHOST", "localhost");
    define("DBUSER", "root");    //"root"
    define("DBPASS", "");          // ""
    define("DBDATABASE", "bloggdb");
/* } else {
    define("DBHOST", "studentmysql.miun.se");
    define("DBUSER", "toda2100");
    define("DBPASS", "rKVhwHwMMx");
    define("DBDATABASE", "toda2100"); 
 */
}

?>