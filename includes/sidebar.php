<?php 
/*
* Skapad av: Tobias Dahlberg
* sektionsfil för sidomeny bloggprojekt
*/
?>

</section><!-- /leftcontent -->

<section class="sidebar">
    <h2>Snabblänkar</h2>
    <!-- Sidebar, lista. Tillagd PHP-funktion för att kunna visa vilken sida man är på via CSS -->
    <ol>
        <li <?php if ($page_title == "Startsida") echo 'class="current"'; ?>><i class="fas fa-arrow-left"></i> <a <?php if ($page_title == "Startsida") echo 'class="current"'; ?> href="index.php">Senaste</a></li>
        <li <?php if ($page_title == "Artiklar") echo 'class="current"'; ?>><i class="fas fa-arrow-left"></i> <a <?php if ($page_title == "Artiklar") echo 'class="current"'; ?> href="articles.php">Artiklar</a></li>
        <li <?php if ($page_title == "Om") echo 'class="current"'; ?>><i class="fas fa-arrow-left"></i> <a <?php if ($page_title == "Om") echo 'class="current"'; ?> href="about.php">Om</a></li>
    </ol>


    <?php                                //Utskrift av vem som är inloggad 

    if (isset($_SESSION['username'])) {
        $user = new Users();
        $username = $_SESSION['username'];
        $user = $user->getNameByUsername($username);
        echo "<p><b>Inloggad som: </b>" . "<br>" . $user . "</p>";
    } else {
        echo "Registrera dig för att börja blogga!";
    }
    ?>

    <h2>Våra bloggare</h2>

    <?php

    $blogger = new Users();        //Utskrift av alla bloggare med länk till deras sidor via unikt namn
    $blogger_list = $blogger->getUsersByName();

    if (count($blogger_list) == 0) {                 //kolla så listan inte är tom. Dvs inga artiklar. 
        echo "<p class='error'>Inga bloggare är registrerade ännu!</p>";
    }

    foreach ($blogger_list as $b) {
    ?>
    <!-- Skriver ut även indikera vilken bloggares sida besökaren är på -->
        <ol>
            <li <?php if ($page_title == $b['name']) echo 'class="current"'; ?>><i class="fas fa-user"></i> <a <?php if ($page_title == $b['name']) echo 'class="current"'; ?> href="blogger.php?name=<?= $b['name']; ?>"><?= $b['name'] . " " . $b['lastname']; ?></a></li>

        </ol>
    <?php
    }
    ?>


</section>