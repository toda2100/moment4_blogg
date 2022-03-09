 <!-- sektionsfil för mainmenu för bloggprojekt Tobias Dahlberg 2022 -->

 <nav class="mainmenu">
     <!-- Enbart meny och dess beståndsdelar -->
     <ul>
         <li><a href="index.php">Senaste</a></li>
         <li><a href="articles.php">Bloggare</a></li>
         <?php
            if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {            //visa olika om ej inlogg eller inloggad. 
                echo '<li><a href="login.php">Logga in</a></li>';
            } else {
                echo  '<li><a href="admin.php">Admin</a></li>';
            } ?>
          <li><a href="register.php">Registrera</a></li>  
     </ul>
 </nav>