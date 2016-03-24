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
<?
                    }
?>
                </div>
                <br>
                <div id="left">Adresse :</div>
                <input type="text" name="address" required>
                <br>
                <div id="left">Date de début :</div>
                <div id="datetimepicker" class="input-append date">
                    <input type="text" name="dtstart" required></input>
                <span class="add-on">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                </span>
                </div>
            <br>
            <div id="left">Date de fin :</div>
            <div id="datetimepicker2" class="input-append date">
                <input type="text" name="dtend" required></input>
            <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
            </span>
        </div>
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
