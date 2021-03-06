<?php 
/*
* Skapad av: Tobias Dahlberg
* Sida för edit artiklar för bloggprojekt
*/
?>

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php
if (!isset($_SESSION['username'])) {
    header("Location: login.php?message=Du måste logga in eller skapa användarkonto först!");   //inleds med att se om inloggad, för det krävs för admin 
}
?>

<?php  //kolla om vi har ett inlägg att ändra
$article = new Article();           //hämta klass

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if (isset($_POST['title'])) {                       //hämta från inputfält 
        $title = $_POST['title'];
        $content = $_POST['content'];

        $title = strip_tags($title);    // rensa från htmlkod 
        $content = strip_tags($content, '<b><br><em>'); //$allowed_tags

        $success = true;
        $message = "";

        if (!$article->setTitle($title)) {          //funktion i klass för att sätta Titel. 
            $success = false;
            $message .= "<p class='error'>Ange titel</p>";
        }

        if (!$article->setContent($content)) {           //funktion i klass för att sättainnehållet. 
            $success = false;
            $message .=  "<p class='error'>Ange innehåll</p>";
        }

        if ($success) {
            if ($article->updateArticle($id, $title, $content)) {    //funktion i klass för att ändra informationen. med felmeddelanden. 
                $message .=  "<p class='correct'>Ändring genomförd</p>";
            } else {
                $message .=  "<p class='error'>Fel vid lagring</p>";
            }
        } else {
            $message .=  "<p class='error'>Fel vid lagring, kontrollera input</p>";
        }
    }

    $articleinfo = $article->getArticleById($id);   //hämta info och lagra i var.

} else {
    header("Location:admin.php");
}
?>

<?php $page_title = "Ändra i" . $articleinfo['title']; //hämtar från sparat 

include("includes/header.php"); ?>

<h2>Ändra inlägg <?= $articleinfo['title'] ?></h2>   <!-- Hämtar info från sparad artikel -->
<p>Gör ändringar och spara på nytt.</p>

<?php
if (isset($message)) {
    echo $message;
}
?>

<article class="formsarea">
    <!-- formulär för input av innehållet och titel  -->
    <form method="post" action="edit.php?id=<?= $id; ?>">
        <label for="title">Titel</label><br>
         <input class="area" type="text" name="title" id="title" value="<?= $articleinfo['title']; ?>"><br>  <!-- Hämtar info från sparad artikel -->
        <label for="content">Innehåll</label><br>
        <textarea class="textinput" name="content" id="content"><?= $articleinfo['content']; ?></textarea><br> <!-- Hämtar info från sparad artikel -->
        <button class="btn" type="submit">Bekräfta ändring</button>
    </form>
    <p>* enbart b, br och em är tillåtna html-taggar i artikeln.</p>
</article>

<?php

$back = htmlspecialchars($_SERVER['HTTP_REFERER']);  //skickar tillbaka till föregående sida. 
echo "<a href='$back'>Tillbaka</a>";
?>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>