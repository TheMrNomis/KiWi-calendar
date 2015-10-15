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
            <img class="rightLogo" alt="logo Kiwi" src="./images/KiWiCalendar.png" />
        </header>
        
        <div id="descEvent">
          <h1><?php 
          date_default_timezone_set('America/Los_Angeles');
          $date = $_GET["date"];
          echo date('d M Y',strtotime($date));
          ?></h1>
<?php
    class MyDB extends SQLite3
    {
       function __construct()
       {
          $this->open('testdb.db');
       }
    }

  $db = new MyDB();
  if(!$db) echo $db->lastErrorMsg();

  $date = $_GET["date"];
  $ret = $db->query('SELECT titre, dtstart, dtend, localisation, description FROM events WHERE dtstart<"'.date('Y-m-d',strtotime($date . "+1 days")).'" AND dtstart>"'.date('Y-m-d',strtotime($date)).'";');
    //Show events
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
          echo "<div id=\"event\">\n";
          echo "<h2>".$row['titre']."</h2>\n";
          echo "<div id=\"dateLieu\">".date('H:i',strtotime($row['dtstart']))." - ".date('H:i',strtotime($row['dtend'])).". ".$row['localisation']."</div>\n";
          echo "<div id=\"descfull\">".$row['description'] ."</div>\n<div id=\"More\"><a href=\"\">En savoir +</a></div>\n</div>\n";
   }
   
   $db->close();
?>
        </div>
    </body>
</html>
