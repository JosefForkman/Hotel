<?php
    declare(strict_types=1);
    require_once("../classes/room/room.php");

    # add room class
    $room = new Room;

    header("Content-Type: application/json");
    http_response_code();
    $id = $_GET["id"] ?? "0";
    $id = htmlspecialchars($id, ENT_QUOTES);

    if (is_numeric($id) && $id == "0") {
        echo json_encode($room->getAllRoom());
    } else {
        $data = $room->getRoom((int) $id);

        if (!$data) {
            http_response_code(404);
            $error["status_code"] = 404;
            $error["error"] = 'Kunde inte hitta med id = ' . $id;
            echo json_encode($error);
        } else {
            echo json_encode($data);
        }
    }

?>
