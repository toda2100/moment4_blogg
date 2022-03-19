<?php 
/*
* Skapad av: Tobias Dahlberg
* Sida för "om webbplatsen" för bloggprojekt
*/
?>

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php $page_title = "Om";
include("includes/header.php"); ?>
<article>
    <h2>Dela med dig av dina tips!</h2>
    <p>Här kan du hitta eller dela med dig av tips på upplevelser, sevärdheter eller andra tips runt Bodensee, Bodensjön, i södra Tyskland</p>

    <img src="images/vy.jpg" class="mainimage" alt="Vacker vy vid Bodensjön Tyskland">

</article>
<article>
    <h2>Om webbplatsen</h2>
    <p>Vi använder dina sparade uppgifter enbart för att du ska kunna hantera och skapa inlägg. Ta kontakt för att ta bort ditt konto.</p>
    <p>Cookies nyttjas för att spara sessioner när du är inloggad för att förbättra upplevselsen.</p>
    <p>Webbplatsen är framtagen under utbildningen Webbutvekling på Mittuniversitetet.</p>
</article>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>