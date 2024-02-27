<?php
    if (!$vehicleInfo) {
        $title = "Not found | PHP Motors, Inc.";

        $main = "<h1>Uh oh...</h1>";

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }

        $main .= <<<XML
            <h2>404: That's an error!</h2>
            <br>
            <p>We couldn't find a vehicle that matches those records in our database.</p>
            <hr class="length-eighth-less">
            <br>
        XML;

    } else {
        $title = "$vehicleInfo[invMake] $vehicleInfo[invModel] | PHP Motors, Inc.";
        $main = "<h1 id='vehicle-name'>$vehicleInfo[invMake] $vehicleInfo[invModel]</h1>
        <p id='helpful-text'>*<em>Vehicle reviews can be seen at the bottom of the page.</em></p>";

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }
        $main .= "<br>";

        if (isset($vehicleDisplay)) {
            $main .= $vehicleDisplay;
        }

        $main .= '<hr class="length-eighth-less"><div id="reviews-display"><h3 id="reviews-heading">Customer Reviews</h3>';

        if (isset($invReviewsDisplay)) {
            $main .= $invReviewsDisplay;
        }

        if (!$_SESSION['loggedin']) {
            $reviewCallToAction = "<p class='mt-two'><em><a href='/app/accounts/?action=login'>Log in</a> to leave a review.</em></p>";
        } else {
            $clientId = $_SESSION['clientData']['clientId'];
    
            $reviewCallToAction = <<<XML
                <form method="post" action="/app/reviews/">
                    <label for="screenName">Screen Name<span>*</span>:</label>
            XML;

            $reviewCallToAction .= "<input name='screenName' id='screenName' value='".substr($_SESSION['clientData']['clientFirstname'], 0, 1).$_SESSION['clientData']['clientLastname']."' readonly disabled>";

            $reviewCallToAction .= <<<XML
                    <label for="reviewText">Your Review<span>*</span>:</label>
            XML;
    
            if (isset($reviewText)) {
                $reviewCallToAction .= "<textarea name='reviewText' id='reviewText' required>$reviewText</textarea>";
            } else {
                $reviewCallToAction .= "<textarea name='reviewText' id='reviewText' required></textarea>";
            }
    
            $reviewCallToAction .= <<<XML
                    <button type="submit" value="submit">Add Review</button>
                    <!-- Add the action name/value pair -->
                    <input type="hidden" name="action" value="add-review">
            XML;

            $_SESSION['invId'] = $invId;
    
            $reviewCallToAction .= "
                        <!-- To post reviews -->
                    <input type='hidden' name='clientId' value='$clientId'>
                    <input type='hidden' name='invId' value='$invId'>
                </form>
            ";
        }

        // echo $invReviewsDisplay;
        // echo $reviewCallToAction;
        // exit;
        
        $main .= $reviewCallToAction;

        $main .= '</div>
        <hr class="length-eighth-less">
        <br>';
    }
    require $_SERVER['DOCUMENT_ROOT'].'/app/view/template.php';
?>
