<?php
    declare(strict_types=1);

    require_once('../dbh.classes.php');

    class room extends dbh {

        protected function add(string $imgFile, string $alt, string $name, string $description, int $price) {

            # room insert
            $room = $this->connect("hotel.db")->prepare("INSERT INTO room (name, description, price) VALUES (:name, :description, :price)");

            $room->bindParam(":name", $name);
            $room->bindParam(":description", $description);
            $room->bindParam(":price", $price);
            $room->execute();

            # image insert
            $file = $_FILES[$imgFile];
            $file_temp = $file["tmp_name"];
            $file_size = $file["size"];
            $file_name = $file["name"];

            $target_dir = __DIR__ . "/img/";
            $target_file = $target_dir . basename($file_name);
            $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            ## error check
            ### Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // $file = move_uploaded_file($file_temp, )
            $image = $this->connect("hotel.db")->prepare("INSERT INTO image (url, alt) VALUES (:url, :alt)");

            $image->bindParam(":url", $url);
            $image->bindParam(":alt", $alt);
            $image->execute();
        }
    }

?>
