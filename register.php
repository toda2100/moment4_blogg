<!-- sida för att regga konto för bloggprojekt Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->
<!-- (if session - index? ) -->

<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['firstname'];

    $users = new Users();
    if ($users->usernameExists($username)) {
        $message = "<p>Användarnamn finns redan</p>";
    } else {
        if ($users->registerUser($username, $password, $name)) {
            $message = "<p>Användare tillagd!</p>";
        } else {
            $message = "<p>Fel uppstod, försök igen!</p>";
        }
    }
}
?>

<?php $page_title = "Register"; ?>
<?php include("includes/header.php"); ?>

<h2>Registrera dig</h2>
<p>Sen kan du logga in och börja blogga!</p>

<?php
if (isset($message)) {
    echo $message;
} //skriv ut meddelande vid fel 
?>

<article class="formsarea">
    <!-- formulär för input av namn och lösen -->
    <form method="post" action="register.php">

        <label for="username">Användarnamn</label><br>
        <input class="area" type="text" name="username" id="username" placeholder="Minst 5 tecken!" required><br>
        <label for="password">Lösenord</label><br>
        <input class="area" type="text" name="password" id="password" placeholder="Minst 5 tecken!" required><br>

        <label for="firstname">Förnamn</label><br>
        <input class="area" type="text" name="firstname" id="firstname" placeholder="Minst 5 tecken!" required><br>
        <!-- <label for="lastname">Efternamn</label><br>
        <input class="area" type="text" name="lastname" id="lastname" placeholder="Minst 5 tecken!"><br>
         -->
        <input class=checkbox type="checkbox" id="approve" name="approve"> <!-- onchange="approve()" -->
        <label class=check for="approve">Godkänner att mina uppgifter lagras!</label>
        <button class="btn" type="submit" id="submituser">Skapa bloggare</button> <!-- disabled -->
    </form>
</article>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>




<!-- string password_hash (string $password, int $algo [, array $options]) -->