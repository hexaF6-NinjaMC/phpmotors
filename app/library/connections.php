<?php
    /*
    * Proxy connection to the phpmotors database
    */

    function phpmotorsConnect() {
        $server = $_ENV['MYSQLHOST'];
        $dbname = $_ENV['MYSQL_DATABASE'];
        $username = $_ENV['MYSQLUSER'];
        $password = $_ENV['MYSQLPASSWORD'];
        $dsn = "mysql://root:6B5cH41ffDe2-FH3AFgfG63ebaAh2D41@viaduct.proxy.rlwy.net:26657/railway";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $link = new PDO($dsn, $username, $password, $options);
            if (is_object($link)) {
                // echo 'It worked!';
                return $link;
            }
        } catch (PDOException $e) {
            // echo "It didn't work, error: ".$e->getMessage();
            header('Location: /view/500.php');
            exit;
        }
    }
    
    phpmotorsConnect();
?>

