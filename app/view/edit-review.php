<?php
    if (!$_SESSION['loggedin']) {
        header('Location: /');
    } else {
        $title = "Update Review | PHP Motors";

        $main = <<<XML
            <h1>Update Review</h1>
        XML;

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }

        // Edit Review form
        $clientId = $_SESSION['clientData']['clientId'];
    
        $main .= <<<XML
            <form method="post" action="/reviews/">
                <label for="screenName">Screen Name<span>*</span>:</label>
        XML;

        $main .= "<input name='screenName' id='screenName' value='".substr($_SESSION['clientData']['clientFirstname'], 0, 1).$_SESSION['clientData']['clientLastname']."' readonly disabled>";

        $main .= <<<XML
                <label for="reviewText">Your Review<span>*</span>:</label>
        XML;

        if (isset($reviewText)) {
            $main .= "<textarea name='reviewText' id='reviewText' required>$reviewText</textarea>";
        } else {
            $main .= "<textarea name='reviewText' id='reviewText' required></textarea>";
        }

        $main .= <<<XML
                <button type="submit" value="submit">Update Review</button>
                <!-- Add the action name/value pair -->
                <input type="hidden" name="action" value="update-review">
        XML;

        $main .= "
                    <!-- To post reviews -->
                <input type='hidden' name='reviewId' value='$reviewId'>
            </form>
            <hr class='length-eighth-less'>
            <br>
        ";
    }
    require $_SERVER['DOCUMENT_ROOT'].'/view/template.php';
?>
