<?php
    declare(strict_types=1);
    namespace josef\hotel;

    require_once dirname(__DIR__, 2) . "/vendor/autoload.php";

    use Josef\Hotel\database\Dbh;

    class Feature extends dbh {
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
