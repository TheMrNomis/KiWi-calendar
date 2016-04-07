<?php
session_start();

include_once('databaseOperations.php');
include('datetimeOperations.php');
$db = connect();

$edit = isset($_POST['id']);
if($edit)
    $id = intval($_POST['id']);
$titre = htmlentities($_POST['title']);
$localisation = htmlentities($_POST['address']);
$description = htmlentities($_POST['description']);
$url = htmlspecialchars($_POST['site']);
$urlImage = htmlspecialchars($_POST['urlImage']);
$contact = htmlspecialchars($_POST['contact']);

$dateTypes = array('debut', 'fin');
foreach($dateTypes as $dateType)
{
    $year = intval($_POST[$dateType.'-select-year']);
    $month = sprintf('%02d', intval($_POST[$dateType.'-select-mois']));
    $day = sprintf('%02d', intval($_POST[$dateType.'-select-jour']));

    $hour = sprintf('%02d', intval($_POST[$dateType.'-select-hour']));
    $minutes = sprintf('%02d', intval($_POST[$dateType.'-select-minutes']));

    $date[$dateType] = strtotime($year.'-'.$month.'-'.$day.' '.$hour.':'.$minutes);
}

$availableCategories = getCategories($db);
$catArray = array();
foreach($availableCategories as $cat)
{
    if(isset($_POST['checkbox-cat-'.$cat['cat_id']]))
        $catArray[] = $cat['cat_id'];
}

if(!$edit)
   addEvent($db, $titre, $catArray, $localisation, $date['debut'], $date['fin'], $description, $url, $urlImage, $contact);
else
{
    updateEvent($db, $id, $titre, $catArray, $localisation, $date['debut'], $date['fin'], $description, $url, $urlImage, $contact);
}
header('Location:./');
exit;
?>
