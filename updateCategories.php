<?php
session_start();

if(!isset($_GET['id']) || !isset($_GET['val']))
{
    exit;
}

$_SESSION['categorieStatus'][$_GET['id']] = $_GET['val'] == "true";
?>
