<?php 
/*
* Skapad av: Tobias Dahlberg
* Sida för samtliga artiklar för bloggprojekt
*/
?>

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php $page_title = "Artiklar";
include("includes/header.php"); ?>

<h2>Alla artiklar</h2>
<p>Här hittar du alla artiklar från samtliga bloggarna. Klicka för att läsa mer.</p>
<img src="images/head.jpg" class="mainimage" alt="Vacker vy vid Bodensjön Tyskland">

<?php                               //hämta lista via klassfunktion
$article = new Article();
$article_list = $article->getArticles();

foreach ($article_list as $a) {             //loopa hela listan för utskrift nedan. Visar 300 tecken, läs mer. 

?>
    <article>
        <h3><?= $a['title']; ?></h3>
        <p><?= substr($a['content'], 0, 300); ?>...</p>
        <p><a href="article.php?id=<?= $a['id']; ?>">Läs hela artikeln</a></p>
        <p><b>Publicerad: </b><?= $a['postade']; ?></p>
        <p>Av: <a href="blogger.php?name=<?= $a['name']; ?>"><?= $a['name'] . " " . $a['lastname']; ?></a></p>

    </article>
<?php
}
?>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>