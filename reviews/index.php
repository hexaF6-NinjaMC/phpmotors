<?php
    // This is the Reviews Controller

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
    // Get the Reviews Model for use as needed
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
        case 'add-review':
            $_SESSION['message'] = NULL;
            $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

            // Check for missing data
            if (empty($reviewText)) {
                $_SESSION['message'] = '<p class="message error">Please provide information for all empty form fields.</p>';
                header("Location: /phpmotors/vehicles/?action=vehicleInformation&invId=".$_SESSION['invId']);
                exit;
            }

            $expectedClientId = $_SESSION['clientData']['clientId'];
            $expectedInvId = $_SESSION['invId'];

            // echo "Client ID: $clientId; type: ".gettype($clientId);
            // echo "<br>";
            // echo "INV ID: $invId; type: ".gettype($invId);
            // echo "<br>";
            // echo "Expected Client ID: $expectedClientId; type: ".gettype($expectedClientId);
            // echo "<br>";
            // echo "Expected INV ID: $expectedInvId; type: ".gettype($expectedInvId);
            // exit;

            if ($clientId != $expectedClientId || $invId != $expectedInvId) {
                header("Location: /phpmotors/vehicles/?action=vehicleInformation&invId=".$_SESSION['invId']);
                $_SESSION['message'] = '<p class="message error">Unable to post review due to form malignancy.</p>';
                exit;
            }

            $revOutcome = addVehicleReview($reviewText, $invId, $clientId);

            if ($revOutcome === 1) {
                $_SESSION['message'] = "<p class='message success'>Your review has been successfully added! Thank you for taking the time to leave your valuable feedback.</p>";
                header("Location: /phpmotors/vehicles/?action=vehicleInformation&invId=".$_SESSION['invId']);
                exit;
            } else {
                $_SESSION['message'] = "<p class='message error'>Your review was unable to be submitted! Please try again.</p>";
                header("Location: /phpmotors/vehicles/?action=vehicleInformation&invId=".$_SESSION['invId']);
                exit;
            }
            break;

        case 'edit-review-view':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
            $clientReviewByReviewId = getClientReviewByReviewId($reviewId);
            if ($clientReviewByReviewId == NULL) {
                header("Location: /phpmotors/accounts/?action=logged-in");
                $_SESSION['message'] = '<p class="message error">You are not allowed to update that review!</p>';
                exit;
            }
            if (count($clientReviewByReviewId)) {
                $expectedClientId = $_SESSION['clientData']['clientId'];
                $clientId = $clientReviewByReviewId['clientId'];
                if ($clientId != $expectedClientId) {
                    header("Location: /phpmotors/accounts/?action=logged-in");
                    $_SESSION['message'] = '<p class="message error">You are not allowed to update that review!</p>';
                    exit;
                }
                $reviewText = $clientReviewByReviewId['reviewText'];
                include '../view/edit-review.php';
            } else {
                header('Location: /phpmotors/accounts/?action=logged-in');
                $_SESSION['message'] = '<p class="message error">Couldn\'t find a review matching those records.</p>';
            }
            break;

        case 'update-review':
            $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

            // Check for missing data
            if (empty($reviewText)) {
                $_SESSION['message'] = '<p class="message error">Please provide information for all empty form fields.</p>';
                header("Location: /phpmotors/reviews/?action=edit-review-view&reviewId=$reviewId");
                exit;
            }

            $revOutcome = updateReview($reviewId, $reviewText);

            if ($revOutcome === 1) {
                $_SESSION['message'] = "<p class='message success'>Your review has been successfully updated! Thank you for taking the time to leave your valuable feedback.</p>";
                header("Location: /phpmotors/accounts/?action=logged-in");
                exit;
            } else {
                $_SESSION['message'] = "<p class='message error'>Your review was unable to be submitted. It appears nothing changed. If this is incorrect, please try again.</p>";
                header("Location: /phpmotors/accounts/?action=logged-in");
                exit;
            }
            break;

        case 'delete-review-view':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
            $clientReviewByReviewId = getClientReviewByReviewId($reviewId);
            if ($clientReviewByReviewId == NULL) {
                header("Location: /phpmotors/accounts/?action=logged-in");
                $_SESSION['message'] = '<p class="message error">You are not allowed to delete that review!</p>';
                exit;
            }
            if (count($clientReviewByReviewId)) {
                $clientId = $clientReviewByReviewId['clientId'];
                $reviewText = $clientReviewByReviewId['reviewText'];
                $expectedClientId = $_SESSION['clientData']['clientId'];

                if ($clientId != $expectedClientId) {
                    header("Location: /phpmotors/accounts/?action=logged-in");
                    $_SESSION['message'] = '<p class="message error">You are not allowed to delete that review!</p>';
                    exit;
                }
                include '../view/delete-review.php';
            } else {
                header('Location: /phpmotors/accounts/?action=logged-in');
                $_SESSION['message'] = '<p class="message error">Couldn\'t find a review matching those records.</p>';
            }
            break;

        case 'delete-review':
            $_SESSION['message'] = NULL;

            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $clientReviewByReviewId = getClientReviewByReviewId($reviewId);
            if ($clientReviewByReviewId == NULL) {
                header("Location: /phpmotors/accounts/?action=logged-in");
                $_SESSION['message'] = '<p class="message error">You are not allowed to delete that review!</p>';
                exit;
            }
            
            if (isset($_POST['confirmation'])) {
                $confirmation = true;
            } else {
                $confirmation = false;
            }
            // echo gettype($confirmation);
            // echo "<br>";
            // echo var_dump($confirmation);
            // exit;
            if (!$confirmation) {
                $_SESSION['message'] = '<p class="message error">Please confirm deletion by selecting the checkbox below!</p>';
                $reviewText = $clientReviewByReviewId['reviewText'];
                include '../view/delete-review.php';
                exit;
            }

            if (count($clientReviewByReviewId)) {
                $clientId = $clientReviewByReviewId['clientId'];
                $reviewText = $clientReviewByReviewId['reviewText'];
                $expectedClientId = $_SESSION['clientData']['clientId'];

                if ($clientId != $expectedClientId) {
                    header("Location: /phpmotors/accounts/?action=logged-in");
                    $_SESSION['message'] = '<p class="message error">You are not allowed to delete that review!</p>';
                    exit;
                }

                $deleteResult = deleteReview($reviewId);
                if ($deleteResult) {
                    $_SESSION['message'] = "<p class='message success'>Successfully deleted review.</p>";
                    header('Location: /phpmotors/accounts/?action=logged-in');
                    exit;
                } else {
                    $_SESSION['message'] = "<p class='message error'>Error: failed to delete review. Please try again.</p>";
                    header('Location: /phpmotors/accounts/?action=logged-in');
                    exit;
                }
                break;
            } else {
                header('Location: /phpmotors/accounts/?action=logged-in');
                $_SESSION['message'] = '<p class="message error">Couldn\'t find a review matching those records.</p>';
            }
            break;
                                                
        default:
            // Client-admin if logged in, server-home if not
            if (!$_SESSION['loggedin']) {
                header('Location: /phpmotors/');
            } else {
                include '../view/admin.php';
            }
            break;
    }
?>