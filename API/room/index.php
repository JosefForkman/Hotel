<?php
    header("Content-Type: application/json");
    require('function.php');
    // $path = strtolower(str_replace("/API/room", '', parse_url($_SERVER['REQUEST_URI'])['path']));
    // echo $path;

    # Router
    match(true){
        # method ?QueryParams
        url("") && method("get") && isset($_GET["id"]) => get(),
        url("") && method("get")  => getAll(),
        url("/feature") && method("get") && isset($_GET["id"]) => getFeature(),
        url("/feature") && method("get")  => getAllFeatures(),
        url("") && method("post") &&
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
    function url (string $url): bool {
        $path = strtolower(str_replace("/API/room", '', parse_url($_SERVER['REQUEST_URI'])['path']));
        $url = strtolower($url);
        return $path === $url;
    }
?>

