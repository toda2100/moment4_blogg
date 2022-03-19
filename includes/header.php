<?php 
/*
* Skapad av: Tobias Dahlberg
* sektionsfil för header bloggprojekt
*/
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="tbd"> <!-- beskrivning av sidan -->
    <title><?= $site_title . $divider . $page_title; ?></title> <!-- för att kunna hantera sidtitlat på undersidor -->
    <link rel="stylesheet" href="css/main.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <!-- sematiska element följer för header och sektion -->
        <header class="mainheader">
            <h1>Region Bodensee</h1>
            <?php include("includes/mainmenu.php"); ?>
            <!-- inkluderar huvudmenydok från dess php-fil -->
        </header>

        <section class="leftcontent">