<?php
    if ((!$_SESSION['loggedin']) or $_SESSION['clientData']['clientLevel'] < 2) {
        header('Location: /');
    } else {
        $title = "Vehicle Management | PHP Motors";
    
        $main = <<<XML
            <h1>Vehicle Management</h1>
        XML;

        if (isset($_SESSION['message'])) {
            $main .= $_SESSION['message'];
        }

        $main .= <<<XML
            <ul>
                <li><a href="/app/vehicles/?action=add-vehicle-view">Add a Vehicle to an already-existing Classification</a></li>
                <li><a href="/app/vehicles/?action=add-classification-view">Add a NEW Classification</a></li>
            </ul>
            <br>
        XML;

        if (isset($classificationList)) {
            $main .= <<<XML
                <section class="pl-two">
                    <h2>Vehicles By Classification</h2>
                    <p>Choose a classification to see those vehicles.</p>
            XML;

            $main .= $classificationList;
            $main .= <<<XML
                </section>
                <br>
            XML;
        }

        $main .= <<<XML
            <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            <table id="inventoryDisplay" class="pl-two"></table>
            <hr class="length-eighth-less">
            <br>
        XML;

        $scriptAdditions = <<<XML
            <script src="../js/inventory.js"></script>
        XML;

        require $_SERVER['DOCUMENT_ROOT'].'/view/template.php';
    }
?>
