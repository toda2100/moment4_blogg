<!-- sida för admingränssnitt för bloggprojekt Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php
if (!isset($_SESSION['username'])) {
    header("Location: login.php?message=Du måste logga in eller skapa användarkonto först!");   //inleds med att se om inloggad, för det krävs för admin 
}
?>

<?php $page_title = "Login";

include("includes/header.php"); ?>    

<h1>Skapa nytt inlägg</h1>
<p>Skriva en artikel om Bodensee!</p>

<?php
$article = new Article();           //hämta klass

if (isset($_GET['deleteid'])) {             //vid borttagning av inlägg. Hämta på deleteid - kör klassfunktion deletearticle
    $id = intval($_GET['deleteid']);

    if ($article->deleteArticle($id)) {
        echo "<p>Artikel raderad</p>";
    } else {
        echo "<p>Fel vid radering</p>";
    }
}

// innehållet vid laddning, tomt. 
$title = "";
$content = "";

if (isset($_POST['title'])) {                       //hämta från inputfält 
    $title = $_POST['title'];
    $content = $_POST['content'];

    // $title = strip_tags($title);    // rensa från htmlkod 

    $success = true;    

    if (!$article->setTitle($title)) {          //funktion i klass för att sätta Titel. 
        $success = false;
        echo "<p>Ange titel</p>";
    }

    if (!$article->setContent($content)) {           //funktion i klass för att sätta innehållet. 
        $success = false;
        echo "<p>Ange innehåll</p>";
    }

    if ($success) {
        if ($article->addArticle($title, $content)) {    //funktion i klass för att lägga till informationen. med felmeddelanden. 
            echo "<p>Artikel tillagd</p>";
        } else {
            echo "<p>Fel vid lagring</p>";
        }
    } else {
        echo "<p>Fel vid lagring, kontrollera input</p>";
    }
}

?>

<article class="formsarea">                     
    <!-- formulär för input av innehållet och titel  -->
    <form method="post" action="admin.php">
        <label for="title">Titel</label><br>
        <input class="area" type="text" name="title" id="title" placeholder="Rubrik!"><br>
        <label for="content">Innehåll</label><br>
        <textarea class="textinput" type="text" name="content" id="content" placeholder="Din nyhet!"></textarea><br>
        <button class="btn" type="submit">Skapa nyhet</button>
    </form>
</article>



<?php                                //koppling till klass och hämta artiklarna för utskrift i adminlista. 
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

<a class="logout" href="logout.php">Logga ut</a>     

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>