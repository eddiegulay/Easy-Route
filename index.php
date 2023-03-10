<?php
    require_once 'Router.php';

    $router = new Router();

    // Define routes for API endpoints
    $router->addRoute('GET', '/api/users/(\d+)', function () use ($router) {
        $params = $router->extractParams('/api/users/(\d+)', $_SERVER['REQUEST_URI']);
        $userId = $params[0];
        // Handle GET request for user with ID $userId
        // ...
        echo $userId;
    });

    $router->addRoute('POST', '/api/users', function () use ($router) {
        // Handle POST request to create a new user
        // ...
    });

    // Handle static file requests
    $router->addRoute('GET', '/static/(.*)', function () use ($router) {
        $filename = $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'];
        if (file_exists($filename)) {
            header('Content-Type: ' . mime_content_type($filename));
            readfile($filename);
        } else {
            // handle 404 error
            http_response_code(404);
            echo "404 Not Found";
        }
    });

    $router->addRoute('GET', '/test', function() {
        include 'test_page.php';
    });

    // Dispatch the request to the appropriate handler
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

?>