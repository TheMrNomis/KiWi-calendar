<?php
#  if(!isset($_POST["y"]))
#  {
#    header("Location:.");
#    exit;
#  }
  function connect()
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
    return $pdo;
  }

  function getEvents()
  {
    $pdo = connect();
    $stmt = $pdo->prepare('SELECT titre, localisation, dtstart, dtend, description, url FROM events, categorie WHERE events.categorie = categorie.id');
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  }

  function getEvent($id)
  {
    $pdo = connect();
    $stmt = $pdo->prepare('SELECT titre, localisation, dtstart, dtend, description, url FROM events WHERE id = ?');
    $stmt->execute(array($id));
    $result = $stmt->fetch();
    return $result;
  }
?>
