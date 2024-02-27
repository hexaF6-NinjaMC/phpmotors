<?php
    if (!$_SESSION['loggedin']) {
        header('Location: /');
    } else {
        $title = "Delete Your Review | PHPMotors";
        
        $main = "<h1>Delete Review</h1>";

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }

        $main .= <<<XML
            <form method="post" action="/reviews/">
                <p><span>*</span>: Required</p>
                <label for="screenName">Screen Name<span>*</span>:</label>
        XML;

        // Edit Review form
        $clientId = $_SESSION['clientData']['clientId'];

        $main .= "<input name='screenName' id='screenName' value='".substr($_SESSION['clientData']['clientFirstname'], 0, 1).$_SESSION['clientData']['clientLastname']."' readonly disabled>";

        $main .= <<<XML
                <label for="reviewText">Your Review<span>*</span>:</label>
        XML;

        $main .= "<textarea name='reviewText' id='reviewText' required readonly>$reviewText</textarea>";

        $main .= <<<XML
                <p class="warning">
                    <label for="confirmation">
                    <input type="checkbox" required name="confirmation" id="confirmation" value="confirm">By clicking the button below, I understand that deleting a record is permanent.
                    </label>
                </p>
                <button type="submit" value="submit" class="warning-btn">Delete Review</button>
                <!-- Add the action name/value pair -->
                <input type="hidden" name="action"  value="delete-review">
        XML;

        $main .= "
                <!-- To delete reviews -->
                <input type='hidden' name='reviewId' value='$reviewId'>
            </form>
            <hr class='length-eighth-less'>
            <br>
        ";

        require $_SERVER['DOCUMENT_ROOT'].'/view/template.php';
    }
?>
