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
 * @brief queries all the categories from the dabase
 * @param $db: the PDO connection to the database
 * @return al list of all the categories (id, name)
 */
function getCategories($db)
{
    try
    {
        $request = $db->prepare('SELECT * FROM categorie NATURAL JOIN sous_categorie ORDER BY sous_cat_tab ASC, sous_cat_id ASC');
        $request->execute();
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
 * @brief queries all the events from the database
 * @param $db: the PDO connection to the database
 * @return a list of all the events in the database
 */
function getAllEvents($db)
{
    try
    {
        $request = $db->prepare('SELECT * FROM event NATURAL JOIN eventCategorie NATURAL JOIN categorie');
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
 * @brief queries the database for one particular event
 * @param $db: the PDO connection to the database
 * @param $id: the ID of the event to query
 * @return an array containing the event
 */
function getOneEvent($db, $id)
{
    try
    {
        $request = $db->prepare('SELECT * FROM event WHERE event_id = ?');
        $request->execute(array($id));
        $result = $request->fetch();
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

function getCategoriesForOneEvent($db, $eventId)
{
    try
    {
        $request = $db->prepare('SELECT * FROM eventCategorie NATURAL JOIN categorie NATURAL JOIN sous_categorie ORDER BY sous_cat_tab ASC, sous_cat_id ASC WHERE event_id = ?');
        $request->execute(array($id));
        $result = $request->fetch();
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
 * @brief queries the database for the events on a certain date
 * @param $db: the PDO connection to the database
 * @param $date: the date to search for
 * @return a list of all the events at the date $date
 */
function getEventsByDate($db, $date)
{
    try
    {
        $request = $db->prepare('SELECT * FROM event WHERE (event_dtstart <= :date AND event_dtend >= :date)');
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
 * @brief queries the database for the events on a certain date, where the categories are matched
 * @param $db: the PDO connection to the database
 * @param $date: the date to search for
 * @param $categories: an array containing the IDs of the categories
 * @return a list of all the events of the different categories at the date $date
 */
function getEventsByDateAndCategories($db, $date, $categories)
{
    try
    {
        $request = $db->prepare('SELECT * FROM event NATURAL JOIN eventCategorie NATURAL JOIN categorie WHERE (dtstart <= :date AND dtend >= :date) AND events.categorie IN (:categories)');
        $request->execute(array(
                                    'date'=>date("Y-m-d",$date),
                                    'categories'=>implode(',', array_map('intval', $categories))
        ));
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
        $request = $db->prepare('SELECT * FROM event WHERE (event_dtstart >= :date OR event_dtend >= :date)');
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
?>
