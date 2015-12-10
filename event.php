<!DOCTYPE html>
<html>
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
        $id = $_GET["id"];
        $ret = $db->query('SELECT * FROM event WHERE event_id="'. $id .'"');
        $event = $ret->fetchArray(SQLITE3_ASSOC);
?>
  <head>
    <title>KiWi calendar : <?php echo $event["event_title"]; ?></title>
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
    <h1><?php echo $event["event_title"]; ?></h1>

    <h2>Date et lieu</h2>
    <div id="dateheure">
      <?php
        date_default_timezone_set('America/Los_Angeles');
        $dtstart = new DateTime($event['event_dtstart']);
        $dtend = new DateTime($event['event_dtend']);
        if($dtstart->format('Y-m-d') == $dtend->format('Y-m-d'))
          echo strftime('Le %d %B %Y, ', strtotime($event['event_dtstart'])).strftime('de %Hh%M ', strtotime($event['event_dtstart'])).strftime('&agrave; %Hh%M', strtotime($event['event_dtend']));
        else
          echo strftime('Du %d %B %Y, %Hh%M', strtotime($event['event_dtstart'])).strftime(' &agrave; %d %B %Y, %Hh%M',strtotime($event['event_dtend']));
      ?></div>
    <?php
            echo '<div id="lieu">'.$event["event_localisation"].'</div>';
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($event["event_localisation"]).'&key=AIzaSyB8Cd8NP8VOa0wIlvvYGEMZMzCKwROiHxU';
            $obj = json_decode(file_get_contents($url), true);
            $lat = $obj["results"][0]["geometry"]["location"]["lat"];
            $lng = $obj["results"][0]["geometry"]["location"]["lng"];
            $urlFrame = 'http://www.openstreetmap.org/export/embed.html?bbox='.$lng.','.$lat.','.$lng.','.$lat.'&layer=mapnik&floor';
            echo '<iframe frameborder="0" scrolling="no"
                  marginheight="0" marginwidth="0"
            src="'.$urlFrame.'" style="width:100%;height:500px;margin-bottom:-30px;"></iframe>';

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

  <!-- bring in the google maps library -->
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

  </body>
</html>
