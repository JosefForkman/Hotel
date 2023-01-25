<?php

declare(strict_types=1);
require('./hotelFunctions.php');



use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\AppendStream;
use GuzzleHttp\Psr7\Request;


function getReservations(): array
{

    $dbName = 'hotel.db';
    $db = connect($dbName);

    $stmt = $db->prepare("SELECT reservation.id, reservation.arrival_date, reservation.departure_date, reservation.roomid FROM reservation");


    $stmt->execute();

    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $reservations;
}

function countTotalCost($reservations)
{

    $totalcost = 0;

    for ($i = 0; $i < count($reservations); $i++) {

        $arrivalDate = $reservations[$i]['arrival_date'];
        $departureDate = $reservations[$i]['departure_date'];
        $roomID = $reservations[$i]['roomId'];

        $arrivalDateTime = new DateTime($arrivalDate);
        $departureDateTime = new DateTime($departureDate);

        $interval = $arrivalDateTime->diff($departureDateTime);

        $daysInterval = $interval->days;
        $daysInterval = (int)$daysInterval;



        if ($roomID === 1) {
            $totalcost += ($daysInterval * 76);
        }
        if ($roomID === 2) {
            $totalcost += ($daysInterval * 62);
        }
        if ($roomID === 3) {
            $totalcost += ($daysInterval * 42);
        }
    }


    // foreach ($reservations as $key => $reservation) {
    //     $arrivalDate = $reservation[$key]['arrival_date'];
    //     $departureDate = $reservation[$key]['departure_date'];
    //     $roomID = $reservation[$key]['roomId'];
    // }



    return $totalcost;
}

function bookingRevenue($reservations)
{
    $bookingRevenue = countTotalCost($reservations) / count($reservations);
    echo floor($bookingRevenue);
}



countTotalCost(getReservations());



// $arrivalDateTime = new DateTime($reservations[1]['arrival_date']);
// $departureDateTime = new DateTime($reservations[1]['departure_date']);
// $interval = $arrivalDateTime->diff($departureDateTime);

// $daysInterval = $interval->days;
// $daysInterval = (int)$daysInterval;

// print_r(countTotalCost(getReservations()));
