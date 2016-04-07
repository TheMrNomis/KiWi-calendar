<?php
include_once('./databaseOperations.php');
//TODO: check if user has the right to delete the event
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
    $db = connect();

    deleteEvent($db, $_GET['id']);

    header('Location:./');
}
?>
