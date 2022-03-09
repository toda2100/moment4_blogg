<!-- loginsida för bloggprojekt Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php if(isset($_POST['username'])) {
    $username = $_POST ['username'];
    $password = $_POST ['password'];

if($username == "skribent" && $password == "letmein1") {  //hårdkodad, annars till databas går också, med olika typer av inloggade osv. 
    $_SESSION['username'] = $username;
    header("Location: admin.php");
}         else {
    $message = "Felaktigt användarnamn eller lösenord";
}                       
} 
?>

<?php $page_title = "Login"; ?>
<?php include("includes/header.php"); ?>

<h2>Logga in</h2>
<p>Logga in för att hantera artiklar.</p>   

<?php if(isset($_GET['message'])) {                                 //felmeddelanden 
    echo "<p style=color:red;>" . $_GET['message'] . "</p>";
}

if(isset($message)) {
    echo "<p style=color:red;>" . $message . "</p>";
}
?>

<article class="formsarea">
    <!-- formulär för input av namn och lösen -->
    <form method="post" action="login.php">
        <label for="username">Namn</label><br>
        <input class="area" type="text" name="username" id="username" placeholder="Minst 5 tecken!"><br>
        <label for="password">Lösenord</label><br>
        <input class="area" type="text" name="password" id="password" placeholder="Minst 5 tecken!"><br>
        <button class="btn" type="submit">Skicka</button>
    </form>
</article>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>


