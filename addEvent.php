<?php
require_once('./CAS-1.3.4/CAS.php');

phpCAS::proxy(CAS_VERSION_2_0, 'sso-cas.univ-rennes1.fr', 443, '');
phpCAS::setNoCasServerValidation();
phpCAS::forceAuthentication();
$uid = phpCAS::getUser();

include_once('databaseOperations.php');
include('datetimeOperations.php');
$db = connect();

$edit = (isset($_GET['id']) && is_numeric($_GET['id']));

if(!$edit)
{
    $pageTitle = 'Ajouter un évènement';
    $defaults = array(
        'titre'=>'',
        'categories'=>array(),
        'adresse'=>'ESIR',
        'debut-jour'=>date('j'),
        'debut-mois'=>date('n'),
        'debut-annee'=>date('Y'),
        'debut-heure'=>date('G'),
        'debut-minutes'=>'0',
        'fin-jour'=>date('j', strtotime('+1 hour')),
        'fin-mois'=>date('n', strtotime('+1 hour')),
        'fin-annee'=>date('Y', strtotime('+1 hour')),
        'fin-heure'=>date('G', strtotime('+1 hour')),
        'fin-minutes'=>'0',
        'description'=>'',
        'site'=>'',
        'image'=>'',
        'contact'=>''
    );
}
else
{
    $pageTitle = 'Modifier un évènement';

    $id = intval($_GET['id']);
    $event = getOneEvent($db, $id);
    $categories = getCategoriesForOneEvent($db, $id);

    $dtstart = strtotime($event['event_dtstart']);
    $dtend = strtotime($event['event_dtend']);

    $defaults = array(
        'titre'=>$event['event_title'],
        'categories'=>$categories,
        'adresse'=>$event["event_localisation"],
        'debut-jour'=>date('j', $dtstart),
        'debut-mois'=>date('n', $dtstart),
        'debut-annee'=>date('Y', $dtstart),
        'debut-heure'=>date('G', $dtstart),
        'debut-minutes'=>date('i', $dtstart),
        'fin-jour'=>date('j', $dtend),
        'fin-mois'=>date('n', $dtend),
        'fin-annee'=>date('Y', $dtend),
        'fin-heure'=>date('G', $dtend),
        'fin-minutes'=>date('i', $dtend),
        'description'=>$event["event_description"],
        'site'=>$event["event_url"],
        'image'=>$event["event_urlImage"],
        'contact'=>$event["event_contact"]
    );
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo htmlentities('Kiwi Calendar : '.$pageTitle); ?></title>
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
            <h1>
                <?php echo htmlentities($pageTitle); ?>
<?php
                if($edit)
                {
?>
        <a href="deleteEvent.php?id=<?php echo $id; ?>" id="deleteButton" title="Supprimer l'évènement !"><img alt="supprimer" src="icons/ic_delete_forever_24px.svg" /></a>
<?php
                }
?>
                </h1>

            <form id="eventForm" name="eventForm" method="post" action="eventAdded.php">
<?php
                if($edit)
                {
?>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
<?php
                }
?>
                <div id="left">Titre :</div>
                    <input type="text" name="title" value="<?php echo $defaults['titre']; ?>" required>
                <br>
                <div id="left">Catégories :</div>
                <div id="checkboxGrp">
<?php
                    $cats = getCategoriesNames($db);
                    foreach ($cats as $cat)
                    {
?>
                    <div class="categorie_grp">
                        <input type="checkbox" class="checkbox-cat" name="checkbox-cat-<?php echo $cat[0]; ?>" id="checkbox-cat-<?php echo $cat[0]; ?>" <?php echo (is_array($defaults['categories']) && in_array($cat[0], $defaults['categories']))? 'checked' : '';?> />
                        <label for="checkbox-cat-<?php echo $cat[0]; ?>"><?php echo htmlentities($cat[1]); ?></label>
                    </div>
<?php
                    }
?>
                </div>
                <br>
                <div id="left">Adresse :</div>
                <input type="text" name="address" value="<?php echo $defaults['adresse']; ?>" required>
                <br>
<?php
                $dateTypes = array('début', 'fin');
                foreach($dateTypes as $dateType)
                {
                    $idDateType = strtr($dateType, array('é'=>'e'))
?>
                <div id="left"><?php echo htmlentities('Date de '.$dateType.' :');?></div>
                    <label for="<?php echo $idDateType ?>-select-jour"><?php echo htmlentities('Jour :'); ?></label>
                    <select id="<?php echo $idDateType ?>-select-jour" name="<?php echo $idDateType ?>-select-jour" required>
<?php
                        for($jour = 1; $jour <= 31; ++$jour)
                        {
?>
                        <option value="<?php echo $jour;?>" <?php echo ($jour == $defaults[$idDateType.'-jour'])? "selected" : '';?>><?php echo $jour; ?></option>
<?php
                        }
?>
                    </select>
                    <label for="<?php echo $idDateType ?>-select-mois"><?php echo htmlentities('Mois :'); ?></label>
                    <select id="<?php echo $idDateType ?>-select-mois" name="<?php echo $idDateType ?>-select-mois" required>
<?php
                        for($mois = 1; $mois <= 12; ++$mois)
                        {
                            $monthName = DateTime::createFromFormat('!m', $mois)->format('F');
?>
                        <option value="<?php echo $mois;?>" <?php echo ($mois == $defaults[$idDateType.'-mois'])? "selected" : '';?>><?php echo $monthName; ?></option>
<?php
                        }
?>
                    </select>
                    <label for="<?php echo $idDateType ?>-select-year"><?php echo htmlentities('Année :');?></label>
                    <select id="<?php echo $idDateType ?>-select-year" name="<?php echo $idDateType ?>-select-year" required>
<?php
                        $thisYear = date('Y');
                        for($year = 0; $year <= 10; ++$year)
                        {
                            $optionYear = $thisYear + $year;
?>
                        <option value="<?php echo $optionYear;?>" <?php echo ($optionYear == $defaults[$idDateType.'-annee'])? "selected" : '';?>><?php echo $optionYear; ?></option>
<?php
                        }
?>
                    </select>
                <label for="<?php echo $idDateType ?>-select-hour"><?php echo htmlentities('Heure :'); ?></label>
                <select id="<?php echo $idDateType ?>-select-hour" name="<?php echo $idDateType ?>-select-hour" required>
<?php
                 for($hour = 0; $hour < 24; ++$hour)
                 {
?>
                    <option value="<?php echo $hour; ?>" <?php echo ($hour == $defaults[$idDateType.'-heure'])? "selected" : '';?>><?php echo $hour; ?></option>
<?php
                 }
?>
                </select>
                <label for="<?php echo $idDateType ?>-select-hour">h</label>
                <select id="<?php echo $idDateType ?>-select-minutes" name="<?php echo $idDateType ?>-select-minutes" required>
<?php
                 for($minutes = 0; $minutes < 60; $minutes += 15)
                 {
?>
                    <option value="<?php echo $minutes; ?>" <?php echo ($hour == $defaults[$idDateType.'-minutes'])? "selected" : '';?>><?php echo $minutes; ?></option>
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
        <textarea name="description" rows="4" cols="50" form="eventForm"><?php echo $defaults['description']; ?></textarea>
        <br>
        <div id="left">Site de l'évènement :</div>
            <input type="url" value="<?php echo $defaults['site']; ?>" name="site" />
        <br>
        <div id="left">Image de l'évènement :</div>
            <input type="url" value="<?php echo $defaults['image']; ?>" name="urlImage" />
        <br>
        <div id="left">Contact :</div>
            <input type="text" name="contact" value="<?php echo $defaults['contact']; ?>" />
        <br>
<?php
                if(!$edit)
                {
?>
        <input id="submitButton" type="submit" value="Ajouter l'évènement !" />
<?php
                }
                else
                {
?>
        <input id="submitButton" type="submit" value="Modifier l'évènement !" />
<?php
                }
?>
        </form>
    </div>
</body>
<script type="text/javascript">
    function checkCheckboxes()
    {
        var checkboxes = document.getElementsByClassName("checkbox-cat");
        for(var i = 0; i < checkboxes.length; ++i)
        {
            console.log(checkboxes[i].name);
            if(checkboxes[i].checked)
                return true;
        }

        return false;
    }

    document.getElementById('eventForm').addEventListener('submit', function(e) {
        if(!checkCheckboxes())
        {
            e.preventDefault();
            var checkboxes = document.getElementsByClassName("checkbox-cat");
            for(var i = 0; i < checkboxes.length; ++i)
            {
                checkboxes[i].className += " bad-checkbox";
            }
        }
                                                          });
</script>
</html>
