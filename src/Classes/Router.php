<?php

namespace Project\Classes;

class Router
{
    private array $callbacks;
    private $notFoundHandler;
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';

    public function get(string $path, $callback): void
    {
        $this->addCallback(self::METHOD_GET, $path, $callback);
    }

    public function post(string $path, $callback): void
    {
        $this->addCallback(self::METHOD_POST, $path, $callback);
    }
    public function addNotFoundHandler($callback): void
    {
        $this->notFoundHandler = $callback;
    }

    private function addCallback(string $method, string $path, $callback): void
    {
        $this->callbacks[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'callback' => $callback
        ];
    }

    public function run()
    {

        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        $callfunc = null;
        foreach ($this->callbacks as $callback) {
            if ($callback['path'] == $requestPath && $callback['method'] == $method) {
                $callfunc = $callback['callback'];
            }
        }

        if (is_string($callfunc)) {
            $parts = explode('::', $callfunc);
            if (is_array($parts)) {
                $className = array_shift($parts);

                $handler = new $className();
                $method = array_shift($parts);

                $callfunc = [$handler, $method];
            }
        }

        if (!$callfunc) {
            header("HTTP/1.0 404 Not Found");
            if (!empty($this->notFoundHandler)) {
                $callfunc = $this->notFoundHandler;
            }
        }

        call_user_func_array($callfunc, [
            array_merge($_GET, $_POST)
        ]);
    } // end of run

}