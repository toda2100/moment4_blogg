<!-- sida för alla poster för bloggare Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php $page_title = "Blogger";          //hämta från User osv !!
include("includes/header.php"); ?>

<?php                               //hämta lista via klassfunktion
$article = new Article();
$article_list = $article->getArticleByUser('name');
echo "<h1>Alla artiklar av " . $_GET['name'] . "</h1>";

foreach ($article_list as $a) {             //loopa hela listan för utskrift nedan. Visar 300 tecken, läs mer. 
?>

    <article>
        <h3><?= $a['title']; ?></h3>
        <p><b>Publicerad: </b><?= $a['postade']; ?></p>
        <p><?= substr($a['content'], 0, 300); ?>...</p>
        <p><a href="article.php?id=<?= $a['id']; ?>">Läs hela artikeln</a></p>
        <p>Skriven av: <?= $a['name']; ?></p>
    </article>
<?php
}


?>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>