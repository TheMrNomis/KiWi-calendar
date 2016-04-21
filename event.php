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
      <iframe id="map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $urlFrame; ?>"></iframe>
<?php
      if(!empty($event["event_urlImage"]) || !empty($event['event_description']) || !empty($event['event_site']) || !empty($event['event_contact']))
      {
?>
      <h2>Description</h2>
<?php
      }
      if(!empty($event["event_urlImage"]))
      {
?>
      <div id="image">
          <img src="<?php echo $event["event_urlImage"];?>" width="100%">
      </div>
<?php
      }
      if(!empty($event['event_description']))
      {
?>
      <div id="description">
          <?php echo $event["event_description"]; ?>
      </div>
<?php
      }
      if(!empty($event['event_site']) || !empty($event['event_contact']))
      {
?>
      <h2>Informations</h2>
<?php
      }
      if(!empty($event['event_site']) && preg_match("#^(https?://)?[a-zA-Z0-9.]{1,}\.[a-zA-Z0-9.]{1,}/?#", $event['event_site']))
      {
?>
      <div id="URL">
          URL : <a href="<?php echo $event["event_site"];?>"><?php echo $event["event_site"];?></a>
      </div>
<?php
      }
      if(!empty($event['event_contact']))
      {
?>
      <div id="Contact">
          Contact : <a href="mailto:'<?php echo $event["event_contact"];?>"><?php echo $event["event_contact"]; ?></a>
      </div>
<?php
      }
?>
    </div>

  </body>
  </html>
