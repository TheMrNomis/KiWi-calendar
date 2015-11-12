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
        $id = 1;
        $ret = $db->query('SELECT * FROM events WHERE id="'. $id .'"');
        $event = $ret->fetchArray(SQLITE3_ASSOC);
?>
  <head>
    <title>KiWi calendar : <?php echo $event["titre"]; ?></title>
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
    <h1><?php echo $event["titre"]; ?></h1>

    <h2>Date et lieu</h2>
    <div id="dateheure">
      <?php
        date_default_timezone_set('America/Los_Angeles');
        $dtstart = new DateTime($event['dtstart']);
        $dtend = new DateTime($event['dtend']);
        if($dtstart->format('Y-m-d') == $dtend->format('Y-m-d'))
          echo strftime('Le %d %B %Y, ', strtotime($event['dtstart'])).strftime('de %Hh%M ', strtotime($event['dtstart'])).strftime('&agrave; %Hh%M', strtotime($event['dtend']));
        else
          echo strftime('Du %d %B %Y, %Hh%M', strtotime($event['dtstart'])).strftime(' &agrave; %d %B %Y, %Hh%M',strtotime($event['dtend']));
      ?></div>
    <?php
            echo '<div id="lieu">'.$event["localisation"].'</div>';
            echo '<div id="map" style="width:100%;height:500px;"></div>';

            if(isset($event["urlImage"]) || isset($event["description"]))
            echo '<h2>Description</h2>';
            if(isset($event["urlImage"]))
            echo '<div id="image"><img src="'.$event["urlImage"].'" width="100%"></div>';
            if(isset($event["description"]))
            echo '<div id="description">'.$event["description"].'</div>';

            if(isset($event["site"]) || isset($event["contact"]))
            echo '<h2>Informations</h2>';
            if(isset($event["site"]))
            echo '<div id="URL">URL : <a href="'.$event["site"].'">'.$event["site"].'</a></div>';
            if(isset($event["contact"]))
            echo '<div id="Contact">Contact : <a href="mailto:'.$event["contact"].'">'.$event["contact"].'</a></div>';
    ?>
  </div>

  <!-- bring in the google maps library -->
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript">
      //Google maps API initialisation
      var element = document.getElementById("map");

      var geocoder = new google.maps.Geocoder();
      var address = "<?php echo $event["localisation"]?>";

      geocoder.geocode( { 'address': address}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {
          var latitude = results[0].geometry.location.lat();
          var longitude = results[0].geometry.location.lng();
          }

          var map = new google.maps.Map(element, {
              center: new google.maps.LatLng(latitude, longitude),
              zoom: 15,
              mapTypeId: "OSM",
              mapTypeControl: false,
              streetViewControl: false
          });

          //Define OSM map type pointing at the OpenStreetMap tile server
          map.mapTypes.set("OSM", new google.maps.ImageMapType({
              getTileUrl: function(coord, zoom) {
                  // "Wrap" x (logitude) at 180th meridian properly
                  // NB: Don't touch coord.x because coord param is by reference, and changing its x property breakes something in Google's lib
                  var tilesPerGlobe = 1 << zoom;
                  var x = coord.x % tilesPerGlobe;
                  if (x < 0) {
                      x = tilesPerGlobe+x;
                  }
                  // Wrap y (latitude) in a like manner if you want to enable vertical infinite scroll

                  return "http://tile.openstreetmap.org/" + zoom + "/" + x + "/" + coord.y + ".png";
              },
              tileSize: new google.maps.Size(256, 256),
              name: "OpenStreetMap",
              maxZoom: 18
          }));
      });
  </script>

  </body>
</html>
