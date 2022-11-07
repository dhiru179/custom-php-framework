<?php
namespace app\core;

class Application
{
    public $router;
    public $request;
    public Response $response;
    public static $ROOT_DIR;
    public static Application $app;
    // public Controller $controller;
    public function __construct($root_dir,$configEnv)
    {
        self::$ROOT_DIR  = $root_dir;
        self::$app = $this;
        $this->request = new Request();
        $this->response  = new Response();
        $this->router = new Router($this->request);
        $this->db = new Database($configEnv);
    }

    // public function getController(): \app\core\Controller
    // {
    //     return $this->controller;
    // }
    // public function setController(Controller $controller)
    // {
    //      $this->controller = $controller;
    // }

    public function run()
    {
        echo $this->router->resolve();
        die();
    }

  
}
