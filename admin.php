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
<p>Skriv en artikel om Bodensee!</p>

<?php                                //Utskrift av vem som är inloggad 

if (isset($_SESSION['username'])) {
$user = new Users();
$username = $_SESSION['username'];
$user = $user->getNameByUsername($username);
echo "<p>Hej " . $user . "!</p>";
} else {
    echo "fel";
}
?>

<?php
$article = new Article();           //hämta klass

// innehållet vid laddning, tomt. 
$title = "";
$content = "";

if (isset($_GET['deleteid'])) {             //vid borttagning av inlägg. Hämta på deleteid - kör klassfunktion deletearticle
    $id = intval($_GET['deleteid']);

    if ($article->deleteArticle($id)) {
        echo "<p class='correct'>Artikel raderad</p>";
    } else {
        echo "<p class='error'>Fel vid radering</p>";
    }
}

if (isset($_POST['title'])) {                       //hämta från inputfält 
    $title = $_POST['title'];
    $content = $_POST['content'];
    $username = $_SESSION['username']; //tillagd


    $title = strip_tags($title);    // rensa från htmlkod 
    $content = strip_tags($content, '<b><br>'); //$allowed_tags = ev. 

    $success = true;    

    if (!$article->setTitle($title)) {          //funktion i klass för att sätta Titel. 
        $success = false;
        echo "<p class='error'>Ange titel</p>";
    }

    if (!$article->setContent($content)) {           //funktion i klass för att sätta innehållet. 
        $success = false;
        echo "<p class='error'>Ange innehåll</p>";
    }

    if ($success) {
        if ($article->addArticle($title, $content, $username)) {    //funktion i klass för att lägga till informationen. med felmeddelanden. 
            echo "<p class='correct'>Artikel tillagd</p>";
            $title = ""; $content = "";
        } else {
            echo "<p class='error'>Fel vid lagring</p>";
        }
    } else {
        echo "<p class='error'>Fel vid lagring, kontrollera input</p>";
    }
}

?>

<article class="formsarea">                     
    <!-- formulär för input av innehållet och titel  -->
    <form method="post" action="admin.php">
        <label for="title">Titel</label><br>
        <input class="area" type="text" name="title" id="title" value="<?= $title;?>"><br>
        <label for="content">Innehåll</label><br>
        <textarea class="textinput" type="text" name="content" id="content" value="<?= $content;?>"></textarea><br>   
        <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['username'] ?>" readonly />   
        <button class="btn" type="submit">Skapa nyhet</button>
    </form>
</article>


<?php                                //koppling till klass och hämta artiklarna för utskrift i adminlista. //placeholder="Din nyhet!"
$article = new Article();
$article_list = $article->getArticlebyUsername($username);
$username = $_SESSION['username'];

foreach ($article_list as $b) {                 //rulla igenom hela array skriv ut nedan, med länk för att radera, begränsat med innehåll, samt läs mer. 
?>

    <article>
        <h3><?= $b['title']; ?></h3>           
        <p><a href="admin.php?deleteid=<?= $b['id']; ?>">Radera inlägg</a></p>
        <p><a href="edit.php?id=<?= $b['id']; ?>">Ändra inlägg</a></p>
        <p><?= substr($b['content'], 0, 150); ?>...</p>
        <p><a href="article.php?id=<?= $b['id']; ?>">Se hela inlägget</a></p>
    </article>
<?php
}
?> 

<a class="logout" href="logout.php">Logga ut</a>     

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>



