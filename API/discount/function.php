<?php
    require_once dirname(__DIR__) . "/classes/discount/discount.php";

    function add() {
        # add room class
        $discount = new Discount;

        # error
        $error = [];

        if (isset($_POST['amount'], $_POST['name'])) {
            # form inputs
            $amount = htmlspecialchars(trim($_POST['amount']) , ENT_QUOTES);
            $name = htmlspecialchars(trim($_POST['name']) , ENT_QUOTES);

            # error check
            if (empty($name) || empty($amount) ) {
                array_push($error["error"], "Måste fylla i allt");
            }

            # Respond
            if (count($error) != 0) {
                http_response_code(400);
                $error["status_code"] = 400;
                echo json_encode($error);
            } else {

                $discount->add($name, $amount);

                http_response_code(201);
                echo json_encode([
                    "name" => $name,
                    "amount" => $amount
                ]);
            }
        } else {
            http_response_code(404);
        }
    }

    function get() {
        # add room class
        $Discount = new Discount;

        # error
        $error = [];

        // die(var_dump(isset($_GET["name"])));

        if (isset($_GET["name"])) {
            $name = htmlspecialchars(trim($_GET["name"]) , ENT_QUOTES);

            # Respond
            $discount = $Discount->Get($name);

            if (!$discount) {
                $error["error"] = "Kunde inte hitta Rabatt som heter \"$name\"";
            }

            if (count($error) != 0) {
                http_response_code(404);
                $error["status_code"] = 404;
                echo json_encode($error);
            } else {
                http_response_code(200);
                echo json_encode($discount);
            }
        } else {
            http_response_code(404);
        }
    }
?>
