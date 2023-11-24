<?php

namespace TesteAux\Testphp\Router;

use Exception;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = [
            "GET" => [],
            "POST" => [],
            "PUT" => [],
            "DELETE" => []
        ];
    }

    public function addRoute(string $method, array $route)
    {
        $this->validMethod($method);
        $this->routes[$method][$route["uri"]] = $route["handler"] ;
    }

    public function run()
    {
        $method = $_SERVER["REQUEST_METHOD"];
        $uri = $_GET["url"];


        try {
            $uri = explode('/', $uri);
            $methodUsed =$this->routes[$method];

            if (count($uri) > 2){
                $route = $uri[1]."/".$uri[2];
                $routeFound = $methodUsed[$route];
                call_user_func($routeFound, $uri[3]);
                return;
            }
            $routeFound = $methodUsed[$uri[1]];
            call_user_func($routeFound);

       } catch (Exception $error) {
            echo json_encode(["error" => $error->getMessage()]);
        }
    }

    private function validMethod(string $method)
    {
        if ($method != "GET" && $method != "POST" && $method != "PUT" && $method != "DELETE") {
            throw new Exception("Method Not Allowed");
        }
    }
}
