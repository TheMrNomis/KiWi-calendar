<?php
/** /
require_once('./CAS-1.3.4/CAS.php');
phpCAS::client(CAS_VERSION_2_0, 'sso-cas.univ-rennes1.fr', 443, '', false);
phpCAS::setNoCasServerValidation();
phpCAS::forceAuthentication();
$uid = phpCAS::getUser();
/**/

include_once('databaseOperations.php');
include('datetimeOperations.php');
$db = connect();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Kiwi Calendar : Ajouter un évènement</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="./main.css" />
        <link rel="stylesheet" href="./event.css" />
        <link rel="icon" type="image/png" href="favicon.png" />
        <link rel="stylesheet" href="./addEvent.css" />
        <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->
    </head>
    <body>
        <?php include('header.php'); ?>

        <div id="descEvent">
            <h1>Ajouter un Évènement</h1>

            <form id="eventForm" name="eventForm" method="post" action="eventAdded.php" onsubmit="return verifyCheckbox();">
                <div id="left">Titre :</div>
                <input type="text" name="title" required>
                <br>
                <div id="left">Catégories :</div>
                <div id="checkboxGrp">
<?php
                    $cats = getCategoriesNames($db);
                    foreach ($cats as $cat)
                    {
?>
                    <div class="categorie_grp">
                        <input type="checkbox" name="categories" id="checkbox-cat-<?php echo $cat[0]; ?>" value="<?php echo $cat[0]; ?>" />
                        <label for="checkbox-cat-<?php echo $cat[0]; ?>"><?php echo $cat[1]; ?></label>
                    </div>
<?php
                    }
?>
                </div>
                <br>
                <div id="left">Adresse :</div>
                <input type="text" name="address" required>
                <br>
<?php
                $dateTypes = array('début', 'fin');
                foreach($dateTypes as $dateType)
                {
                    $idDateType = strtr($dateType, array('é'=>'e'))
?>
                <div id="left"><?php echo htmlentities('Date de '.$dateType.' :');?></div>
                    <label for="<?php echo $idDateType ?>-select-jour"><?php echo htmlentities('Jour :'); ?></label>
                    <select id="<?php echo $idDateType ?>-select-jour" required>
<?php
                        for($jour = 1; $jour <= 31; ++$jour)
                        {
?>
                        <option value="<?php echo $jour;?>"<?php echo ($jour == date('j'))? "selected" : '';?>><?php echo $jour; ?></option>
<?php
                        }
?>
                    </select>
                    <label for="<?php echo $idDateType ?>-select-mois"><?php echo htmlentities('Mois :'); ?></label>
                    <select id="<?php echo $idDateType ?>-select-mois" required>
<?php
                        for($mois = 1; $mois <= 12; ++$mois)
                        {
                            $monthName = DateTime::createFromFormat('!m', $mois)->format('F');
?>
                        <option value="<?php echo $mois;?>"<?php echo ($mois == date('n'))? "selected" : '';?>><?php echo $monthName; ?></option>
<?php
                        }
?>
                    </select>
                    <label for="<?php echo $idDateType ?>-select-year"><?php echo htmlentities('Année :');?></label>
                    <select id="<?php echo $idDateType ?>-select-year" required>
<?php
                        $thisYear = date('Y');
                        for($year = 0; $year <= 10; ++$year)
                        {
                            $optionYear = $thisYear + $year;
?>
                        <option value="<?php echo $optionYear;?>" <?php echo ($year == 0)? "selected" : '';?>><?php echo $optionYear; ?></option>
<?php
                        }
?>
                    </select>
                <label for="<?php echo $idDateType ?>-select-hour"><?php echo htmlentities('Heure :'); ?></label>
                <select id="<?php echo $idDateType ?>-select-hour" required>
<?php
                 for($hour = 0; $hour < 24; ++$hour)
                 {
?>
                    <option value="<?php echo $hour; ?>" <?php echo ($hour == date('G'))? "selected" : '';?>><?php echo $hour; ?></option>
<?php
                 }
?>
                </select>
                <label for="<?php echo $idDateType ?>-select-hour">h</label>
                <select id="<?php echo $idDateType ?>-select-minutes" required>
<?php
                 for($minutes = 0; $minutes < 60; $minutes += 15)
                 {
?>
                    <option value="<?php echo $minutes; ?>"><?php echo $minutes; ?></option>
<?php
                 }
?>
                </select>
                <label for="<?php echo $idDateType ?>-select-minutes">min</label>
            <br>
<?php
                }
?>
        <br>
        <div id="left">Description de l'évènement :</div>
        <textarea name="description" rows="4" cols="50" form="eventForm">
        </textarea>
        <br>
        <div id="left">Site de l'évènement :</div>
        <input type="url" value="http://" name="site">
        <br>
        <div id="left">Image de l'évènement :</div>
        <input type="url" value="http://" name="urlImage">
        <br>
        <div id="left">Contact :</div>
        <input type="text" name="contact">
        <br>
        <div id="buttonDiv"><button id="submit">Ajouter l'évènement !</button></div>
        </form>
    </div>
</body>
</html>
