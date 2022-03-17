<?php                                //koppling till klass och hämta artiklarna för utskrift i adminlista. //placeholder="Din nyhet!"
$article = new Article();
$article_list = $article->getArticles();

foreach ($article_list as $a) {                 //rulla igenom hela array skriv ut nedan, med länk för att radera, begränsat med innehåll, samt läs mer. 
?>

    <article>
        <h3><?= $a['title']; ?></h3>           
        <p><a href="admin.php?deleteid=<?= $a['id']; ?>">Radera inlägg</a></p>
        <p><a href="edit.php?id=<?= $a['id']; ?>">Ändra inlägg</a></p>
        <p><?= substr($a['content'], 0, 150); ?>...</p>
        <p><a href="article.php?id=<?= $a['id']; ?>">Se hela inlägget</a></p>
    </article>
<?php
}
?> 