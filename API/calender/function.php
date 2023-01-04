<?php
    require_once("../classes/calender/calender.php");
    use GuzzleHttp\Client;

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

        # error
        $error = [];
        $errors = [];

        # form inputs
        $arrival_date =  $_GET['arrival_date'];
        $departure_date = $_GET['departure_date'];
        $id = $_GET['id'];

        # error check
        if (!$calender->validateDate($arrival_date) || !$calender->validateDate($departure_date)) {
            array_push($error, "Måste ange en giltig datum i ISO 8601 format");
        }

        # Respond
        header("Content-Type: application/json");

        if (count($error) != 0) {
            http_response_code(400);
            $error["status_code"] = 400;
            echo json_encode($error);
        } else {

            $calender->add($arrival_date, $departure_date, $id);

            $client = new Client();

            $createTransferCode = $client->request('POST', 'https://www.yrgopelago.se/centralbank/withdraw', [
                'form_params' => [
                    'user' => 'bar',
                    'api_key' => 'ab14cbb2-f550-46e6-97c2-bb7f0126733e',
                    'amount' => '10'
                ]
            ]);

            // // echo $createTransferCode->getBody()->getContents();


            http_response_code(201);
            // echo json_encode([
            //     "arrival-date" => $arrival_date,
            //     "departure-date" => $departure_date
            // ]);
        }
    }
?>
