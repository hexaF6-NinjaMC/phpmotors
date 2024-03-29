<?php
    // This is the main controller

    // Create or access a Session
    session_start();

    // Get the database connection file
    require_once '/app/library/connections.php';
    // Get the functions library
    require_once '/app/library/functions.php';
    // Get the PHP Motors model for use as needed
    require_once '/app/model/main-model.php';

    // Get the array of classifications
    $classifications = getClassifications();

    // var_dump($classifications);
	// exit;

    // Build a navigation bar using the $classifications array
    $navList = createNavList($classifications);

    // echo $navList;
    // exit;

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    // Check if the firstname cookie exists, get its value
    if (isset($_COOKIE['firstname'])) {
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    switch ($action){
        case 'template':
            include '/app/view/template.php';
            break;

        default:
            include '/app/view/home.php';
    }
?>
