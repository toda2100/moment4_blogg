<!-- sida för enskild post för bloggprojekt Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php

$article = new Article(); //koppla till klass 

if (isset($_GET['id'])) {        //kontrollera om id finns så det inte går att komma hit om bortagen. 
    $id = intval($_GET['id']);
    $thearticle = $article->getArticleById($id);  //hämta info om artikel via Id-funktion
} else {
    header("Location: index.php");
}

$user = new Users();            //hämta och koppla på information om vem som skrivit. 
$username = $thearticle['username'];
$name = $user->getNameByUsername($username);

$page_title = $thearticle['title'];
include("includes/header.php");
?>
<!-- Skriver utan från hämtat innehåll för specifik artikel -->
<article>
    <h2><?= $thearticle['title']; ?></h2>
    <p><?= $thearticle['content']; ?></p>
    <p>Publicerad: <?= $thearticle['postade']; ?></p>
    <p>Skriven av: <?= $name ?></p>

</article>

<h3>Fler artiklar från <?= $name ?></h3>   
<!-- Skriver utan om bloggaren har fler artiklar -->
<?php
$username = $thearticle['username'];
$article_list = $article->getArticlebyUsername($username);

if (count($article_list) == 0) {                 //kolla så listan inte är tom. Dvs inga artiklar. 
    echo "<p class='error'>Inga artiklar är publicerade!</p>";
}

$article_list = array_slice($article_list, 0, 3);

foreach ($article_list as $b) {                 //rulla igenom hela array skriv ut nedan, med länk för att radera, begränsat med innehåll, samt läs mer. 
?>

    <article>
        <h3><?= $b['title']; ?></h3>
        <p><?= substr($b['content'], 0, 50); ?>...</p>
        <p><a href="article.php?id=<?= $b['id']; ?>">Se hela inlägget</a></p>
        <p>Skriven av: <?= $name ?></p>
    </article>

<?php
}
?>

<?php

$back = htmlspecialchars($_SERVER['HTTP_REFERER']);  //skickar tillbaka till föregående sida. 
echo "<a href='$back'>Föregående sida</a>";
?>



<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>