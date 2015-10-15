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
        for($week = 0; $week < 5; ++$week)
        {
            echo('
            <ul class="week">');
            for($date = strtotime('last monday +'.$week.' weeks'); $date < strtotime('next monday +'.$week.' weeks'); $date = strtotime('+1 day', $date))
            {
                $class = '';
                if(date('m', $date) != date('m'))
                    $class .= ' otherMonth';

                if(date('Y-m-d', $date) == date('Y-m-d'))
                    $class .= ' today';

                echo('
                <li class="day'.$class.'">
                    <h2>'.date("d", $date).'</h2>
                    <ul>
                        <li class="calendar-link">10h : Conférence - Domotique</li>
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
                                <a id="ancherMore" href="#More" onclick="alert('Click on More');"><img id="exMore" alt="expand less" src="images/expand_less.png" /></a>
                                <div id="Mois">Mars 2015</div>
                                <a id="ancherLess" href="#Less" onclick="alert('Click on Less');"><img id="exLess" alt="expand more" src="images/expand_more.png" /></a>
                            </div>
                          <div id="Export">Exporter en <a href="#RSS">RSS</a>, <a href="#iCal">iCal</a>, <a href="#webCal">WebCal</a></div>
                          </div>
              <div>
        </div>
        <script src="hamburger.js"></script>
    </body>
</html>
