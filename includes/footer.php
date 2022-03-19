<!-- sektionsfil för footer för bloggprojekt Tobias Dahlberg 2022 -->

<footer class="mainfooter">
    <p>Webbplatsen är framtagen under kursen Webbutveckling 2 vid Mittuniversitetet</p>

    <?php
    $name = "Tobias";
    $email = "tobiasdahlberg80@gmail.com";
    echo "<p>Kontakt <a href= 'mailto:$email'> $email</a></p>";
    ?>

    <a href="about.php">Om webbplatsen</a>

    <?php                   //visa olika om inloggad eller inte. 
    if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
        echo '<a href="login.php"><b>Logga in</b></a>';
    } else {
        echo  '<a href="logout.php"><b>Logga ut</b></a>';
    }

    ?>


</footer><!-- /mainfooter -->
</div><!-- /container -->

 <!-- <script src="js/main.js"></script>  -->
</body>

</html>