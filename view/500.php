<?php
    header('HTTP/1.1 500 ');
    $title = 'Server Error | PHPMotors';

    $main = <<<XML
        <h1>Server Error</h1>
        <p>Sorry, our server seems to be experiencing some technical difficulties.</p>
        <hr class="length-eighth-less">
        <br>
    XML;

    require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/view/template.php';
?>