<!-- startsida för bloggprojekt Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php $page_title = "Startsida";
include("includes/header.php"); ?>

<h1>Senaste artiklarna hittar du här.</h1>
<p>Klicka för alla läsa mer eller se alla artiklar under fliken artiklar</p>

<section>
<?php
$article = new Article();                       //hämta artiklar. 
$article_list = $article->getArticles();

if(count($article_list) == 0) {                 //kolla så listan inte är tom. Dvs inga artiklar. 
    echo "<p class='error'>Inga artiklar är publicerade!</p>";
} 
                
$article_list = array_slice($article_list, 0, 4);           // välj enbart de senaste i arrayen för att loopa till utskrift

foreach ($article_list as $a) {                         //liten loop för de två. Skriver ut 300 tecken ca, samt läs mer.  

?>
    <article>

        <h3><?= $a['title']; ?></h3>                    
        <p><b>Publicerad: </b><?= $a['postade']; ?></p>
        <p><?= substr($a['content'], 0, 300); ?>...</p>
        <p><a href="article.php?id=<?= $a['id']; ?>">Läs mer</a></p>
        <!-- Bloggarens namn med länk till sida där alla finns -->
   
    </article>

<?php
}

?>


</section>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>

