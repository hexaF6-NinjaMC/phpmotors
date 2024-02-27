<?php
    // This is the Vehicles controller

    // Create or access a Session
    session_start();

    // Get the database connection file
    require_once '../library/connections.php';
    // Get the functions library
    require_once '../library/functions.php';
    // Get the PHP Motors model for use as needed
    require_once '../model/main-model.php';
    // Get the Accounts model for use as needed
    require_once '../model/vehicles-model.php';
    // Get the Uploads model for use as needed
    require_once '../model/uploads-model.php';
    // Get the Reviews model for use as needed
    require_once '../model/reviews-model.php';

    // Get the array of classifications
    $classifications = getClassifications();

    // var_dump($classifications);
	// exit;

    // Build a navigation bar using the $classifications array
    $navList = createNavList($classifications);

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL){
        $action = filter_input(INPUT_GET, 'action');
    }

    switch ($action) {
        case 'add-classification-view':
            include '../view/add-classification.php';
            break;

        case 'add-classification':
            $_SESSION['message'] = NULL;
            $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            // echo $classificationName;
            // exit;

            // Check for missing data
            if (empty($classificationName)) {
                $_SESSION['message'] = '<p class="message error">Please provide information for all empty form fields.</p>';
                include '../view/add-classification.php';
                exit;
            }

            $classOutcome = addVehicleClassification($classificationName);

            if ($classOutcome === 1) {
                header('Location: '.$_SERVER['REQUEST_URI']);
                $_SESSION['message'] = "<p class='message success'>Classification of <strong>$classificationName</strong> successfully added.</p>";
                exit;
            } else {
                $_SESSION['message'] = "<p class='message error'>The classification registration of <strong>$classificationName</strong> failed. Please try again.</p>";
                include '../view/add-classification.php';
                exit;
            }
            break;

        case 'add-vehicle-view':
            include '../view/add-vehicle.php';
            break;

        case 'add-vehicle':
            $_SESSION['message'] = NULL;
            $classificationId = filter_input(INPUT_POST, 'classificationName');
            // echo $classificationId;
            // exit;
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_URL));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_URL));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            
            // echo $classificationId;
            // exit;

            // Check for missing data
            if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
                $_SESSION['message'] = '<p class="message error">Please provide information for all empty form fields.</p>';
                include '../view/add-vehicle.php';
                exit;
            }

            $vehOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

            if ($vehOutcome === 1) {
                header('Location: '.$_SERVER['REQUEST_URI']);
                $_SESSION['message'] = "<p class='message success'>Successfully added \"$invMake $invModel\".</p>";
                exit;
            } else {
                $_SESSION['message'] = "<p class='message error'>Sorry, the vehicle registration failed. Please try again.</p>";
                include '../view/add-vehicle.php';
                exit;
            }
            break;

        case '500':
            include '../view/500.php';
            break;

        /* * ********************************** 
        * Get vehicles by classificationId 
        * Used for starting Update & Delete process 
        * ********************************** */ 
        case 'getInventoryItems': 
            // Get the classificationId 
            $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
            // Fetch the vehicles by classificationId from the DB 
            $inventoryArray = getInventoryByClassification($classificationId); 
            // Convert the array to a JSON object and send it back 
            echo json_encode($inventoryArray); 
            break;
        
        case 'mod':
            $_SESSION['message'] = NULL;
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo)<1){
                $_SESSION['message'] = 'Sorry, no vehicle information could be found.';
            }
            include '../view/vehicle-update.php';
            exit;
            break;
        
        case 'updateVehicle':
            $_SESSION['message'] = NULL;
            $classificationId = filter_input(INPUT_POST, 'classificationName');
            // echo $classificationId;
            // exit;
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_URL));
            $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_URL));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
            // echo $classificationId;
            // exit;

            // Check for missing data
            if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
                $_SESSION['message'] = '<p class="message error">Please provide information for all empty form fields.</p>';
                include '../view/vehicle-update.php';
                exit;
            }

            $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

            if ($updateResult) {
                $_SESSION['message'] = "<p class='message success'>Successfully updated \"$invMake $invModel\".</p>";
                header('Location: /phpmotors/vehicles/');
                exit;
            } else {
                $_SESSION['message'] = "<p class='message error'>Sorry, the vehicle update failed. Please try again.</p>";
                include '../view/vehicle-update.php';
                exit;
            }
            break;

        case 'del':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            
            if ($invInfo == NULL) {
                header("Location: /phpmotors/accounts/?action=logged-in");
                $_SESSION['message'] = '<p class="message error">You are not allowed to delete that record!</p>';
                exit;
            }

            if(count($invInfo) < 1){
                $_SESSION['message'] = '<p class="message error">Sorry, no vehicle information could be found.</p>';
            }
            include '../view/vehicle-delete.php';
            exit;
            break;

        case 'deleteVehicle':
            $classificationId = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_NUMBER_INT);
            
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
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
                // echo "FAIL";
                // exit;

                $_SESSION['message'] = '<p class="message error">Please confirm deletion by selecting the checkbox below!</p>';
                header("Location: /phpmotors/vehicles/?action=del&invId=$invId");
                exit;
            }

            $deleteResult = deleteVehicle($invId);

            if ($deleteResult) {
                $_SESSION['message'] = "<p class='message success'>Successfully deleted \"$invMake $invModel\".</p>";
                header('Location: /phpmotors/vehicles/');
                exit;
            } else {
                $_SESSION['message'] = "<p class='message error'>Error: vehicle deletion of \"$invMake $invModel\" failed. Please try again.</p>";
                header('Location: /phpmotors/vehicles/');
                exit;
            }
            break;

        case 'classification':
            $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $vehicles = getVehiclesByClassification($classificationName);
            if (!count($vehicles)) {
                $_SESSION['message'] = "<p class='message error'>Sorry, no $classificationName vehicles could be found.</p>";
            } else {
                $_SESSION['message'] = NULL;
                $vehicleDisplay = buildVehiclesDisplay($vehicles);
            }
            // echo $vehicleDisplay;
            // exit;
            include '../view/classification.php';
            break;

        case 'vehicleInformation':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $vehicleInfo = getInvItemInfo($invId);
            // foreach ($vehicleInfo as $vehicleTidbit) {
            //     echo "$vehicleTidbit<br>";
            // }
            $vehiclePrimaryImg = getPrimaryImgPathById($invId);
            $vehicleThumbnails = getThumbnailsPathById($invId);
            // echo count($vehicleThumbnails)."<br>";
            
            // // echo "<br><br><br>";
            // foreach ($vehicleThumbnails as $vehicleTnTidbit) {
            //     echo "$vehicleTnTidbit<br>";
            // }
            // exit;
            if (!$vehicleInfo) {
                $_SESSION['message'] = "<p class='message error'>Sorry, we couldn't find that vehicle.</p>";
            } else {
                $vehicleDisplay = buildVehicleDisplayByInfo($vehicleInfo, $vehicleThumbnails, $vehiclePrimaryImg);
            }

            $reviewsArr = getReviewsByInvId($invId);
            if (!count($reviewsArr)) {
                $invReviewsDisplay = "<p>No reviews yet. Be the first to add a review!</p>";
            } else {
                $invReviewsDisplay = buildInvReviewsDisplay($reviewsArr);
            }

            include '../view/vehicle-detail.php';
            break;

        default:
            $_SESSION['message'] = NULL;
            $classificationList = buildClassificationList($classifications);
            include '../view/vehicle-management.php';
            break;
    }
?>