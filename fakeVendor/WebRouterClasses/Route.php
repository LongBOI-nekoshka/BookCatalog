<?php

namespace WebRouterClasses;


class Route
{
    private array $handlers;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';


    public function get(string $url, $handlers) : void
    {
        $this->addHandlers(self::METHOD_GET,$url,$handlers);
    }

    public function post(string $url, $handlers) : void
    {
        $this->addHandlers(self::METHOD_POST,$url,$handlers);
    }

    private function addHandlers(string $method, string $url, $handlers)
    {
        $this->handlers[$method.$url] = [
            'url' => $url,
            'method' => $method,
            'function' => $handlers
        ];
    }

    public function run() {
        $requestUri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $callback = null;

        foreach($this->handlers as $handlers) {
            if(strpos($requestUri,'FreelanceExam/resources/public/')) {
                $replace = str_replace('FreelanceExam/resources/public/','',$requestUri);
                if($replace == $handlers['url'] && $requestMethod == $handlers['method']) {
                    $callback = $handlers['function'];
                }
            }else {
                if($handlers['url'] == $requestUri && $requestMethod == $handlers['method']) {
                    $callback = $handlers['function'];
                }
            }
        }
        
        if(!$callback) {
            header("HTTP/1.0 404 Not Found");
            return;
        }

        call_user_func_array($callback,[
            array_merge($_GET,$_POST)
        ]);
    }
}