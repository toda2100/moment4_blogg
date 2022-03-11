<!-- sida för alla poster för bloggare Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php $page_title = "Blogger";          //hämta från User osv !!
include("includes/header.php"); ?>

<h1>Alla artiklar från XX hämta in! USER</h1>

<?php                               //hämta lista via klassfunktion
$article = new Article();
$article_list = $article->getArticles();            

foreach ($article_list as $a) {             //loopa hela listan för utskrift nedan. Visar 300 tecken, läs mer. 
?>
    <article>
        <h3><?= $a['title']; ?></h3>
        <p><b>Publicerad: </b><?= $a['postade']; ?></p>
        <p><?= substr($a['content'], 0, 300); ?>...</p>
        <p><a href="article.php?id=<?= $a['id']; ?>">Läs hela artikeln</a></p>
    </article>
<?php
}
?>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>