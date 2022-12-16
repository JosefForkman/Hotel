<?php
    class Dbh {
        public function connect (): object {
            try {
                # Skapar variablar för DB
                $dbPath = __DIR__ . '/' . $dbName;
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
