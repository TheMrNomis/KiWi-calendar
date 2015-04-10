<?php
#  if(!isset($_POST["y"]))
#  {
#    header("Location:.");
#    exit;
#  }
  function getEvents()
  {
    try
    {
      $pdo = new PDO("sqlite:testdb.db");
    }
    catch(Exception $e)
    {
      echo("Impossible d'acceder à la base de donnée");
      die();
    }
    $stmt = $pdo->prepare("SELECT titre, localisation, dtstart, dtend, description FROM events, categorie WHERE events.categorie = categorie.id");
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }
?>
