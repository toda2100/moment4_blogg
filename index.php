<!-- startsida för bloggprojekt Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php $page_title = "Startsida";
include("includes/header.php"); ?>

<h1>Senaste inläggen</h1>
<p>Klicka för att läsa mer eller se alla inlägg under fliken <a href="articles.php">artiklar.</a></p>

<section>
<?php
$article = new Article();                       //hämta artiklar. 
$article_list = $article->getArticles();

if(count($article_list) == 0) {                 //kolla så listan inte är tom. Dvs inga artiklar. 
    echo "<p class='error'>Inga artiklar är publicerade!</p>";
} 
                
$article_list = array_slice($article_list, 0, 5);           // välj enbart de senaste i arrayen för att loopa till utskrift

foreach ($article_list as $a) {                         //liten loop för de två. Skriver ut 300 tecken ca, samt läs mer.  

?>
    <article>

        <h3><?= $a['title']; ?></h3>                    
        <p><b>Publicerad: </b><?= $a['postade']; ?></p>
        <p><?= substr($a['content'], 0, 300); ?>...</p>
        <p><a href="article.php?id=<?= $a['id']; ?>">Läs mer</a></p>
        <p>Av: <a href="blogger.php?name=<?= $a['name']; ?>"></b><?= $a['name']; ?></a></p>
   
    </article>

<?php
}
?>

<a href="articles.php">Se alla artiklar</a>

</section>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>

