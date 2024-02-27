<?php
    /*
    * Proxy connection to the phpmotors database
    */

    function phpmotorsConnect() {
        $server = $_ENV['MYSQLHOST'];
        $dbname = $_ENV['MYSQL_DATABASE'];
        $username = $_ENV['MYSQLUSER'];
        $password = $_ENV['MYSQLPASSWORD'];
        $dsn = "mysql:host=$server;dbname=$dbname;port=26657";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $link = new PDO($dsn, $username, $password, $options);
            if (is_object($link)) {
                // echo 'It worked!';
                return $link;
            }
        } catch (PDOException $e) {
<<<<<<< HEAD
            // echo "It didn't work, error: ".$e->getMessage();
            header('Location: /app/view/500.php');
=======
            echo "It didn't work, error: ".$e->getMessage();
            header('Location: /view/500.php');
>>>>>>> 61512317d66696dbdd15a99085838ddcadae92c0
            exit;
        }
    }
    
    phpmotorsConnect();
?>

