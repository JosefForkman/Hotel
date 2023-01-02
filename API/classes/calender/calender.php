<?php
    declare(strict_types=1);

    require_once('../classes/dbh.classes.php');

    class Calender extends dbh {

        function add( string $arrival_date, string $departure_date, int $id) {
            $conn = $this->connect("hotel.db");

            $calender = $conn->prepare("INSERT INTO reservation (arrival_date, departure_date, roomId) VALUES (:arrival_date, :departure_date, :roomId)");

            $calender->bindParam(":arrival_date", $arrival_date);
            $calender->bindParam(":departure_date", $departure_date);
            $calender->bindParam(":roomId", $id);

            $calender->execute();
        }

        function getCalender($arrival_date, $departure_date, int $id) {
            $conn = $this->connect("hotel.db");

            $calender = $conn->prepare("SELECT * FROM reservation WHERE reservation.roomId = :id AND arrival_date >= :arrival_date AND departure_date <= :departure_date;");

            $calender->bindParam(":id", $id);
            $calender->bindParam(":arrival_date", $arrival_date);
            $calender->bindParam(":departure_date", $departure_date);

            $calender->execute();

            return $calender->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
