<?php

/**
 * @brief inits the categories from cookies and URL params
 *
 * @param $db: a PDO connection to the database
 *
 * @warning session_start() MUST have been called before calling this function
 */
function initCategories($db)
{
    if(!isset($_SESSION['categorieStatus']))
    {
        //init all categories
        $categories = getCategories($db);
        foreach($categories as $cat)
            $_SESSION['categorieStatus'][$cat['cat_id']] = true;

        //loading from preferences
        loadCategoriesFromCookie();
    }
}

/**
 * @brief loads the categories preferences from the cookie
 */
function loadCategoriesFromCookie()
{
    if(isset($_COOKIE['categorieStatus']))
    {
        $categories = unserialize($_COOKIE['categorieStatus']);
        if(is_array($categories))
            for($i = 0; $i < count($categories); ++$i)
                if(is_bool($categories[$i]))
                    $_SESSION['categorieStatus'][$i] = $categories[$i];
    }
}

/**
 * @brief saves the categories preferences from $_POST to $_SESSION
 *
 * @warning $_SESSION['categorieStatus] MUST have been populated before calling this function
 */
function saveCategoriesPostToSession()
{
    foreach($_SESSION['categorieStatus'] as $cat_id => $cat_value)
    {
        $catPostName = 'cat_'.$cat_id;
        if(isset($_POST[$catPostName]))
            $_SESSION['categorieStatus'][$cat_id] = ($_POST[$catPostName] == 'on');
        else
            $_SESSION['categorieStatus'][$cat_id] = false;
    }
}

/**
 * @brief saves the categories preferences from $_SESSION to a cookie
 */
function saveCategoriesSessionToCookie()
{
    setcookie('categorieStatus', serialize($_SESSION['categorieStatus']), strtotime('+6 months'), null, null, false, true);
}
?>
