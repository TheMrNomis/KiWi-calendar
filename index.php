<?php
session_start();
include_once('databaseOperations.php');
include_once('datetimeOperations.php');
include_once('categoriesHandling.php');
$db = connect();

initCategories($db);

if(isset($_GET['w'])&&is_numeric($_GET['w']))
    $weekOffset = $_GET['w'];
else
    $weekOffset = 0;

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
            <a href="./index.php"><img class="rightLogo" alt="logo Kiwi" src="./images/KiWiCalendar.png" /></a>
        </header>


        <nav id="hamburgerMenu">
            <a id="ancherESIR" href="#">
                <div class="onglet" id="onglet-esir">
                    Esir
                </div>
            </a>
            <a id="ancherRennes" href="#">
                <div class="onglet" id="onglet-ext">
                    Rennes
                </div>
            </a>
            <div id="container">
                <form method="post" id="form-categories" action="./update-categories.php">
                    <?php
                    for($tab = 0; $tab < 2; ++$tab)
                    {
                        $sous_categories = getSousCategories($db, $tab);
                    ?>
                    <div id="tab<?php echo $tab; ?>" class="tabContent">
                        <?php
                        for($sous_cat_it = 0; $sous_cat_it < count($sous_categories); ++$sous_cat_it)
                        {
                            $sous_cat_id = $sous_categories[$sous_cat_it]['sous_cat_id'];
                            $sous_cat_title = $sous_categories[$sous_cat_it]['sous_cat_title'];
                        ?>
                        <h2><?php echo $sous_cat_title;?></h2>
                        <?php
                            $categories = getCategoriesBySousCategorie($db, $sous_cat_id);
                            for($cat_it = 0; $cat_it < count($categories); ++$cat_it)
                            {
                                $cat_id = $categories[$cat_it]['cat_id'];
                                $cat_title = $categories[$cat_it]['cat_title'];
                        ?>
                        <input class="categorie-checkbox" type="checkbox" id="cat_<?php echo $cat_id; ?>" name="cat_<?php echo $cat_id; ?>" <?php if(isset($_SESSION['categorieStatus'][$cat_id]) && $_SESSION['categorieStatus'][$cat_id]) echo 'checked'; ?> />
                        <label for="cat_<?php echo $cat_id; ?>"><span></span><?php echo $cat_title;?></label><br />
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                    }
                    ?>
                    <input type="submit" id="change" value="sauvegarder cat&eacute;gories" />
                </form>
                <a id="ancherEvent" href="./addEvent.php">
                    <div class="Button" id="AddEvent">
                        + Ajouter un Évènement
                    </div>
                </a>
            </div>
        </nav>




        <div id="calendar">
            <?php
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
                    $events = getEventsByDateAndCategories($db, $date, $_SESSION['categorieStatus']);

                    $class = '';
                    if(date('m', $date) != date('m', $monthDate))
                        $class .= ' otherMonth';

                    if(date('Y-m-d', $date) == date('Y-m-d'))
                        $class .= ' today';

                    echo('
                <li class="day'.$class.'">
                    <a href="./day.php?date='.date('Y-m-d', $date) .'">
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
                    echo('<li class="calendar-link"><a href="./event.php?id='.$event['event_id'].'">'.$event['event_title']."</a></li>");
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
                <script src="categories.js"></script>
                </body>
            </html>
