<?php
    $title = "$classificationName vehicles | PHP Motors, Inc.";
    $main = "<h1>$classificationName vehicles</h1>";

    if (isset($_SESSION['message'])) {
        $main .= $_SESSION['message'];
    }

    if (isset($vehicleDisplay)) {
        $main .= $vehicleDisplay;
    }
    $main .= '
        <hr class="length-eighth-less">
        <br>';
    require $_SERVER['DOCUMENT_ROOT'].'/app/view/template.php';
?>
