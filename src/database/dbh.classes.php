<?php
    declare(strict_types=1);
    namespace Josef\Hotel\database;

    use PDO;
    use PDOException;

    class Dbh {
        public function connect (string $dbName): PDO {
            try {
                # Skapar variablar för DB
                $dbPath = dirname(__DIR__, 2) . '/' . $dbName;
                $db = "sqlite:$dbPath";

                $option = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ];

                # Skapar anslutning till DB
                $conn = new PDO($db, null, null, $option);

                return $conn;
            } catch(PDOException $e) {
                echo "MySQL misslyckades att ansluta sig: " . $e->getMessage();
                die();
            }
        }
    }
?>
