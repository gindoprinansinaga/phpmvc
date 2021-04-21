<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();
        // echo '<pre>';
        // var_dump($url);
        // echo '</pre>';

        // 1. controller
        // mengecek apakah ada file $controllernya->home di app controllernya
        if ($url == NULL) {
            $url = [$this->controller];
        }
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller .   '.php';
        $this->controller = new $this->controller;

        // 2. method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. params
        if (!empty($url)) {
            if (!isset($url[0])) {
                $this->params = array_values($url);
            }
        }

        // jalankan controller & method, serta kirmkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
