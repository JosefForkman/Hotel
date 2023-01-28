<?php
    declare(strict_types=1);
    namespace Josef\Hotel;

    use Josef\Hotel\Database\Dbh;


    class Feature extends Dbh {
        function getAllFeatures() {
            $conn = $this->connect("hotel.db");

            $features = $conn->prepare("SELECT name, description, price FROM features JOIN feature ON features.roomId = feature.id;");
            $features->execute();
            return $features->fetchAll();
        }
        function getFeature(int $id) {
            $conn = $this->connect("hotel.db");

            $feature = $conn->prepare("SELECT name, description, price FROM features JOIN feature ON features.featureId = feature.id WHERE features.roomId = :id");
            $feature->bindParam(':id', $id);

            $feature->execute();
            return $feature->fetchAll();
        }
    }
?>
