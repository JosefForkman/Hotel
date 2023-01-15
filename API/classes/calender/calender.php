<?php
    declare(strict_types=1);

    require_once dirname(__DIR__) . "/dbh.classes.php";

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

            return $calender->fetchAll();
        }


        # validateDate hittad på https://stackoverflow.com/a/8003798
        function validateDate($date) {
            # reg ex är modifierad och hittad på https://www.myintervals.com/blog/2009/05/20/iso-8601-date-validation-that-doesnt-suck/
            if (preg_match('/^([\+-]?\d{4}(?!\d{2}\b))((-?)((0[1-9]|1[0-2])(\3([12]\d|0[1-9]|3[01]))?|W([0-4]\d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]\d|[12]\d{2}|3([0-5]\d|6[1-6])))([T\s]((([01]\d|2[0-3])((:?)[0-5]\d)?|24\:?00)([\.,]\d+(?!:))?)?(\17[0-5]\d([\.,]\d+)?)?([zZ]|([\+-])([01]\d|2[0-3]):?([0-5]\d)?)?)?)?$/i', $date, $parts) == true) {
                # tid
                $hour = (int) explode(":", $parts[13])[0];
                $minute = (int) explode(":", $parts[13])[1];
                $second = (int) explode(":", $parts[14])[1];


                # datum
                $year = (int) $parts[1];
                $month = (int) explode("-", $parts[4])[0];
                $day = (int) explode("-", $parts[4])[1];


                # Ger Unix timestamp av en GMT datum
                $time = gmmktime(
                    $hour, # hour
                    $minute, # minute
                    $second, # second
                    $month, # month
                    $day, # day
                    $year # year
                );


                #  Parse about any English textual datetime description into a Unix timestamp
                ## Returns a timestamp on success, false otherwise.
                $input_time = strtotime($date);

                if ($input_time === false) return false;

                return $input_time == $time;
            } else {
                return false;
            }
        }
    }
?>
