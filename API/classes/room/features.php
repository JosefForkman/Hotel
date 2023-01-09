<?php
    declare(strict_types=1);

    require_once('../classes/dbh.classes.php');

    class Feature extends dbh {
        function getAllFeatures() {
            $conn = $this->connect("hotel.db");

            $features = $conn->prepare("SELECT name, description, price FROM features JOIN feature ON features.roomId = feature.id;");
            $features->execute();
            return $features->fetchAll(PDO::FETCH_ASSOC);
        }
        function getFeature(int $id) {
            $conn = $this->connect("hotel.db");

            $feature = $conn->prepare("SELECT name, description, price FROM features JOIN feature ON features.roomId = feature.id WHERE features.roomId  = :id");
            $feature->bindParam(':id', $id);

            $feature->execute();
            return $feature->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
