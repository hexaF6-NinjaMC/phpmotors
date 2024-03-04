<?php
    // Reviews model

    // Add review information to the database table
    function addVehicleReview($reviewText, $invId, $clientId) {
        $db = phpmotorsConnect();
        $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
        $stmt = $db->prepare($sql);
        // Store the review information
        $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->execute();
        
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    // Update a selected review's text to the database table
    function updateReview($reviewId, $reviewText) {
        $db = phpmotorsConnect();
        $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
        $stmt = $db->prepare($sql);
        // Store the updated review information
        $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        $stmt->execute();

        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    // Get All Vehicle Reviews by Client's ID from reviews table
    function getReviews($clientId) {
        $db = phpmotorsConnect();
        $sql = 'SELECT reviewId, reviewText, reviewDate, reviews.invId, reviews.clientId, inventory.invMake, inventory.invModel FROM reviews JOIN inventory JOIN clients ON reviews.invId = inventory.invId AND reviews.clientId = clients.clientId WHERE reviews.invId = inventory.invId AND reviews.clientId = :clientId ORDER BY reviewDate DESC';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
        $stmt->execute();
        $reviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $reviewArray;
    }

    // Delete review information from the reviews table
    function deleteReview($reviewId) {
        $db = phpmotorsConnect();
        $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        return $result;
    }

    function getReviewsByInvId($invId) {
        $db = phpmotorsConnect();
        $sql = "SELECT reviews.*, clients.clientId, clients.clientFirstname, clients.clientLastname FROM reviews JOIN clients WHERE reviews.invId = :invId AND reviews.clientId = clients.clientId ORDER BY reviewDate DESC, reviewId ASC";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $reviewsArr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $reviewsArr;
    }

    function getClientReviewByReviewId($reviewId) {
        $db = phpmotorsConnect();
        $sql = "SELECT reviews.* FROM reviews JOIN clients JOIN inventory WHERE reviewId = :reviewId";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
        $stmt->execute();
        $reviewData = $stmt->fetch();
        $stmt->closeCursor();
        return $reviewData;
    }
?>