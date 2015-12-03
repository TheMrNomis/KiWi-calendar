<?php
session_start();
include_once('databaseOperations.php');
$db = connect();

$days = array(
    1 => "Lun",
    2 => "Mar",
    3 => "Mer",
    4 => "Jeu",
    5 => "Ven",
    6 => "Sam",
    7 => "Dim"
);
$months = array(
    1 => "Janvier",
    2 => "Fevrier",
    3 => "Mars",
    4 => "Avril",
    5 => "Mai",
    6 => "Juin",
    7 => "Juillet",
    8 => "Ao&ucirc;t",
    9 => "Septembre",
    10 => "Octobre",
    11 => "Novembre",
    12 => "Decembre"
);

if(isset($_GET['w'])&&is_numeric($_GET['w']))
    $weekOffset = $_GET['w'];
else
    $weekOffset = 0;

$categories = getCategories($db);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Kiwi Calendar</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./index.css" />
        <link rel="stylesheet" href="./main.css" />
        <link rel="icon" type="image/png" href="favicon.png" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->
    </head>
    <body>
        <header id="title">
            <a id="hamburgerButton" href="#"><img alt="menu" src="./images/menu.png" /></a>
            <img alt="logo ESIR" src="./images/esir.png" />
            <img class="rightLogo" alt="logo Kiwi" src="./images/KiWiCalendar.png" />
        </header>


        <nav id="hamburgerMenu">
        <a id="ancherESIR" href="#ESIR" onclick="alert('Click on ESIR');">
            <div class="onglet" id="onglet-esir">
                Esir
            </div>
         </a>
         <a id="ancherRennes" href="#Rennes" onclick="alert('Click on Rennes');">
            <div class="onglet" id="onglet-ext">
                Rennes
            </div>
         </a>
            <a id="ancherEvent" href="#addEvent" onclick="alert('Ajoute un evenement');"><div class="Button" id="AddEvent">
                + Ajouter un Évènement
            </div></a>
            <div id="container">
                <h2>Conférences, Évènements</h2>
                    <form name="confs" action="" method="POST">
                                    <div align="left"><br>
                                            <input type="checkbox" id="c1" name="cc" />
                                            <label for="c1"><span></span>Biomédical</label><br>
                                            <input type="checkbox" id="c2" name="cc" />
                                            <label for="c2"><span></span>Domotique</label><br>
                                            <input type="checkbox" id="c3" name="cc" />
                                            <label for="c3"><span></span>Informatique</label><br>
                                            <input type="checkbox" id="c4" name="cc" />
                                            <label for="c4"><span></span>Matériaux</label><br>
                                            <input type="checkbox" id="c5" name="cc" />
                                            <label for="c5"><span></span>Télécommunication</label><br>
                                            <input type="checkbox" id="c6" name="cc" />
                                            <label for="c6"><span></span>Divers</label><br>
                                        <br>
                                    </div>
                                    </form>
                <h2>Clubs, associations</h2>
                <form name="confs" action="" method="POST">
                                    <div align="left"><br>
                                            <input type="checkbox" id="c7" name="cc" />
                                            <label for="c7"><span></span>Club Framboise</label><br>
                                            <input type="checkbox" id="c8" name="cc" />
                                            <label for="c8"><span></span>ESIRDuino</label><br>
                                            <input type="checkbox" id="c9" name="cc" />
                                            <label for="c9"><span></span>Club Tricot</label><br>
                                            <input type="checkbox" id="c10" name="cc" />
                                            <label for="c10"><span></span>Club Miam</label><br>
                                            <input type="checkbox" id="c11" name="cc" />
                                            <label for="c11"><span></span>Les lapins noirs</label><br>
                                            <input type="checkbox" id="c12" name="cc" />
                                            <label for="c12"><span></span>Club rigolo</label><br>
                                        <br>
                                    </div>
                                    </form>
            </div>
        </nav>




        <div id="calendar">
    <?php
        //FIXME: events are not displayed on the first day
        $monthDate = strtotime('last monday +'.($weekOffset+3).' weeks');

        for($week = $weekOffset; $week < $weekOffset + 5; ++$week)
        {
            echo('
            <ul class="week">');
            for($date = strtotime('last monday +'.$week.' weeks');
                $date < strtotime('next monday +'.$week.' weeks');
                $date = strtotime('+1 day', $date)
               )
            {
                $events = getEventsByDate($db, $date);

                $class = '';
                if(date('m', $date) != date('m', $monthDate))
                    $class .= ' otherMonth';

                if(date('Y-m-d', $date) == date('Y-m-d'))
                    $class .= ' today';

                echo('
                <li class="day'.$class.'">
                    <a href="./day.php?date='.$date.'">
                    <h2>
                        <span class="minititle left">'.$days[date("N",$date)].'</span>
                        '.date("d", $date));
                if(date('m', $date) != date('m', $monthDate))
                    echo('<span class="minititle right">/'.date("m",$date).'</class>');
                echo('
                    </h2>
                    </a>
                    <ul>');

                foreach($events as $event)
                    echo('<li class="calendar-link"><a href="./event.php?id='.$event['id'].'">'.$event['titre']."</a></li>");
                echo('
                    </ul>
                </li>');
            }
            echo('
            </ul>'."\n");
        }
    ?>

              <div id="footer">
                            <div id="TextFooter">
                            <div id="exMois">
                                <a id="ancherMore" href="./index.php?w=<?php echo($weekOffset - 1); ?>"><img id="exMore" alt="expand less" src="images/expand_less.png" /></a>
                                <div id="Mois"><?php echo($months[date('n',$monthDate)].' '.date('Y',$monthDate)); ?></div>
                                <a id="ancherLess" href="./index.php?w=<?php echo($weekOffset + 1); ?>"><img id="exLess" alt="expand more" src="images/expand_more.png" /></a>
                            </div>
                          <div id="Export"><a href="./export.php?w=<?php echo($weekOffset); ?>">Exporter (iCal)</a></div>
                          </div>
              <div>
        </div>
        <script src="hamburger.js"></script>
    </body>
</html>
