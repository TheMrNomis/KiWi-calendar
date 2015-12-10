<!DOCTYPE html>
<html>
    <head>
        <title>Kiwi Calendar</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./main.css" />
        <link rel="stylesheet" href="./event.css" />
        <link rel="icon" type="image/png" href="favicon.png" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->
    </head>
    <body>
        <header id="title">
            <img alt="logo ESIR" src="./images/esir.png" />
            <a href="./index.php"><img class="rightLogo" alt="logo Kiwi" src="./images/KiWiCalendar.png" /></a>
        </header>

        <div id="descEvent">
          <h1><?php
          date_default_timezone_set('America/Los_Angeles');
          $date = $_GET["date"];
          echo date('d M Y',strtotime($date));
          ?></h1>
<?php
  include_once('databaseOperations.php');
  $db = connect();

  $date = $_GET["date"];
  $ret = getEventsByDate($db, $date);
    //Show events
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
          echo "<div id=\"event\">\n";
          echo "<h2>".$row['event_title']."</h2>\n";
          echo "<div id=\"dateLieu\">".date('H:i',strtotime($row['event_dtstart']))." - ".date('H:i',strtotime($row['event_dtend'])).". ".$row['event_localisation']."</div>\n";
          echo "<div id=\"descfull\">".$row['event_description'] ."</div>\n<div id=\"More\"><a href=\"\">En savoir +</a></div>\n</div>\n";
   }

   $db->close();
?>
        </div>
    </body>
</html>
