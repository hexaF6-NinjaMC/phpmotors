<?php
    // This is the Accounts controller

    // Create or access a Session
    session_start();

    // Get the database connection file
    require_once '../library/connections.php';
    // Get the functions library
    require_once '../library/functions.php';
    // Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    // Get the Accounts model for use as needed
    require_once '../model/accounts-model.php';
    // Get the Reviews model for use as needed
    require_once '../model/reviews-model.php';

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

    switch ($action) {
        case 'login':
            include '../view/login.php';
            break;

        case 'registration':
            include '../view/registration.php';
            break;

        case 'register':
            $_SESSION['message'] = NULL;
            // Filter and store the data:
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);

            // Check for existing email:
            $emailExists = checkExistingEmail($clientEmail);
            if ($emailExists) {
                $_SESSION['message'] = "<p class='message notice'>That email address already exists. Would you like to login instead?</p>";
                include '../view/login.php';
                exit;
            }

            // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
                $_SESSION['message'] = "<p class='message error'>Please provide information for all empty form fields.</p>";
                include '../view/registration.php';
                exit;
            }
            
            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

            if ($regOutcome === 1) {
                header('Location: /phpmotors/accounts/?action=login');
                setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                $_SESSION['message'] = "<p class='message success'>Thanks for registering, $clientFirstname! You may now use your email and password to login.</p>";
                exit;
            } else {
                $_SESSION['message'] = "<p class='message error'>Sorry, $clientFirstname; registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;
            }
            break;

        case 'Login':
            $_SESSION['message'] = NULL;
            // echo "In the 'Login' case.";
            // exit;

            // Filter and store the data:
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = checkEmail($clientEmail);
            $checkPassword = checkPassword($clientPassword);

            // Check for missing data
            if (empty($clientEmail) || empty($checkPassword)) {
                $_SESSION['message'] = "<p class='message error'>Please provide information for all empty form fields.</p>";
                include '../view/login.php';
                exit;
            }
            
            // A valid password exists, proceed with the login process
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
            // Compare the password just submitted against
            // the hashed password for the matching client
            if (!$clientData) {
                $_SESSION['message'] = '<p class="message error">A user was not found.</p>';
                include '../view/login.php';
                exit;
            } else {
                $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);                
            }
            // If the hashes don't match create an error
            // and return to the login view
            if (!$hashCheck) {
                $_SESSION['message'] = '<p class="message error">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }

            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            $_SESSION['message'] = '<p class="message success">User successfully logged in.</p><br>';
            $reviewsByClient = getReviews($_SESSION['clientData']['clientId']);
            if (count($reviewsByClient)) {
                $reviews = buildReviewsDisplayByClient($reviewsByClient);
            }
            include '../view/admin.php';
            exit;

        case 'logged-in':
            $reviewsByClient = getReviews($_SESSION['clientData']['clientId']);
            if (count($reviewsByClient)) {
                $reviews = buildReviewsDisplayByClient($reviewsByClient);
            }
            include '../view/admin.php';
            break;

        case 'logout':
            $_SESSION['message'] = NULL;
            header('Location: /phpmotors/');
            $_SESSION['loggedin'] = FALSE;
            $_SESSION['clientData'] = NULL;
            break;

        case '500':
            include '../view/500.php';
            break;

        case 'updateAccount':
            include '../view/client-update.php';
            break;
        
        case 'updateSafeInfo':
            $_SESSION['message'] = NULL;
            // Filter and store the data:
            $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientEmail = checkEmail($clientEmail);

            $clientData = $_SESSION['clientData'];

            // Check for missing data
            if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
                $accountInfoMessage = "<p class='message error'>Please provide information for all empty form fields.</p>";
                include '../view/client-update.php';
                exit;
            }

            // Check for existing email:
            if ($clientEmail != $clientData['clientEmail']) {
                $emailExists = checkExistingEmail($clientEmail);
                if ($emailExists) {
                    $accountInfoMessage = "<p class='message error'>That email address already exists.</p>";
                    include '../view/client-update.php';
                    exit;
                }
            }

            $updateOutcome = updateAccountInfo($clientFirstname, $clientLastname, $clientEmail, $clientId);

            if ($updateOutcome === 1) {
                $clientData = getClientById($clientId);
                $_SESSION['message'] = '<p class="message success">User info was updated successfully.</p><br>';
                $_SESSION['clientData'] = $clientData;
                header('Location: /phpmotors/accounts/?action=logged-in');
                exit;
            } else {
                $_SESSION['message'] = '<p class="message error">Failed to update user information.</p><br>';
                header('Location: /phpmotors/accounts/?action=logged-in');
                exit;
            }
            break;
        
        case 'updateUnsafeInfo':
            $_SESSION['message'] = NULL;
            // Filter and store the data:
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $checkPassword = checkPassword($clientPassword);

            // Check for missing data
            if (empty($checkPassword)) {
                $accountPasswordMessage = "<p class='message error'>Please provide information for all empty form fields.</p>";
                include '../view/client-update.php';
                exit;
            }

            // Hash the checked password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
            $updateOutcome = updatePassword($hashedPassword, $clientId);

            if ($updateOutcome === 1) {
                $_SESSION['message'] = "<p class='message success'>Succesfully updated password. You may now use your new password to login.</p><br>";
                header('Location: /phpmotors/accounts/?action=logged-in');
                exit;
            } else {
                $_SESSION['message'] = "<p class='message error'>Password change request failed.</p><br>";
                header('Location: /phpmotors/accounts/?action=logged-in');
                exit;
            }          
            break;

        default:
            $_SESSION['message'] = NULL;
            include '../view/login.php';
            break;
    }
?>