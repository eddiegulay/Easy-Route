<?php

    class Router {
        
        private $routes = array();
        
        public function addRoute($method, $url, $handler) {
            $this->routes[$method][$url] = $handler;
        }
        
        public function dispatch($method, $url) {
            if (array_key_exists($method, $this->routes) && array_key_exists($url, $this->routes[$method])) {
                $handler = $this->routes[$method][$url];
                $handler();
            } else {
                $filename = $_SERVER['DOCUMENT_ROOT'] . $url;
                if (file_exists($filename)) {
                    header('Content-Type: ' . mime_content_type($filename));
                    readfile($filename);
                } else {
                    // handle 404 error
                    http_response_code(404);
                    echo "404 Not Found";
                }
            }
        }
        
        public function extractParams($pattern, $url) {
            $params = array();
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = '/^' . $pattern . '$/';
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                $params = $matches;
            }
            return $params;
        }
        
    }

?>