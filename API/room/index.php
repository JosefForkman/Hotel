<?php
    header("Content-Type: application/json");
    require('function.php');

    # Router
    match(true){
        # method ?QueryParams
        method("get") && isset($_GET["id"]) => get(),
        method("get")  => getAll(),
        method("post") &&
            isset(
                $_FILES["img"],
                $_POST['alt'],
                $_POST['name'],
                $_POST['description'],
                $_POST['price'])
            => add(),

        default => notFound()
    };

    # helper function to router
    function notFound () {
        http_response_code(400);
        echo json_encode(["message" => "We don`t supeort the request", "help" => "Perhaps you missing a Query Prams"]);
    }

    function method (string $method): bool {
        return $_SERVER['REQUEST_METHOD'] === strtoupper($method);
    }
?>

