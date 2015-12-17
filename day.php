<?php
include_once('databaseOperations.php');
$db = connect();

$date = strtotime(htmlspecialchars($_GET['date']));
?>
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
        <?php include('header.php'); ?>

        <div id="descEvent">
            <h1><?php echo date('d M Y', $date); ?></h1>
            <?php
            $ret = getEventsByDate($db, $date);
            //Show events
            foreach ($ret as $row)
            {
                echo "<div id=\"event\">\n";
                echo "<h2>".$row['event_title']."</h2>\n";
                echo "<div id=\"dateLieu\">".date('H:i',strtotime($row['event_dtstart']))." - ".date('H:i',strtotime($row['event_dtend'])).". ".$row['event_localisation']."</div>\n";
                echo "<div id=\"descfull\">".$row['event_description'] ."</div>\n<div id=\"More\"><a href=\"./event.php?id=".$row['event_id']."\">En savoir +</a></div>\n</div>\n";
            }
            ?>
        </div>
    </body>
</html>
