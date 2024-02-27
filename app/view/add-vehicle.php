<?php
    if ((!$_SESSION['loggedin']) or $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /');
    } else {
        $title = "Add Vehicle | PHP Motors";
        
        $main = '<h1>Add Vehicle</h1>';

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }

        $main .= <<<XML
            <form method="post" action="/app/vehicles/">
                <p><span>*</span>: Required</p>
        XML;
        
        $classificationList = '<select name="classificationName" id="classificationName">';
        $classificationList .= "<option>Choose a Classification</option>";
        foreach ($classifications as $classification) {
            $classificationList .= "<option value='$classification[classificationId]'";
            if (isset($classificationId)) {
                if ($classification['classificationId'] == $classificationId) {
                    $classificationList .= ' selected ';
                }
            }
            $classificationList .= ">$classification[classificationName]</option>";
        }
        $classificationList .= '</select>';

        if (isset($classificationList)) {
            $main .= <<<XML
                <label for="classificationName">Classification Name<span>*</span>:</label>
            XML;
            $main .= $classificationList;
        }

        $main .= <<<XML
            <label for="invMake">Make<span>*</span>:</label>
        XML;

        if (isset($invMake)) {
            $main .= "<input type='text' name='invMake' id='invMake' required value='$invMake'>";
        } else {
            $main .= "<input type='text' name='invMake' id='invMake' required>";
        }

        $main .= <<<XML
            <label for="invModel">Model<span>*</span>:</label>
        XML;

        if (isset($invModel)) {
            $main .= "<input type='text' name='invModel' id='invModel' required value='$invModel'>";
        } else {
            $main .= "<input type='text' name='invModel' id='invModel' required>";
        }

        $main .= <<<XML
            <label for="invDescription">Description<span>*</span>:</label>
        XML;

        if (isset($invDescription)) {
            $main .= "<textarea name='invDescription' id='invDescription' required>$invDescription</textarea>";
        } else {
            $main .= "<textarea name='invDescription' id='invDescription' required></textarea>";
        }
        
        $main .= <<<XML
            <label for="invImage">Image Path<span>*</span>:</label>
        XML;

        if (isset($invImage)) {
            $main .= "<input type='text' name='invImage' id='invImage' accept='image/*,.pdf' required value='$invImage'>";
        } else {
            $main .= "<input type='text' name='invImage' id='invImage' accept='image/*,.pdf' required>";
        }

        $main .= <<<XML
            <label for="invThumbnail">Thumbnail Path<span>*</span>:</label>
        XML;

        if (isset($invThumbnail)) {
            $main .= "<input type='text' name='invThumbnail' id='invThumbnail' accept='image/*,.pdf' required value='$invThumbnail'>";
        } else {
            $main .= "<input type='text' name='invThumbnail' id='invThumbnail' accept='image/*,.pdf' required>";
        }

        $main .= <<<XML
            <label for="invPrice">Price<span>*</span>:</label>
        XML;

        if (isset($invPrice)) {
            $main .= "<input type='number' step='0.01' min='0' name='invPrice' id='invPrice' required value='$invPrice'>";
        } else {
            $main .= "<input type='number' step='0.01' min='0' name='invPrice' id='invPrice' required>";
        }

        $main .= <<<XML
            <label for="invStock">Stock<span>*</span>:</label>
        XML;

        if (isset($invStock)) {
            $main .= "<input type='number' min='1' name='invStock' id='invStock' required value='$invStock'>";
        } else {
            $main .= "<input type='number' min='1' name='invStock' id='invStock' required>";
        }

        $main .= <<<XML
            <label for="invColor">Color<span>*</span>:</label>
        XML;

        if (isset($invColor)) {
            $main .= "<input type='text' name='invColor' id='invColor' required value='$invColor'>";
        } else {
            $main .= "<input type='text' name='invColor' id='invColor' required>";
        }

        $main .= <<<XML
                <button type="submit" value="submit">Add Vehicle</button>
                <!-- Add the action name/value pair -->
                <input type="hidden" name="action" value="add-vehicle">
                <p>Need to add a vehicle classification? <a href="/app/vehicles/?action=add-classification-view">Add it HERE!</a></p>
            </form>
            <hr class="length-eighth-less">
            <br>
        XML;
        require $_SERVER['DOCUMENT_ROOT'].'/view/template.php';
    }
?>
