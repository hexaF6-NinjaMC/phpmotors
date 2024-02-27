<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/app/images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1+Code:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/app/css/style.css" media="screen">
    <link rel="stylesheet" href="/app/css/medium.css" media="screen">
    <link rel="stylesheet" href="/app/css/large.css" media="screen">
    <title><?php if (isset($title)) { echo $title; }
    else { echo "Content Title | PHP Motors"; } ?></title>
</head>
<body>
    <?php require $_SERVER['DOCUMENT_ROOT'].'/app/snippets/header.php'; ?>

    <main><?php if (isset($main)) { echo $main; }
    else { echo "<h1 id='template-heading'>This is where {MAIN} content will be dynamically injected into this template.</h1>"; } ?>
    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'].'/snippets/footer.php'; ?>
    <script src="/app/js/update-date.js"></script>
    <script src="/app/js/hamburger.js"></script>
    <script src="/app/js/script.js"></script>
    <?php if (isset($scriptAdditions)) { echo $scriptAdditions; } ?>
</body>
</html>
<?php if (isset($extras)) { unset($_SESSION['message']); }?>
