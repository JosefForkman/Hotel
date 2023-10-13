<?php
    declare(strict_types=1);
    namespace Josef\Hotel\Database;

    enum Table: string {
        case room = "room";
        case discount = "discount";
        case feature = "feature";
        case features = "features";
        case imgage = "imgage";
        case reservation = "reservation";
    };
    // enum Table {
    //     public static $Room = "room";
    //     public static $Discount = "discount";
    //     public static $Feature = "feature";
    //     public static $Features = "features";
    //     public static $Image = "imgage";
    //     public static $Reservation = "reservation";
    // }
?>

