<?php
    declare(strict_types=1);

    require_once('../classes/dbh.classes.php');

    class Room extends dbh {

        function add($img, string $alt, string $name, string $description, int $price) {
            $conn = $this->connect("hotel.db");

            # room insert
            $room = $conn->prepare("INSERT INTO room (name, description, price) VALUES (:name, :description, :price)");

            $room->bindParam(":name", $name);
            $room->bindParam(":description", $description);
            $room->bindParam(":price", $price);
            $room->execute();
            $roomId = $conn->lastInsertId();

            move_uploaded_file($img['file_temp'], $img['target_file']);

            # image insert
            $image = $conn->prepare("INSERT INTO imgage (url, alt, roomId) VALUES (:url, :alt, :roomId)");
            $image->bindParam(":url", $img['name']);
            $image->bindParam(":alt", $alt);
            $image->bindParam(":roomId", $roomId);
            $image->execute();
        }

        function getAllRoom() {
            $conn = $this->connect("hotel.db");

            $rums = $conn->prepare("SELECT room.id as room_id, url, alt, name, description FROM imgage JOIN room ON imgage.roomId = room.id");
            $rums->execute();
            return $rums->fetchAll(PDO::FETCH_ASSOC);
        }
        function getRoom(int $id) {
            $conn = $this->connect("hotel.db");

            $rums = $conn->prepare("SELECT url, alt, name, description, price FROM imgage JOIN room ON imgage.roomId = room.id WHERE room.id = :id");
            $rums->bindParam(":id", $id);

            $rums->execute();
            return $rums->fetch(PDO::FETCH_ASSOC);
        }
    }
?>
