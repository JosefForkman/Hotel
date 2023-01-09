<?php
    require_once("../classes/room/room.php");
    require_once("../classes/room/features.php");

    # Post
    function add() {
        # add room class
        $room = new Room;

        # error
        $error = [];

        # form inputs
        $alt = htmlspecialchars(trim($_POST['alt']) , ENT_QUOTES) ;
        $name = htmlspecialchars(trim($_POST['name']) , ENT_QUOTES) ;
        $description = htmlspecialchars(trim($_POST['description']) , ENT_QUOTES);
        $price = (int) htmlspecialchars(trim($_POST['price']) , ENT_QUOTES);


        # File variabels
        $file = $_FILES["img"];
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
        if (empty($name) || empty($description) || empty($price)) {
            array_push($error["error"], "Måste fylla i alla fält");
        }

        $img = [
            'name' => $file_name,
            'file_temp' => $file_temp,
            'target_file' => $target_file,
        ];

        # Respond
        header("Content-Type: application/json");

        if (count($error) != 0) {
            http_response_code(400);
            $error["status_code"] = 400;
            echo json_encode($error);
        } else {

            $room->add($img, $alt, $name, $description, $price);

            http_response_code(201);
            echo json_encode([
                "name" => $name,
                "description" => $description,
                "price" => $price,
                "alt" => $alt,
            ]);
        }
    }

    # Get room
    function get() {
        $room = new Room;
        $Feature = new Feature;

        $id = $_GET["id"] ?? "0";
        $id = htmlspecialchars($id, ENT_QUOTES);

        $data = $room->getRoom((int) $id);

        /* Add feature array */
        $feature = $Feature->getFeature($id);
        $data['features'] = $feature? $feature : [];

        if (!$data) {
            http_response_code(404);
            $error["code"] = 404;
            $error["error"] = 'Kunde inte hitta med id = ' . $id;
            echo json_encode($error);
        } else {
            echo json_encode($data);
        }
    }

    function getFeature() {
        $room = new Feature;

        $id = $_GET["id"] ?? "0";
        $id = htmlspecialchars($id, ENT_QUOTES);

        $data = $room->getFeature((int) $id);

        if (!$data) {
            echo json_encode([]);
        } else {
            echo json_encode($data);
        }
    }

    function getAll() {
        $room = new Room;

        echo json_encode($room->getAllRoom());
    }
    function getAllFeatures() {
        $room = new Feature;

        echo json_encode($room->getAllFeatures());
    }
?>
