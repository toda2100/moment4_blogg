<!-- sida för att regga konto för bloggprojekt Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php $page_title = "Register"; ?>
<?php include("includes/header.php"); ?>

<h2>Registrera dig</h2>
<p>Sen kan du logga in och börja blogga!</p>   


<article class="formsarea">
    <!-- formulär för input av namn och lösen -->
    <form method="post" action="register.php">
        <label for="username">Användarnamn</label><br>
        <input class="area" type="text" name="username" id="username" placeholder="Minst 5 tecken!"><br>
        <label for="password">Lösenord</label><br>
        <input class="area" type="text" name="password" id="password" placeholder="Minst 5 tecken!"><br>

        <label for="firstname">Förnamn</label><br>
        <input class="area" type="text" name="firstname" id="firstname" placeholder="Minst 5 tecken!"><br>
        <label for="lastname">Efternamn</label><br>
        <input class="area" type="text" name="lastname" id="lastname" placeholder="Minst 5 tecken!"><br>
        
        <input class=checkbox type="checkbox" id="approve" name="approve">
        <label class=check for="approve">Godkänner att mina uppgifter lagras!</label>
        
        <button class="btn" type="submit">Skapa bloggare</button>
    </form>
</article>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>


