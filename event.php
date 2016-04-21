<?php
include_once('databaseOperations.php');
include('datetimeOperations.php');
$db = connect();

if(!isset($_GET['id']) || !is_numeric($_GET['id']))
header('Location:./');

$id = htmlspecialchars($_GET['id']);

$event = getOneEvent($db, $id);
$dtstart = strtotime($event['event_dtstart']);
$dtend = strtotime($event['event_dtend']);
?>

<!DOCTYPE html>
<html>
<head>
  <title>KiWi calendar : <?php echo $event["event_title"]; ?></title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./main.css" />
  <link rel="stylesheet" href="./event.css" />
  <link rel="icon" type="image/png" href="favicon.png" />
  <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->

  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
  <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
</head>
<body>
  <?php include('header.php'); ?>
  <div id="descEvent">
    <h1><?php echo $event["event_title"]; ?>
      <a href="<?php echo 'addEvent.php?id='.$_GET['id']; ?>"><img src="icons/ic_mode_edit_24px.svg"/></a></h1>


      <h2>Date et lieu</h2>
      <div id="dateheure">
        <?php echo htmlentities(printableDateTime($dtstart, $dtend)); ?>
      </div>
      <div id="lieu"><?php echo $event['event_localisation']; ?></div>
<?php
      $url = 'https://nominatim.openstreetmap.org/search?format=json&q='.urlencode($event["event_localisation"]);
      $obj = json_decode(file_get_contents($url), true);
      $lat = $obj[0]["lat"];
      $lng = $obj[0]["lon"];
      $urlFrame = 'https://www.openstreetmap.org/export/embed.html?bbox='.$lng.','.$lat.','.$lng.','.$lat.'&layer=mapnik&floor&marker='.$lat.','.$lng;
?>
      <iframe id="map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $urlFrame; ?>"></iframe>;
<?php
      if(isset($event["event_urlImage"]) || isset($event["event_description"]))
      echo '<div id="descDiv" style="margin-top:30px;"><h2>Description</h2></div>';
      if(isset($event["event_urlImage"]))
      echo '<div id="image"><img src="'.$event["event_urlImage"].'" width="100%"></div>';
      if(isset($event["event_description"]))
      echo '<div id="description">'.$event["event_description"].'</div>';

      if(isset($event["event_site"]) || isset($event["event_contact"]))
      echo '<h2>Informations</h2>';
      if(isset($event["event_site"]))
      echo '<div id="URL">URL : <a href="'.$event["event_site"].'">'.$event["event_site"].'</a></div>';
      if(isset($event["event_contact"]))
      echo '<div id="Contact">Contact : <a href="mailto:'.$event["event_contact"].'">'.$event["event_contact"].'</a></div>';
  ?>
    </div>

  </body>
  </html>
