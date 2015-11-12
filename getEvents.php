<?php
#  if(!isset($_POST["y"]))
#  {
#    header("Location:.");
#    exit;
#  }

/**
 * @brief connects to the database
 * @return a PDO connection to the database
 */
function connect()
{
    try
    {
        $pdo = new PDO("sqlite:testdb.db");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $e)
    {
        //NOTE: change $e->getMessage() by an error message before going to production
        echo($e->getMessage());
        die();
    }
}

/**
 * @brief queries the database for the events on a certain date
 * @param $db: the PDO connection to the database
 * @param $date: the date to search for
 * @return a list of all the events at the date $date
 */
function getEventsByDate($db, $date)
{
    try
    {
        $request = $db->prepare('SELECT events.id, events.titre, events.localisation, events.dtstart, events.dtend, events.description FROM events, categorie WHERE events.categorie = categorie.id AND (dtstart <= :date AND dtend >= :date)');
        $request->execute(array('date'=>date("Y-m-d",$date)));
        $result = $request->fetchAll();
        $request->closeCursor();
        return $result;
    }
    catch(PDOException $e)
    {
        //NOTE: change $e->getMessage() by an error message before going to production
        echo($e->getMessage());
        die();
    }
}

/**
 * @brief queries the database for the events after a certain date
 * @param $db: the PDO connection to the database
 * @param $date: the date to search for
 * @return a list of all the events future to $date
 */
function getEventsSince($db,$date)
{
    try
    {
        $request = $db->prepare('SELECT events.id, events.titre, events.localisation, events.dtstart, events.dtend, events.description FROM events, categorie WHERE events.categorie = categorie.id AND (events.dtstart >= :date OR events.dtend >= :date)');
        $request->execute(array('date'=>date("Y-m-d",$date)));
        $result = $request->fetchAll();
        $request->closeCursor();
        return $result;
    }
    catch(PDOException $e)
    {
        //NOTE: change $e->getMessage() by an error message before going to production
        echo($e->getMessage());
        die();
    }
}

/**
 * @deprecated
 */
function getEvents()
{
    $pdo = connect();
    $stmt = $pdo->prepare('SELECT titre, localisation, dtstart, dtend, description, url FROM events, categorie WHERE events.categorie = categorie.id');
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

/**
 * @deprecated
 */
function getEvent($id)
{
    $pdo = connect();
    $stmt = $pdo->prepare('SELECT titre, localisation, dtstart, dtend, description, url FROM events WHERE id = ?');
    $stmt->execute(array($id));
    $result = $stmt->fetch();
    return $result;
}
?>
