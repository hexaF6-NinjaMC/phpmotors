<?php
    if ((!$_SESSION['loggedin']) or $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /');
    } else {
        // Add Dynamic Title
        if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            $title = "Modify $invInfo[invMake] $invInfo[invModel] | PHPMotors";
        } elseif (isset($invMake) && isset($invModel)) {
            $title = "Modify $invMake $invModel | PHPMotors";
        };
        
        // Add Dynamic H1
        if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            $main = "<h1>Modify $invInfo[invMake] $invInfo[invModel]</h1>";
        } elseif (isset($invMake) && isset($invModel)) {
            $main = "<h1>Modify $invMake $invModel</h1>";
        };

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }

        $main .= <<<XML
            <form method="post" action="/vehicles/">
                <p><span>*</span>: Required</p>
        XML;

        $classificationList = '<select name="classificationName" id="classificationName">';
        foreach ($classifications as $classification) {
            $classificationList .= "<option value='$classification[classificationId]'";
            if (isset($classificationId)) {
                if ($classification['classificationId'] == $classificationId) {
                    $classificationList .= ' selected ';
                }
            } elseif (isset($invInfo['classificationId'])) {
                if ($classification['classificationId'] === $invInfo['classificationId']){
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
        } elseif (isset($invInfo['invMake'])) {
            $main .= "<input type='text' name='invMake' id='invMake' required value='$invInfo[invMake]'>";
        } else {
            $main .= "<input type='text' name='invMake' id='invMake' required>";
        }

        $main .= <<<XML
            <label for="invModel">Model<span>*</span>:</label>
        XML;

        if (isset($invModel)) {
            $main .= "<input type='text' name='invModel' id='invModel' required value='$invModel'>";
        } elseif (isset($invInfo['invModel'])) {
            $main .= "<input type='text' name='invModel' id='invModel' required value='$invInfo[invModel]'>";
        } else {
            $main .= "<input type='text' name='invModel' id='invModel' required>";
        }

        $main .= <<<XML
            <label for="invDescription">Description<span>*</span>:</label>
        XML;

        if (isset($invDescription)) {
            $main .= "<textarea name='invDescription' id='invDescription' required>$invDescription</textarea>";
        } elseif (isset($invInfo['invDescription'])) {
            $main .= "<textarea name='invDescription' id='invDescription' required>$invInfo[invDescription]</textarea>";
        } else {
            $main .= "<textarea name='invDescription' id='invDescription' required></textarea>";
        }
        
        $main .= <<<XML
            <label for="invImage">Image Path<span>*</span>:</label>
        XML;

        if (isset($invImage)) {
            $main .= "<input type='text' name='invImage' id='invImage' accept='image/*,.pdf' required value='$invImage'>";
        } elseif (isset($invInfo['invImage'])) {
            $main .= "<input type='text' name='invImage' id='invImage' accept='image/*,.pdf' required value='$invInfo[invImage]'>";
        } else {
            $main .= "<input type='text' name='invImage' id='invImage' accept='image/*,.pdf' required>";
        }

        $main .= <<<XML
            <label for="invThumbnail">Thumbnail Path<span>*</span>:</label>
        XML;

        if (isset($invThumbnail)) {
            $main .= "<input type='text' name='invThumbnail' id='invThumbnail' accept='image/*,.pdf' required value='$invThumbnail'>";
        } elseif (isset($invInfo['invThumbnail'])) {
            $main .= "<input type='text' name='invThumbnail' id='invThumbnail' accept='image/*,.pdf' required value='$invInfo[invThumbnail]'>";
        } else {
            $main .= "<input type='text' name='invThumbnail' id='invThumbnail' accept='image/*,.pdf' required>";
        }

        $main .= <<<XML
            <label for="invPrice">Price<span>*</span>:</label>
        XML;

        if (isset($invPrice)) {
            $main .= "<input type='number' step='0.01' min='0' name='invPrice' id='invPrice' required value='$invPrice'>";
        } elseif (isset($invInfo['invPrice'])) {
            $main .= "<input type='number' step='0.01' min='0' name='invPrice' id='invPrice' required value='$invInfo[invPrice]'>";
        } else {
            $main .= "<input type='number' step='0.01' min='0' name='invPrice' id='invPrice' required>";
        }

        $main .= <<<XML
            <label for="invStock">Stock<span>*</span>:</label>
        XML;

        if (isset($invStock)) {
            $main .= "<input type='number' min='1' name='invStock' id='invStock' required value='$invStock'>";
        } elseif (isset($invInfo['invStock'])) {
            $main .= "<input type='number' min='1' name='invStock' id='invStock' required value='$invInfo[invStock]'>";
        } else {
            $main .= "<input type='number' min='1' name='invStock' id='invStock' required>";
        }

        $main .= <<<XML
            <label for="invColor">Color<span>*</span>:</label>
        XML;

        if (isset($invColor)) {
            $main .= "<input type='text' name='invColor' id='invColor' required value='$invColor'>";
        } elseif (isset($invInfo['invColor'])) {
            $main .= "<input type='text' name='invColor' id='invColor' required value='$invInfo[invColor]'>";
        } else {
            $main .= "<input type='text' name='invColor' id='invColor' required>";
        }

        $main .= <<<XML
                <button type="submit" value="submit">Update Vehicle</button>
                <!-- Add the action name/value pair -->
                <input type="hidden" name="action" value="updateVehicle">
        XML;

        if (isset($invInfo['invId'])) {
            $main .= "<input type='hidden' name='invId' value='$invInfo[invId]'>";
        } elseif (isset($invId)) {
            $main .= "<input type='hidden' name='invId' value='$invId'>";
        }

        $main .= <<<XML
            </form>
            <hr class="length-eighth-less">
            <br>
        XML;
        
        require $_SERVER['DOCUMENT_ROOT'].'/view/template.php';
    }
?>
