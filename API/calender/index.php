<?php
    header("Content-Type: application/json");
    require('function.php');

    # Router
    match(true){
        # method ?QueryParams
        url("") && method("get") && isset($_GET['id']) => get(),

        url('/book') && method("post") &&
            isset($_GET['id']) &&
            isset($_GET['arrival_date']) &&
            isset($_GET['departure_date'])
        => book(),

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
    function url(string $url): bool {
        $path = strtolower(str_replace("/api/calender", '', parse_url($_SERVER['REQUEST_URI'])['path']));
        $url = strtolower($url);
        return $path === $url;
    }
?>

