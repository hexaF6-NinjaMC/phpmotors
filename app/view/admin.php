<?php
    if (!$_SESSION['loggedin']) {
        header('Location: /');
    } else {
        $title = "Admin | PHP Motors";

        $clientData = $_SESSION['clientData'];

        $main = <<<XML
            <h1>Welcome, $clientData[clientFirstname].</h1>
            <p class="message notice">You are currently logged in.</p>
            <br>
        XML;

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }

        $main .= <<<XML
            <ul>
                <li>First name: $clientData[clientFirstname]</li>
                <li>Last name: $clientData[clientLastname]</li>
                <li>Email: $clientData[clientEmail]</li>
            </ul>
            <br>
            <hr class="length-eighth-less">
            <section class="pl-two">
                <h2>Your Reviews:</h2>
        XML;

        if (isset($reviews)) {
            $main .= $reviews;
        }
        
        $main .= "</section>";

        $main .= <<<XML
            <hr class="length-eighth-less">
            <section class="pl-two pb-two">
                <h2>Update Account Info</h2>
                <p>Update your account information below.</p>
                <a href="/accounts/?action=updateAccount">Update my information</a>
            </section>
            <hr class="length-eighth-less">
            <br>
        XML;

        if ($clientData['clientLevel'] > 1) {
            $main .= <<<XML
                <section class="pl-two pb-two">
                    <h2>Vehicle Management System</h2>
                    <p>Access the vehicle management system below.</p>
                    <a href="/vehicles/">Vehicle Management System</a>
                </section>
                <hr class="length-eighth-less">
                <br>
            XML;
        }
    }
    require $_SERVER['DOCUMENT_ROOT'].'/view/template.php';
?>
