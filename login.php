<!-- loginsida för bloggprojekt Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php if (isset($_POST['username'])) {   //kontrollera om det finns input 
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = new Users();

    if ($users->login($username, $password)) {              //skickas till adminn om ok. 
        header("Location: admin.php");
    } else {
        $message = "<p class='error'>Felaktigt användarnamn eller lösenord</p>";
    }
}
?>

<?php $page_title = "Login"; ?>
<?php include("includes/header.php"); ?>

<h2>Logga in</h2>
<p>Logga in för att hantera artiklar.</p>

<?php if (isset($_GET['message'])) {                                 //felmeddelanden vi fel lösen osv. 
    echo "<p class='error'>" . $_GET['message'] . "</p>";
}

if (isset($message)) {
    echo "$message";
}
?>

<article class="formsarea">
    <!-- formulär för input av namn och lösen -->
    <form method="post" action="login.php">
        <label for="username">Användarnamn</label><br>
        <input class="area" type="text" name="username" id="username" placeholder="Minst 5 tecken!"><br>
        <label for="password">Lösenord</label><br>
        <input class="area" type="password" name="password" id="password" placeholder="Minst 5 tecken!"><br>
        <button class="btn" type="submit">Logga in</button>
    </form>
</article>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>