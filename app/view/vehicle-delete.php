<?php
    if ($_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /');
    } else {
        // Add Dynamic Title
        if (isset($invInfo['invMake'])) {
            $title = "Delete $invInfo[invMake] $invInfo[invModel] | PHPMotors";
        }
        
        // Add Dynamic H1
        if (isset($invInfo['invMake'])) {
            $main = "<h1>Delete $invInfo[invMake] $invInfo[invModel]</h1>";
        }

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }

        $main .= <<<XML
            <form method="post" action="/app/vehicles/">
                <p><span>*</span>: Required</p>
        XML;

        $main .= <<<XML
            <label for="invMake">Make<span>*</span>:</label>
        XML;

        if (isset($invInfo['invMake'])) {
            $main .= "<input type='text' readonly name='invMake' id='invMake' required value='$invInfo[invMake]'>";
        }

        $main .= <<<XML
            <label for="invModel">Model<span>*</span>:</label>
        XML;

        if (isset($invInfo['invModel'])) {
            $main .= "<input type='text' readonly name='invModel' id='invModel' required value='$invInfo[invModel]'>";
        }

        $main .= <<<XML
            <label for="invDescription">Description<span>*</span>:</label>
        XML;

        if (isset($invInfo['invDescription'])) {
            $main .= "<textarea readonly name='invDescription' id='invDescription' required>$invInfo[invDescription]</textarea>";
        }

        $main .= <<<XML
                <p class="warning"><label for="confirmation">
                    <input type="checkbox" required name="confirmation" id="confirmation" value="confirm">By clicking the button below, I understand that deleting a record is permanent.
                    </label>
                </p>
                <button type="submit" value="submit" class="warning-btn">Delete Vehicle</button>
                <!-- Add the action name/value pair -->
                <input type="hidden" name="action" value="deleteVehicle">
        XML;

        if (isset($invInfo['invId'])) {
            $main .= "<input type='hidden' name='invId' value='$invInfo[invId]'>";
        }

        $main .= <<<XML
            </form>
            <hr class="length-eighth-less">
            <br>
        XML;
        
        require $_SERVER['DOCUMENT_ROOT'].'/app/view/template.php';
    }
?>
