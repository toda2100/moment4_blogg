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

$page_title = $thearticle['title'];     
include("includes/header.php"); 
?>
<!-- Skriver utan från hämtat innehåll för specifik artikel -->
<article>
<h2><?=$thearticle['title'];?></h2>
<p><?=$thearticle['content'];?></p>
<p>Publicerad: <?=$thearticle['postade'];?></p>

</article>
<?php 
$back = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<a href='$back'>Föregående sida</a>";
?>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>