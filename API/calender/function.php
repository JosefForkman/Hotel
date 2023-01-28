<?php
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");
use Josef\Hotel\Calender;
use Josef\Hotel\Feature;
use Josef\Hotel\YRGO;


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
    $Feature = new Feature();

    # error
    $error = [];
    $errors = [];

    # form inputs
    $id = $_GET['id'];

    if (isset($_POST['arrival_date']) && isset($_POST['departure_date']) && isset($_POST['user_name']) && isset($_POST['person_nr']) && isset($_POST['totalCost'])) {

        $arrival_date =  $_POST['arrival_date'];
        $departure_date = $_POST['departure_date'];
        $userName = $_POST['user_name'];
        $personNr = $_POST['person_nr'];
        $totalCost = $_POST['totalCost'];

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
            # Skapar Transfer code
            // die(var_dump([$personNr, $userName, $totalCost]));
            $createTransferCode = $yrgo->createTransferCode($personNr, $userName, $totalCost);
            die(var_dump($createTransferCode ));

            $errors['error'] = $error;
            if ($createTransferCode) {
                # Gör betalningen
                $yrgo->consumeTransferCode($createTransferCode['transferCode']);

                # Lägger till bokningen i kalendern
                $calender->add($arrival_date, $departure_date, $id);

                # Tar fram alla "Features"
                $feature = $Feature->getFeature($id);
                $feature = $feature ? $feature : [];


                $feature = array_map(function($item) {
                    return [
                        "name" => $item['name'],
                        "price" => $item['price']
                    ];
                }, $feature);
                // die(json_encode($feature));

                $arrival_date = new DateTimeImmutable($arrival_date);
                $arrival_date = $arrival_date->format('Y-m-d');

                $departure_date = new DateTimeImmutable($departure_date);
                $departure_date = $departure_date->format('Y-m-d');

                http_response_code(201);
                echo json_encode([
                    "island" => "Josef island",
                    "hotel" => "Budget hostel",
                    "arrival_date" => $arrival_date,
                    "departure_date" => $departure_date,
                    "total_cost" => $totalCost,
                    "stars" => "4",
                    "features" => $feature,
                    "addtional_info" => []
                ]);
            }
        }
    } else {
        http_response_code(404);
        $errors["status_code"] = 404;
        array_push($error, "Måste ange alla värdena namn, person nr, total kostnad startdatum och slutdatum");

        $errors['error'] = $error;
        echo json_encode($errors);
    }
}
