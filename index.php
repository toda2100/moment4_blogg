<!-- startsida för bloggprojekt Tobias Dahlberg 2022 -->

<?php include("includes/config.php"); ?>
<!-- inkluderar konfiguartionsfil till header/varje sida -->

<?php $page_title = "Startsida";
include("includes/header.php"); ?>

<h1>Välkommen till södra Tyskland!</h1>
<p>Här kan du hitta eller dela med dig av tips på upplevelser, sevärdheter eller andra tips runt Bodensee, Bodensjön, i södra Tyskland.</a></p>

<img src="images/about.jpg" class="mainimage" alt="Vacker vy vid Bodensjön Tyskland">

<h2>Senaste inläggen</h2>
<p>Klicka för att läsa mer eller se alla inlägg under fliken <a href="articles.php">artiklar.</a></p>

<section>
    <?php
    $article = new Article();                       //hämta artiklar. 
    $article_list = $article->getArticles();

    if (count($article_list) == 0) {                 //kolla så listan inte är tom. Dvs inga artiklar. 
        echo "<p class='error'>Inga artiklar är publicerade!</p>";
    }

    $article_list = array_slice($article_list, 0, 3);           // välj enbart de senaste i arrayen för att loopa till utskrift

    foreach ($article_list as $a) {                         //liten loop för de första i array. Skriver ut 300 tecken ca, samt läs mer.  

        /* $date =  $a['postade'];
$myDateTime = DateTime::createFromFormat('Y-m-d h:i:s', $date);
$newDate = $myDateTime->format('y-m-d h:i'); datumförvandling som ej används */

    ?>
        <article>

            <h3><?= $a['title']; ?></h3>
            <p><?= substr($a['content'], 0, 300); ?>...</p>
            <p><a href="article.php?id=<?= $a['id']; ?>">Läs mer</a></p>
            <p><b>Publicerad: </b><?= $a['postade']; ?></p>
            <p>Av: <a href="blogger.php?name=<?= $a['name']; ?>"></b><?= $a['name']; ?></a></p>

        </article>

    <?php
    }
    ?>

    <button id='open' onclick.function()>Se fler artiklar</button>  <!-- JS funktion för att visa fler artiklar -->

    <div id="element">
        <?php
        $article = new Article();                       //hämta artiklar. 
        $article_list = $article->getArticles();

        if (count($article_list) < 5) {                 //kolla så listan inte är tom för att visa övriga artiklar 
            echo "<p class='error'>Inga fler artiklar finns att visa.</p>";
        }

        $article_list = array_slice($article_list, 3, 10);           // väljer vidare max till 10 av arrayen. 

        foreach ($article_list as $a) {                         // Skriver ut 300 tecken ca, samt läs mer.  

        ?>

            <article>
                <h3><?= $a['title']; ?></h3>
                <p><?= substr($a['content'], 0, 300); ?>...</p>
                <p><a href="article.php?id=<?= $a['id']; ?>">Läs mer</a></p>
                <p><b>Publicerad: </b><?= $a['postade']; ?></p>
                <p>Av: <a href="blogger.php?name=<?= $a['name']; ?>"></b><?= $a['name']; ?></a></p>
            </article>


        <?php
        }
        ?>
    </div>

    <a href="articles.php" id="all">Se alla artiklar</a>
    <noscript><a href="articles.php">Se alla artiklar</a></noscript>   <!-- om JS ej installerat -->

</section>

<script>
    document.getElementById("element").style.display = "none";      //hämta via ID för själva div. 
    document.getElementById("all").style.display = "none";
</script>
<script>
    let open = document.getElementById('open');
    open.onclick = function() {                 //funktion körs för att dölja och ta bort knappar vid klick på att visa mer. 
        document.getElementById('element').style.display = 'block';
        document.getElementById('open').style.display = "none";
        document.getElementById('all').style.display = "block";
    }
</script>

<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>