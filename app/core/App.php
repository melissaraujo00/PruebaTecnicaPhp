<?php
class App
{
    protected $controller = 'Cliente';  
    protected $method = 'index';         
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (isset($url[0]) && file_exists(APP_ROOT . '/Controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once APP_ROOT . '/Controllers/' . $this->controller . 'Controller.php';

        $controllerClass = $this->controller . 'Controller';
        $this->controller = new $controllerClass();

        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }


        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = strtok($requestUri, '?');
        $basePath = parse_url(APP_URL, PHP_URL_PATH);
        if ($basePath && $basePath !== '/') {
            $requestUri = substr($requestUri, strlen($basePath));
        }
        $requestUri = trim($requestUri, '/');
        return !empty($requestUri) ? explode('/', $requestUri) : [];
    }
}