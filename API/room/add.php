<?php
    require_once("../classes/room/room.php");

    # form inputs
    $imgFile = $_FILES["img"];
    $alt = htmlspecialchars(trim($_POST['alt']) , ENT_QUOTES);
    $name = htmlspecialchars(trim($_POST['name']) , ENT_QUOTES);
    $description = htmlspecialchars(trim($_POST['description']) , ENT_QUOTES);
    $price = (int) htmlspecialchars(trim($_POST['price']) , ENT_QUOTES);

    # add room class
    $room = new Room;
    $error = $room->add($imgFile, $alt, $name, $description, $price);

    if (empty($name) || empty($description) || empty($price)) {
        array_push($error["error"], "Måste fylla i alla fält");
    }

    header("Content-Type: application/json");
    if (!empty($error['error'])) {
        http_response_code(400);
        $error["status_code"] = 400;
        echo json_encode($error);
    } else {
        http_response_code(201);
        echo json_encode([
            "name" => $name,
            "description" => $description,
            "price" => $price,
            "alt" => $alt,
        ]);
    }
?>
