<?php
namespace app\core;
use app\core\Application;

class Controller{

    public string $layout = 'main';
    function setLayout($layout)
    {
        $this->layout = $layout;
    }
    function render(string $page,$param=[])
    {
        return Application::$app->router->renderView($page,$param);
    }
}

?>