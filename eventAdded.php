<?php
include_once('databaseOperations.php');
include('datetimeOperations.php');
$db = connect();
$titre = htmlentities($_POST['title']);
$localisation = htmlentities($_POST['address']);
$dtstart = strtotime($_POST['dtstart']);
$dtend = strtotime($_POST['dtend']);
$description = htmlentities($_POST['description']);
$url = $_POST['site'];
$urlImage = $_POST['urlImage'];
$contact = $_POST['contact'];
$catArray = $_POST['chk_group'];
addEvent($db, $titre, $catArray, $localisation, $dtstart, $dtend, $description, $url, $urlImage, $contact);
header('Location:./');
exit;
?>
