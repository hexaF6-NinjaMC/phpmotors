<?php
    if ((!$_SESSION['loggedin']) or $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /phpmotors/');
    } else {
        $title = "Add Vehicle Classification | PHP Motors";
        
        $main = '<h1>Vehicle Classification Management</h1>';

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }
        
        $main .= <<<XML
            <form method="post" action="/phpmotors/vehicles/">
                <p><span>*</span>: Required</p>
                <span class="warning-text">Classification Name can be no more than 30 characters long.</span>
                <label for="classificationName">Classification Name<span>*</span>:</label>
                <input type="text" name="classificationName" id="classificationName" class="form-control" placeholder="Ferrari" required maxlength="30">
                <button type="submit" value="submit">Submit</button>
                <!-- Add the action name/value pair -->
                <input type="hidden" name="action" value="add-classification">
                <p>Need to add a vehicle? <a href="/phpmotors/vehicles/?action=add-vehicle-view">Add one HERE!</a></p>
            </form>
            <hr class="length-eighth-less">
            <br>
        XML;
        require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/template.php';
    }
?>