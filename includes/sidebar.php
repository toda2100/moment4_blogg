<!-- sektionsfil för sidomeny för bloggprojekt Tobias Dahlberg 2022 -->

</section><!-- /leftcontent -->

<section class="sidebar">
    <h2>Snabblänkar</h2>
    <!-- Sidebar, lista. Tillagd PHP-funktion för att kunna visa vilken sida man är på via CSS -->
    <ol>
        <li <?php if ($page_title == "Startsida") echo 'class="current"'; ?>><i class="fas fa-arrow-left"></i> <a <?php if ($page_title == "Startsida") echo 'class="current"'; ?> href="index.php">Senaste</a></li>
        <li <?php if ($page_title == "Artiklar") echo 'class="current"'; ?>><i class="fas fa-arrow-left"></i> <a <?php if ($page_title == "Artiklar") echo 'class="current"'; ?> href="articles.php">Bloggare</a></li>
        <?php
        if (isset($_SESSION['username']) && ($_SESSION['username'])) {          //visas om inloggad 
            echo '<a class="logout" href="logout.php">Logga ut</a>';
        }

        ?>
        <li <?php if ($page_title == "Om") echo 'class="current"'; ?>><i class="fas fa-arrow-left"></i> <a <?php if ($page_title == "Om") echo 'class="current"'; ?> href="about.php">Om</a></li>

    </ol>

<ol>
<li>Bloggare 1</li>
<li>Bloggare 2</li>
<li>Bloggare 3</li>
</ol>


</section>

