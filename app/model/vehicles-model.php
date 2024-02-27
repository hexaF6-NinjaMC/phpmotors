<?php
    // Vehicles Model

    function sanitize($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function addVehicleClassification($classificationName) {
        // Create a connection object from the phpmotors connection function
        $db = phpmotorsConnect();

        // The SQL statement to be used with the database
        $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';

        // The next line creates the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        // The next line(s) will replace the placeholders in the SQL statement with the
        // actual values in the variables, and tells the database the type of data it is.
        $stmt->bindValue(':classificationName', sanitize($classificationName), PDO::PARAM_STR);

        // Insert the data
        $stmt->execute();

        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        // Close the database interaction
        $stmt->closeCursor();

        // Return the indication of success (rows changed)
        return $rowsChanged;
    }

    function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) {
        // Create a connection object from the phpmotors connection function
        $db = phpmotorsConnect();

        // The SQL statement to be used with the database
        $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId) VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';

        // The next line creates the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        // The next line(s) will replace the placeholders in the SQL statement with the
        // actual values in the variables, and tells the database the type of data it is.
        $stmt->bindValue(':invMake', sanitize($invMake), PDO::PARAM_STR);
        $stmt->bindValue(':invModel', sanitize($invModel), PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', sanitize($invDescription), PDO::PARAM_STR);
        $stmt->bindValue(':invImage', sanitize($invImage), PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', sanitize($invThumbnail), PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', sanitize($invPrice), PDO::PARAM_STR);
        $stmt->bindValue(':invStock', sanitize($invStock), PDO::PARAM_INT);
        $stmt->bindValue(':invColor', sanitize($invColor), PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);

        // Insert the data
        $stmt->execute();

        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        // Close the database interaction
        $stmt->closeCursor();

        // Return the indication of success (rows changed)
        return $rowsChanged;
    }

    // Get vehicle information by invId
    function getInvItemInfo($invId) {
        $db = phpmotorsConnect();
        $sql = 'SELECT inventory.* FROM inventory WHERE inventory.invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }

    function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId) {
        // Create a connection object from the phpmotors connection function
        $db = phpmotorsConnect();

        // The SQL statement to be used with the database
        $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
        invDescription = :invDescription, invImage = :invImage, 
        invThumbnail = :invThumbnail, invPrice = :invPrice, 
        invStock = :invStock, invColor = :invColor, 
        classificationId = :classificationId WHERE invId = :invId';

        // The next line creates the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        // The next line(s) will replace the placeholders in the SQL statement with the
        // actual values in the variables, and tells the database the type of data it is.
        $stmt->bindValue(':invMake', sanitize($invMake), PDO::PARAM_STR);
        $stmt->bindValue(':invModel', sanitize($invModel), PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', sanitize($invDescription), PDO::PARAM_STR);
        $stmt->bindValue(':invImage', sanitize($invImage), PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', sanitize($invThumbnail), PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', sanitize($invPrice), PDO::PARAM_STR);
        $stmt->bindValue(':invStock', sanitize($invStock), PDO::PARAM_INT);
        $stmt->bindValue(':invColor', sanitize($invColor), PDO::PARAM_STR);
        $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

        // Insert the data
        $stmt->execute();

        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        // Close the database interaction
        $stmt->closeCursor();

        // Return the indication of success (rows changed)
        return $rowsChanged;
    }

    function deleteVehicle($invId) {
        // Create a connection object from the phpmotors connection function
        $db = phpmotorsConnect();

        // The SQL statement to be used with the database
        $sql = 'DELETE FROM inventory WHERE invId = :invId';

        // The next line creates the prepared statement using the phpmotors connection
        $stmt = $db->prepare($sql);

        // The next line(s) will replace the placeholders in the SQL statement with the
        // actual values in the variables, and tells the database the type of data it is.
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

        // Insert the data
        $stmt->execute();

        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();

        // Close the database interaction
        $stmt->closeCursor();

        // Return the indication of success (rows changed)
        return $rowsChanged;
    }

    function getVehiclesByClassification($classificationName) {
        $db = phpmotorsConnect();
        $sql = 'SELECT images.invId, invMake, invModel, invDescription, imgPath, invPrice, invStock, invColor FROM inventory JOIN images ON inventory.invId = images.invId WHERE imgName LIKE "%-tn.%" AND imgPrimary = 1 AND classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $vehicles;
    }

    function buildVehiclesDisplay($vehicles) {
        $dv = '<ul id="inv-display">';
        foreach ($vehicles as $vehicle) {
            $vehicle['invPrice'] = number_format($vehicle['invPrice'], 2);
            $dv .= '<li>';
            $dv .= "<a href='/phpmotors/vehicles/?action=vehicleInformation&invId=$vehicle[invId]'><img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
            $dv .= "<a href='/phpmotors/vehicles/?action=vehicleInformation&invId=$vehicle[invId]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
            $dv .= "<span>\$$vehicle[invPrice]</span>";
            $dv .= '</li>';
        }
        $dv .= '</ul>';
        return $dv;
    }

    // Get information for all vehicles
    function getVehicles(){
        $db = phpmotorsConnect();
        $sql = 'SELECT invId, invMake, invModel FROM inventory';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }
?>