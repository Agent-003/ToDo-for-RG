<?php

namespace App;

use App\Controllers\AbstractController;
use App\Loader\DatabaseLoader;
use App\Loader\ConfigLoader;

class Application
{
    /** @var array */
    private $config;

    /** @var array */
    private $configPath;

    /** @var string */
    private $templatesDir;

    /** @var object PDO */
    private $pdo;

    public function __construct(array $paths)
    {
        $this->configPath = $paths['config'];
        $this->templatesDir = $paths['templates'];
        $this->routesDir = $paths['routes'];

        $this->boot();
    }

    /**
     * Запуск приложения
     */
    public function run()
    {
        $urlParse = parse_url($_SERVER['REQUEST_URI']);

        /* $path = ltrim($urlParse['path'], "/todo/");
        $path = str_replace("/todo/", "", $urlParse['path']);*/

        $path = ltrim($urlParse['path'], '/');
        /**-------------------------------------*/

        list($controller, $action) = explode('/', $path);

        $controller = (!empty($controller)) ? $controller : 'index';
        $action = (!empty($action)) ? $action : 'index';

        $classController = 'App\\Controllers\\' . ucfirst($controller) . 'Controller';

        $classFile = lcfirst(str_replace('\\', '/', $classController));

        if (file_exists($classFile . ".php")) {

            if (class_exists($classController)) {

                /** @var AbstractController $controllerObject */
                $controllerObject = new $classController($this->pdo);
                if (method_exists($controllerObject, $action)) {

                    $controllerObject->setTemplateDir($this->templatesDir);

                    return $controllerObject->$action();
                }
            }
        } else {
            //header("Location: http://" . $_SERVER['HTTP_HOST'] . "/todo/index");
            //return false;
        }
        return false;
    }

    /**
     * Загрузка приложения
     */
    private function boot()
    {
        try {
            $config = new ConfigLoader();
            $this->config = $config($this->configPath);

            $pdo = new DatabaseLoader();
            $this->pdo = $pdo($this->config['database']);

        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}