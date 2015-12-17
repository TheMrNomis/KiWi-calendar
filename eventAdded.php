<?php
include_once('databaseOperations.php');
include('datetimeOperations.php');
$db = connect();
$titre = $_POST['title'];
$localisation = $_POST['address'];
$dtstart = $_POST['dtstart'];
$dtend = $_POST['dtend'];
$description = $_POST['description'];
$url = $_POST['site'];
$urlImage = $_POST['urlImage'];
$contact = $_POST['contact'];
addEvent($db, $titre, $localisation, $dtstart, $dtend, $description, $url, $urlImage, $contact);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kiwi Calendar : Ajouter un évènement</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./main.css" />
        <link rel="stylesheet" href="./event.css" />
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="screen"
           href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
        <link rel="icon" type="image/png" href="favicon.png" />
        <link rel="stylesheet" href="./addEvent.css" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->
    </head>
    <body>
        <header id="title">
            <img alt="logo ESIR" src="./images/esir.png" />
            <a href="./index.php"><img class="rightLogo" alt="logo Kiwi" src="./images/KiWiCalendar.png" /></a>
        </header>

        <div id="descEvent">
        Ok !
        </div>
    </body>
</html>
