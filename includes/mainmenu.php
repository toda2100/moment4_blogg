<?php 
/*
* Skapad av: Tobias Dahlberg
* sektionsfil för huvudmeny bloggprojekt
*/
?>

 <nav class="mainmenu">
     <!-- Enbart meny och dess beståndsdelar -->
     <ul>
         <li><a href="index.php">Senaste</a></li>
         <li><a href="articles.php">Artiklar</a></li>
         <?php
            if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {            //visa olika om ej inlogg eller inloggad. 
                echo '<li><a href="login.php">Logga in</a></li>';
            } else {
                echo  '<li><a href="admin.php">Admin</a></li>';
            } ?>

         <?php
            if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {            //visa olika om ej inlogg eller inloggad. 
                echo '<li><a href="register.php">Registrera</a></li>';
            } else {
                echo '<li><a href="logout.php">Logga ut</a></li>';
            } ?>



     </ul>
 </nav>