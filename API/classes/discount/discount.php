<?php
    declare(strict_types=1);

    require_once dirname(__DIR__) . "/dbh.classes.php";

    class Discount extends Dbh {
        public function add( string $name, string $amount) {
            $conn = $this->connect("hotel.db");

            $discount = $conn->prepare("INSERT INTO discount (name, amount) VALUES (:name, :amount);");

            $discount->bindParam(':name', $name);
            $discount->bindParam(':amount', $amount);

            $discount->execute();
        }

        public function Get (string $name): array | bool
        {
            $conn = $this->connect("hotel.db");

            $discount = $conn->prepare("SELECT name, amount FROM discount WHERE name = :name");

            $discount->bindParam(':name', $name);

            $discount->execute();

            return $discount->fetch();
        }
    }
?>
