<!-- sektionsfil för sidomeny för bloggprojekt Tobias Dahlberg 2022 -->

</section><!-- /leftcontent -->

<section class="sidebar">
    <h2>Snabblänkar</h2>
    <!-- Sidebar, lista. Tillagd PHP-funktion för att kunna visa vilken sida man är på via CSS -->
    <ol>
        <li <?php if ($page_title == "Startsida") echo 'class="current"'; ?>><i class="fas fa-arrow-left"></i> <a <?php if ($page_title == "Startsida") echo 'class="current"'; ?> href="index.php">Senaste</a></li>
        <li <?php if ($page_title == "Artiklar") echo 'class="current"'; ?>><i class="fas fa-arrow-left"></i> <a <?php if ($page_title == "Artiklar") echo 'class="current"'; ?> href="articles.php">Bloggare</a></li>       
        <li <?php if ($page_title == "Om") echo 'class="current"'; ?>><i class="fas fa-arrow-left"></i> <a <?php if ($page_title == "Om") echo 'class="current"'; ?> href="about.php">Om</a></li>
        <?php
        if (isset($_SESSION['username']) && ($_SESSION['username'])) {          //visas om inloggad 
            echo '<a class="logout" href="logout.php">Logga ut</a>';
        }

        ?>

    </ol>

<!-- <ol>
<li>Bloggare 1</li>
<li>Bloggare 2</li>
<li>Bloggare 3</li>
</ol> -->

<?php

$blogger = new Users();
$blogger_list = $blogger->getUsers();

foreach ($blogger_list as $b) {
    ?>

<ol>
<li><?= $b['name']; ?></li>
</ol>
    <?php
}
?>

</section>

<section>
<?php
$article = new Article();                       //hämta artiklar. 
$article_list = $article->getArticles();

if(count($article_list) == 0) {                 //kolla så listan inte är tom. Dvs inga artiklar. 
    echo "<p class='error'>Inga bloggare är registrerade ännu!</p>";
} 
                
foreach ($article_list as $a) {                         //liten loop för de två. Skriver ut 300 tecken ca, samt läs mer.  

?>
    <ol>

        <li><a href="blogger.php?name=<?= $a['name']; ?>"></b><?= $a['name']; ?></a></li>
        
</ol>

<?php
}
?>
</section>
