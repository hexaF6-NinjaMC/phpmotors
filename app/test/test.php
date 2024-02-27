<?php
    $title = "Dashboard | PHP Motors";
    $email = $_POST['clientEmail'];
    $main = <<<XML
    <h1>Welcome, $email</h1>
    <p>This is your Dashboard.</p>
    XML;
    require $_SERVER['DOCUMENT_ROOT'].'/app/view/template.php';
?>