<?php
    /*
    * Proxy connection to the phpmotors database
    */

    function phpmotorsConnect() {
        $server = $_ENV['MYSQLHOST'];
        $dbname = $_ENV['MYSQL_DATABASE'];
        $username = $_ENV['MYSQLUSER'];
        $password = $_ENV['MYSQLPASSWORD'];
        $dsn = "mysql:host=$server;dbname=$dbname";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $link = new PDO($dsn, $username, $password, $options);
            if (is_object($link)) {
                // echo 'It worked!';
                return $link;
            }
        } catch (PDOException $e) {
            // echo "It didn't work, error: ".$e->getMessage();
            header('Location: /app/view/500.php');
            exit;
        }
    }
    
    phpmotorsConnect();
?>

