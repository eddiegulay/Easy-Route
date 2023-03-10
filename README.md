# Easy-Route
PHP URL Routing manager

# Router Class

This is a simple PHP class that can be used to handle URL routing in a web application.

## Usage

To use the `Router` class in your project, follow these steps:

1. Download the `Router.php` file and include it in your project.
2. Create a new instance of the `Router` class.
3. Add routes to the router using the `addRoute()` method.
4. Dispatch incoming requests using the `dispatch()` method.

### Adding Routes

To add a route to the router, use the following syntax:
```php
$router->addRoute($method, $url, $handler);
```
Here, `$method` is the HTTP method for the route (e.g. "GET", "POST", "PUT", etc.), `$url` is the URL pattern for the route (e.g. "/users/{id}"), and `$handler` is a callback function that will be executed when the route is matched.

### Handling Requests

To handle incoming requests, use the `dispatch()` method:
```php
$router->dispatch($method, $url);
```

Here, `$method` is the HTTP method of the incoming request, and `$url` is the URL of the incoming request.

### Handling Parameters

You can use parameterized URL patterns to extract parameters from the incoming URL. For example:
```php
$router->addRoute("GET", "/users/{id}", function($id) {
// Look up user with the given ID and display their profile
});
```

Here, the `$id` parameter will be passed to the callback function.

## Examples

Here are some example routes that could be added using the `Router` class:

```php
$router->addRoute("GET", "/", function() {
echo "Hello, world!";
});

$router->addRoute("POST", "/submit", function() {
// Handle the form submission
});

$router->addRoute("GET", "/users/{id}", function($id) {
// Look up user with the given ID and display their profile
});

$router->addRoute("PUT", "/users/{id}/update/{field}", function($id, $field) {
// Update the specified field for the user with the given ID
});

$router->addRoute("GET", "/public/styles.css", function() {
$filename = $_SERVER['DOCUMENT_ROOT'] . "/public/styles.css";
header('Content-Type: ' . mime_content_type($filename));
readfile($filename);
});
```



# Sample Usage of PHP Router

## Introduction

This code demonstrates how to use a PHP Router to define API endpoints and handle static file requests.

## Usage

To use this code, follow these steps:

1. Include the `Router.php` file in your PHP script.
2. Create a new `Router` object.
3. Define your routes using the `addRoute` method, specifying the HTTP method, URL pattern, and handler function.
4. Handle static file requests by defining a route with a URL pattern that matches the file path.
5. Dispatch the request to the appropriate handler using the `dispatch` method.

Example usage:

```php
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

```

## Contributors
* Edgar Gulay [https://github.com/eddygulled]
