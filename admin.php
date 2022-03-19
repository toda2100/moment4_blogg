<?php 
/*
* Skapad av: Tobias Dahlberg
* Sida för admingränssnitt för bloggprojekt
*/
?>

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php
if (!isset($_SESSION['username'])) {
    header("Location: login.php?message=Du måste logga in eller skapa användarkonto först!");   //inleds med att se om inloggad, för det krävs för admin 
}
?>

<?php $page_title = "Login";

include("includes/header.php"); ?>

<h2>Skapa nytt inlägg</h2>
<p>Skriv en artikel om Bodensee!</p>

<?php                                //Utskrift av vem som är inloggad via funktion. 

if (isset($_SESSION['username'])) {
    $user = new Users();                //hämta användarklass. 
    $username = $_SESSION['username'];
    $user = $user->getNameByUsername($username); 
    echo "<p>Hej " . $user . "!</p>";
} else {
    echo "Fel vid hämtning av ditt namn, sorry!";
}
?>

<?php
$article = new Article();           //hämta klass

// innehållet vid laddning, tomt. 
$title = "";
$content = "";

if (isset($_GET['deleteid'])) {            //vid borttagning av inlägg. Hämta på deleteid - kör klassfunktion deletearticle    
    $id = intval($_GET['deleteid']);

    if ($article->deleteArticle($id)) {
        echo "<p class='correct'>Artikel raderad</p>";
    } else {
        echo "<p class='error'>Fel vid radering</p>";
    }
}
?>

<?php
if (isset($_POST['title'])) {                       //hämta från inputfält 
    $title = $_POST['title'];
    $content = $_POST['content'];
    $username = $_SESSION['username']; //tillagd

    $title = strip_tags($title);    // rensa från htmlkod 
    $content = strip_tags($content, '<b><br><em>'); //$allowed_tags = ev. 

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
            $title = "";
            $content = "";
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
        <input class="area" type="text" name="title" id="title" value="<?= $title; ?>"><br>
        <label for="content">Innehåll *</label><br>
        <textarea class="textinput" name="content" id="content"><?= $content; ?></textarea><br>
        <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['username'] ?>"/>
        <button class="btn" type="submit">Skapa nyhet</button>
    </form>
    <p>* enbart b, br och em är tillåtna html-taggar i artikeln.</p>
</article>


<?php                                //koppling till klass och hämta artiklarna för utskrift i adminlista för inloggad användare. 
$article = new Article();
$article_list = $article->getArticlebyUsername($username);
$username = $_SESSION['username'];

foreach ($article_list as $b) {                 //rulla igenom hela array skriv ut nedan, med länk för att radera, begränsat med innehåll, samt läs mer. 
?>

    <article>
        <h3><?= $b['title']; ?></h3>
        <p><a href="edit.php?id=<?= $b['id']; ?>">Ändra inlägg</a></p> <!-- för att komma till editera  -->
        <p><?= substr($b['content'], 0, 150); ?>...</p>
        <p><a href="article.php?id=<?= $b['id']; ?>">Se hela inlägget</a></p>  <!-- för att kunna läsa hela  -->
        <p><a href="admin.php?deleteid=<?= $b['id']; ?>" onclick="return ConfirmDelete()">Radera inlägg</a></p> <!-- för att radera  -->
    </article>
<?php
}
?>

<a class="logout" href="logout.php">Logga ut</a>

<script>function ConfirmDelete() {   //kollar om inlägget verkligen ska raders innan det skickas 
  if (confirm("Radera inlägg?")){
          return true;
   }
    else {
       return false; 
    }
} </script> 

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>