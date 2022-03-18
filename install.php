<!-- sida för installation av databas för bloggprojekt Tobias Dahlberg 2022 -->

<?php
include("includes/config.php"); 

$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);       //ansluter till db
if($db->connect_errno > 0 ) {
die("Fel vid anslutning: " . $db->connect_error);
}

$sql = "DROP TABLE IF EXISTS articles, users;";        //SQL-frågor skapa tabell. Skapa koluner enligt nedan.

$sql .=  "                                          
CREATE TABLE articles(
id INT(11) PRIMARY KEY AUTO_INCREMENT,
title VARCHAR (128) NOT NULL,
content TEXT NOT NULL,
username VARCHAR (64) NOT NULL,          
postade TIMESTAMP NOT NULL DEFAULT current_timestamp()
);
";

$sql .=  "                                          
CREATE TABLE users(
id INT(11) PRIMARY KEY AUTO_INCREMENT,
username VARCHAR (64) UNIQUE NOT NULL,
password VARCHAR (128) NOT NULL,
name VARCHAR (128) NOT NULL,
lastname VARCHAR (128) NOT NULL
);
";

//skicka koppling mellan tabllerna, dvs username till username. Unikt i ena tabellen, dvs går inte att skapa artikel annars. Ej unikt i artikel - då fler artiklar skapas av samma person. 
$sql .= "ALTER TABLE articles ADD CONSTRAINT ID_ARTICLES_FK FOREIGN KEY (USERNAME) REFERENCES USERS (USERNAME);";

echo "<pre>$sql</pre>";           //visa på skärm          

if($db->multi_query($sql)) {        //skicka frågan(orna)
echo "Tabell skapad";
} else {
    echo "Fel vid skapande av tabell";
}


