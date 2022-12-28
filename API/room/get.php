<?php
    declare(strict_types=1);
    require_once("../classes/room/room.php");

    # add room class
    $room = new Room;

    header("Content-Type: application/json");
    http_response_code();
    echo json_encode($room->getAllRoom());
?>
