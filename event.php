<?php
  if(!isset($_GET['id']))
  {
    header('Location:.');
    exit;
  }
  include_once('getEvents.php');
  $event = getEvent($_GET['id']);

  setlocale(LC_TIME, 'fr_FR.UTF8');

  $dtstart = new DateTime($event['dtstart']);
  $dtend = new DateTime($event['dtend']);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>KiWi calendar : <?php echo $event['titre']?> </title>
  </head>
  <body>
    <h1><?php echo $event['titre']?></h1>
    <div id="date">
      <?php
        if($dtstart->format('Y-m-d') == $dtend->format('Y-m-d'))
          echo strftime('Le %d %B %Y, ', strtotime($event['dtstart'])).strftime('de %H:%M ', strtotime($event['dtstart'])).strftime('&agrave; %H:%M', strtotime($event['dtend']));
        else
          echo strftime('Du %d %B %Y, %H:%M', strtotime($event['dtstart'])).strftime(' &agrave; %d %B %Y, %H:%M',strtotime($event['dtend']));
      ?>
    </div>
  </body>
</html>
