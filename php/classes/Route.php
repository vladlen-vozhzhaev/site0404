<?php
    class Route{
        static function get($uri, $viewPath){
            $path = $_SERVER['REQUEST_URI']; //  /login
            $method = $_SERVER['REQUEST_METHOD']; // Получаем метод запроса GET или POST
            $pathArr = explode("/", $path); // ['' ,'login']
            $content = "404 страница не найдена";
            if("/".$pathArr[1] == $uri and $method == "GET"){
                if(gettype($viewPath) == "object"){
                    exit($viewPath());
                }elseif (gettype($viewPath) == "string"){
                    $content = file_get_contents($viewPath);
                    require_once('template.php');
                }
            }
        }
        static function post($uri, $callback){
            $path = $_SERVER['REQUEST_URI']; //  /login
            $method = $_SERVER['REQUEST_METHOD']; // Получаем метод запроса GET или POST
            $pathArr = explode("/", $path); // ['' ,'login']
            if("/".$pathArr[1] == $uri and $method == "POST"){
                exit($callback());
            }
        }
    }