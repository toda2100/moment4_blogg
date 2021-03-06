<?php 
/*
* Skapad av: Tobias Dahlberg
* Sida för regga användare för bloggprojekt
*/
?>

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php
$users = new Users();           //initiera klass 
if (isset($_POST['username'])) {   //kolla finns något i input
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $success = true; //start, går vidare om sant. Annars felmeddelanden. 

    if ($users->usernameExists($username)) {                    //kolla om användarnamn är taget. 
        $success = false;
        $message = "<p class='error'>Användarnamn finns redan</p>";
    }

    if (!$users->setUsername($username)) {          //funktion i klass för att sätta Titel. 
        $success = false;
        $message =  "<p class='error'>Ange användarnamn med minst 5 tecken</p>";
    }

    if (!$users->setPassword($password)) {           //funktion i klass för att sätta innehållet. 
        $success = false;
        $message =  "<p class='error'>Ange lösenord med minst 5 tecken</p>";
    }

    if (!$users->setName($name)) {           //funktion i klass för att sätta innehållet. 
        $success = false;
        $message =  "<p class='error'>Ange förnamn med minst 3 tecken och inga mellanslag</p>";
    }

    if (!$users->setLastName($lastname)) {           //funktion i klass för att sätta innehållet. 
        $success = false;
        $message =  "<p class='error'>Ange efternamn med minst 5 tecken och inga mellanslag</p>";
    }

    if ($success) {
        if ($users->registerUser($username, $password, $name, $lastname)) {    //funktion i klass för att lägga till informationen. med felmeddelanden. 
            $message =  "<p class='correct'>Användare tillagd, <a href='login.php'>logga in här!</a></p>";
        } else {
            $message =  "<p class='error'>Fel vid lagring</p>";
        }
    } else {
        $messagecontroll =  "<p class='error'>Fel vid lagring, kontrollera input</p>";
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
}

if (isset($messagecontroll)) {
    echo $messagecontroll;
}

//skriv ut meddelanden ovan vid fel 
?>

<article class="formsarea">
    <!-- formulär för input av namn och lösen -->
    <form method="post" action="register.php">

        <label for="username">Användarnamn</label><br>
        <input class="area" type="text" name="username" id="username" placeholder="Används till inloggning!"><br>
        <label for="password">Lösenord</label><br>
        <input class="area" type="text" name="password" id="password" placeholder="Minst 5 tecken!"><br>
        <label for="firstname">Förnamn</label><br>
        <input class="area" type="text" name="firstname" id="firstname" placeholder="Minst 3 tecken, inga mellanslag!"><br>
        <label for="lastname">Efternamn</label><br>
        <input class="area" type="text" name="lastname" id="lastname" placeholder="Minst 5 tecken, inga mellanslag!"><br>
        <div>
            <input class=checkbox type="checkbox" id="approve" name="approve" onchange="approve()"> <!-- disbaled, öppnas med javascript -->
            <label class=check for="approve">Godkänner att mina uppgifter lagras!</label>
            <button class="btn" type="submit" id="submituser" disabled>Skapa bloggare</button>
        </div>

    </form>

    <noscript>
        <p>Du måste ha Javascript påslaget för att logga in!</p> <!-- Om JS är avstängt. -->
    </noscript>

</article>

<script>
    let approve = document.getElementById('approve');
    let submituser = document.getElementById('submituser');
    approve.onchange = function() {
        submituser.disabled = !this.checked;
    };
</script>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>