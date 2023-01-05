<?php

    require_once(dirname(__DIR__, 1) . "/classes/calender/calender.php");
    require_once(dirname(__DIR__, 1) . "/classes/yrgopelago/api.php");


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

    function book() {
        $calender = new Calender();
        $yrgo = new YRGO();

        # error
        $error = [];
        $errors = [];

        # form inputs
        $arrival_date =  $_POST['arrival_date'];
        $departure_date = $_POST['departure_date'];

        $userName = $_POST['user_name'];
        $personNr = $_POST['person_nr'];
        $totalCost = $_POST['totalCost'];

        $id = $_GET['id'];

        # error check
        if (!$calender->validateDate($arrival_date) || !$calender->validateDate($departure_date)) {
                array_push($error, "Måste ange en giltig datum i ISO 8601 format");
        }

        if (!$yrgo->checkTransferCode($personNr, $totalCost)) {
            array_push($error, "Måste ange en giltig person nr");
        }

        # Respond

        if (count($error) != 0) {
            http_response_code(400);
            $error["status_code"] = 400;
            echo json_encode($error);
        } else {
            $createTransferCode = $yrgo->createTransferCode($personNr, $userName, $totalCost);

            if ($createTransferCode) {
                $consumeTransferCode = $yrgo->consumeTransferCode($createTransferCode['transferCode']);
                $calender->add($arrival_date, $departure_date, $id);

                http_response_code(201);
                echo json_encode([
                    "arrival-date" => $arrival_date,
                    "departure-date" => $departure_date
                ]);
            }
        }
    }
