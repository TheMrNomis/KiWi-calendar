<!DOCTYPE html>
<html>
<head>
  <title>KiWi calendar : À propos</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./main.css" />
  <link rel="stylesheet" href="./event.css" />
  <link rel="icon" type="image/png" href="favicon.png" />
  <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->
</head>
<body>
  <?php include('header.php'); ?>
  <div id="descEvent">
    <h1>À propos de KiWi-Calendar</h1>

    <h2>Licence</h2>
    <p>
      KiWi-Calendar <b><?php
      function isAvailable($func) {
        if (ini_get('safe_mode')) return false;
        $disabled = ini_get('disable_functions');
        if ($disabled) {
          $disabled = explode(',', $disabled);
          $disabled = array_map('trim', $disabled);
          return !in_array($func, $disabled);
        }
        return true;
      }
      if(isAvailable("system")) {
        $str = system("git describe --always");
        echo 'version '.$str.' ';
      }
      ?></b> est publié sous licence <a href="http://www.cecill.info/" >CeCILL</a>, dont les termes sont disponibles en version <a href="LICENSE-FR">Fran&ccedil;aise</a> et <a href="LICENSE">Anglaise</a>.
    </p>

    <h2>Qui sommes nous ?</h2>
    <h3>Sébastien Blin</h3>
    <p>Sp&eacute;cialit&eacute; Informatique - Syst&egrave;mes d'Information</p>
    <h3>Merwan Kaf</h3>
    <p>Sp&eacute;cialit&eacute; Informatique - Syst&egrave;mes d'Information</p>
    <h3>Amaury Louarn</h3>
    <p>Sp&eacute;cialit&eacute; Informatique - Imagerie Num&eacute;rique</p>
    <h3>Paul Perraud</h3>
    <p>Sp&eacute;cialit&eacute; Ing&eacute;nierie pour la sant&eacute;</p>

    <h2>Le projet Kiwi Calendar</h2>
    <p>Nous avons mené ce projet en tant que 4 étudiants de l'ESIR en lien avec le cursus d'Innovation et Politique. L'idée d'un calendrier évènementiel nous est venu à l'esprit en voyant la grande quantité de mails reçus quotidiennement pour informer du déroulement de tel ou tel évènement sur le campus, voire sur Rennes. Nous avons donc décidé de nous lancer dans la réalisation de ce projet lors de notre première année à l'ESIR, courant février 2015.</p>
    <h2>Présentation de Kiwi Calendar</h2>
    <p>Kiwi Calendar est un calendrier évènementiel collaboratif regroupant la majorité des évènements en lien avec les formations proposées à l'ESIR ainsi que ceux proposés par la ville de Rennes. De plus, chaque étudiant peut, grâce à son sésame, ajouter un évènement qu'il juge pertinent.<br/>
      En lien avec le développement durable et l'informatique durable, ce site a été réalisé selon les règles prescrites dans les <i>115 bonnes pratiques d'éco-conception web</i> écrit par Frédéric Bordage.</p>
      <h2>Vous avez trouvé un bug ?</h2>
      Vous pouvez remonter les bugs sur <a href="https://github.com/TheMrNomis/KiWi-calendar/">le dépôt</a> git du projet.
      <h2>Remerciements</h2>
      <p>
        Les étudiants du groupe Innovation et Politique, pour nous avoir régulièrement donné leur avis et conseils.<br/>
        <br/>
        <b>L'équipe Kiwi.</b></p>
      </div>

      <!-- bring in the google maps library -->
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

    </body>
    </html>
