<?php
/**
 * 闭包使用的例子 （js类似）
 */
class App
{
    protected $routes = array();
    protected $responseStatus = '200 OK';
    protected $responseContentType = 'text/html';
    protected $responseBody = 'Hello world';

    public function addRoute($routePath, $routeCallback)
    {
        $this->routes[$routePath] = $routeCallback->bindTo($this, __CLASS__);
    }

    public function dispatch($currentPath)
    {
        if (array_key_exists($currentPath, $this->routes)) {
            $callback = $this->routes[$currentPath];
            // if ($callback instanceof Closure) {
            //     echo "closure", PHP_EOL;
            // }
            $callback();
        }

        header('HTTP/1.1' . $this->responseStatus);
        header('Content-type: ' . $this->responseContentType);
        header('Content-length: ' . strlen($this->responseBody));

        echo $this->responseBody;
    }
}

$app = new App();
$app->addRoute('/users/josh', function () {
    $this->responseContentType = 'application/json;charset=utf8';
    $this->responseBody = '{"name": "Josh"}';
});

$app->dispatch('/users/josh');