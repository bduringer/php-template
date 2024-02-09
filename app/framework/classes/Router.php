<?php

namespace app\framework\classes;
use Exception;
class Router{
    private string $path;
    private string $request;

    private function routeFound($routes){
        if(!isset($routes[$this->request])){
            throw new Exception("Route {$this->path} does not exist");
        }

        if(!isset($routes[$this->request][$this->path])){
            throw new Exception("Route {$this->path} does not exist");
        }
    }
    private function controllerFound(string $controllerNamespace,string $controller,string $method){
        if(!class_exists($controllerNamespace)){
            throw new Exception("Controller {$controllerNamespace} does not exist");
        }
        if(!method_exists($controllerNamespace, $method)){
            throw new Exception("Method {$method} does not exist in class {$controllerNamespace}");
        }
    }

    public function execute($routes)
    {
        $this->path = path();
        $this->request = request();
        $this->routeFound($routes);
        [$controller,$method] = explode('@', $routes[$this->request][$this->path]);
        if(str_contains($method,':')){
            [$method,$auth] = explode(":",$method);
            Auth::check($auth);
        };
        $controllerNamespace = "app\\controllers\\{$controller}";
        $this->controllerFound($controllerNamespace,$controller,$method);
        $controllerInstance = new $controllerNamespace;
        $controllerInstance->$method();
    }

}