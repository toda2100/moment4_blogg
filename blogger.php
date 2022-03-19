<?php 
/*
* Skapad av: Tobias Dahlberg
* Sida för bloggarens artiklar för bloggprojekt
*/
?>

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php $page_title = $_GET['name'] ;          //
include("includes/header.php"); ?>

<?php                               //hämta lista via klassfunktion
$article = new Article();
$article_list = $article->getArticleByUser('name');
$name = $_GET['name'];

echo "<h2>Alla artiklar av " . $name . "</h2>";  //namn hämtas för rubrik

if (count($article_list) == 0) {                 //kolla så listan inte är tom. Dvs inga artiklar. 
    echo "<p class='error'>Bloggaren har inte börjat blogga!</p>";
}

foreach ($article_list as $a) {             //loopa hela listan för utskrift nedan. Visar 300 tecken, läs mer. 
?>

    <article>
        <h3><?= $a['title']; ?></h3>
        <p><b>Publicerad: </b><?= $a['postade']; ?></p>
        <p><?= substr($a['content'], 0, 300); ?>...</p>
        <p><a href="article.php?id=<?= $a['id']; ?>">Läs hela artikeln</a></p>
        <p>Av: <?= $a['name'] . " " . $a['lastname']; ?></p>   <!-- Vem om har skrivit -->
    </article>
<?php
}
?>

<?php
$back = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<a href='$back'>Föregående sida</a>";
?>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>