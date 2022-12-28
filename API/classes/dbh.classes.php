<?php
    class Dbh {
        public function connect (string $dbName) {
            try {
                # Skapar variablar för DB
                $dbPath = dirname(__DIR__, 2) . '/' . $dbName;
                $db = "sqlite:$dbPath";

                # Skapar anslutning till DB
                $conn = new PDO($db);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $conn;
            } catch(PDOException $e) {
                echo "MySQL misslyckades att ansluta sig: " . $e->getMessage();
                die();
            }
        }
    }
?>
