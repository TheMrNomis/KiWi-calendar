<?php
session_start();
include_once('categoriesHandling.php');

saveCategoriesPostToSession();
saveCategoriesSessionToCookie();

header('Location:./');
?>
