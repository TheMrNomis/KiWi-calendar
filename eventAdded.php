<?php
session_start();
include_once('databaseOperations.php');
include('datetimeOperations.php');
$db = connect();
if(isset($_POST['id']))
    $id = intval($_POST['id']);
$titre = htmlentities($_POST['title']);
$localisation = htmlentities($_POST['address']);
$dtstart = strtotime($_POST['dtstart']);
$dtend = strtotime($_POST['dtend']);
$description = htmlentities($_POST['description']);
$url = $_POST['site'];
$urlImage = $_POST['urlImage'];
$contact = $_POST['contact'];
$catArray = $_POST['chk_group'];
if(!isset($_POST['id']))
   addEvent($db, $titre, $catArray, $localisation, $dtstart, $dtend, $description, $url, $urlImage, $contact);
else
   updateEvent($db, $id, $titre, $catArray, $localisation, $dtstart, $dtend, $description, $url, $urlImage, $contact);
header('Location:./');
exit;
?>
