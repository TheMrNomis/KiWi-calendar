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
  <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" media="screen"
  href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
  <link rel="icon" type="image/png" href="favicon.png" />
  <link rel="stylesheet" href="./addEvent.css" />
  <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->
</head>
<body>
  <?php include('header.php'); ?>

  <div id="descEvent">
    <h1>Ajouter un Évènement</h1>

    <form id="eventForm" name="eventForm" method="post" action="eventAdded.php">
      <div id="left">Titre :</div>
      <input type="text" name="title" required>
      <br>
      <div id="left">Catégories :</div>
      <div id="checkboxGrp">
      //TODO: make one checkbox required
      <?php
      $cats = getCategoriesNames($db);
      for ($i=0; $i<count($cats); $i++) {
        echo "<input type=\"checkbox\" name=\"chk_group[]\" value=\"".$cats[$i][0]."\" />".$cats[$i][1]." ";
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


    <script type="text/javascript"
    src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
    </script>
    <script type="text/javascript"
    src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
    </script>
    <script type="text/javascript"
    src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"
    src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>
    <script type="text/javascript">
    $('#datetimepicker').datetimepicker({
      format: 'dd/MM/yyyy hh:mm:ss',
      language: 'fr_FR'
    });
    $('#datetimepicker2').datetimepicker({
      format: 'dd/MM/yyyy hh:mm:ss',
      language: 'fr_FR'
    });
    </script>

  </div>
</body>
</html>
