<!-- sida för alla poster för bloggprojekt Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php $page_title = "Artiklar";
include("includes/header.php"); ?>

<h1>Alla artiklar</h1>
<p>Klicka för att läsa hela artikeln.</p>


<?php                               //hämta lista via klassfunktion
$article = new Article();
$article_list = $article->getArticles();            

foreach ($article_list as $a) {             //loopa hela listan för utskrift nedan. Visar 300 tecken, läs mer. 

$date =  $a['postade'];
$myDateTime = DateTime::createFromFormat('Y-m-d h:i:s', $date);
$newDate = $myDateTime->format('y-m-d h:i');


?>
    <article>
        <h3><?= $a['title']; ?></h3>
        <p><b>Publicerad: </b><?= $newDate; ?></p>
        <p><?= substr($a['content'], 0, 300); ?>...</p>
        <p><a href="article.php?id=<?= $a['id']; ?>">Läs hela artikeln</a></p>
        <p>Av: <a href="blogger.php?name=<?= $a['name']; ?>"></b><?= $a['name']; ?></a></p>

    </article>
<?php
}
?>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>