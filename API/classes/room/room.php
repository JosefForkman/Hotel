<?php
    declare(strict_types=1);

    require_once('../classes/dbh.classes.php');

    class Room extends dbh {

        function add($imgFile, string $alt, string $name, string $description, int $price) {
            $error = [];
            $errors = [];
            $conn = $this->connect("hotel.db");


            $file = $imgFile;
            $file_temp = $file["tmp_name"];
            $file_size = $file["size"];
            $file_name = $file["name"];
            $file_error = $file["error"];

            $target_dir = dirname(__DIR__, 3). "/img/";
            $target_file = $target_dir . basename($file_name);
            $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $allow_Files = [ "png", "jpg", "JPEG", "webp" ];

            # error check
            ## Check if file already exists
            if (file_exists($target_file)) {
                array_push($error, "filen finns redan");
            }

            ## Check if file is bigger then 300kb
            if ($file_size >= 307200) {
                array_push($error, "filen är för stor");
            }

            ## check if file is allowed
            if (!in_array($file_type, $allow_Files)) {
                array_push($error, "filen är förbjuden");
            }

            ## file error
            if ($file_error != 0) {
                array_push($error, "file okänt fel");
            }

            if (empty($error)) {
                // move_uploaded_file($file_temp, $target_file);
                # room insert
                $room = $conn->prepare("INSERT INTO room (name, description, price) VALUES (:name, :description, :price)");

                $room->bindParam(":name", $name);
                $room->bindParam(":description", $description);
                $room->bindParam(":price", $price);
                $room->execute();
                $roomId = $conn->lastInsertId();


                # image insert
                $image = $conn->prepare("INSERT INTO imgage (url, alt, roomId) VALUES (:url, :alt, :roomId)");
                $image->bindParam(":url", $file_name);
                $image->bindParam(":alt", $alt);
                $image->bindParam(":roomId", $roomId);
                $image->execute();
            }

            $errors["error"] = $error;
            return $errors;
        }

        function getAllRoom() {
            $conn = $this->connect("hotel.db");

            $rums = $conn->prepare("SELECT room.id as room_id, url, alt, name, description, price FROM imgage JOIN room ON imgage.roomId = room.id");
            $rums->execute();
            return $rums->fetchAll(PDO::FETCH_ASSOC);
        }
        function getRoom(int $id) {
            $conn = $this->connect("hotel.db");

            $rums = $conn->prepare("SELECT url, alt, name, description, price FROM imgage JOIN room ON imgage.roomId = room.id WHERE room.id = $id");
            $rums->execute();
            return $rums->fetch(PDO::FETCH_ASSOC);
        }
    }
?>
