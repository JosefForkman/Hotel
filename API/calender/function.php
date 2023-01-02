<?php
    require_once("../classes/calender/calender.php");

    function get() {
        $calender = new Calender();

        $id = $_GET["id"] ?? "0";
        $id = htmlspecialchars($id, ENT_QUOTES);

        $start = $_GET["start"];
        $end = $_GET["end"];


        $data = $calender->getCalender($start, $end, (int) $id);

        $data = array_map(function ($value) {
            return [
                "start" => $value["arrival_date"],
                "end" => $value["departure_date"],
                "title" => "Bokad",
                "allDay" => true
            ];
        }, $data);

        if (!$data) {
            http_response_code();

            echo json_encode($data);
        } else {
            echo json_encode($data);
        }
    }
?>
