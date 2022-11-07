<?php

namespace app\core;
class Router
{

   protected array $routes = [];
   public  $request;

   function __construct($request)
   {
      $this->request = $request;
   }


   public function get($path, $callback)
   {

      $this->routes['get'][$path] = $callback;
   }
   public function post($path, $callback)
   {

      $this->routes['post'][$path] = $callback;
   }

   public function resolve()
   {
      $method = $this->request->method();
      $path =  $this->request->getPath();
      // if $callback has this method and path then return $callback otherwise false
      $callback = $this->routes[$method][$path] ?? false;

      if ($callback === false) {
         Application::$app->response->setStatusCode(404);
         return "This url Not Found";
      }

      if (is_string($callback)) {
         return $this->renderView($callback, $param = []);
      }
      
      if (is_array($callback)) {
       
         Application::$app->controller = new $callback[0];
         $callback[0]  = Application::$app->controller;
        
      }
   // $callback has classname and method as array
      return call_user_func($callback,$this->request);
   }

   function renderView($view, $param)
   {
      $layoutContent =  $this->layoutContent();
      $viewContent = $this->renderOnlyVIew($view, $param);
      return str_replace("{{content}}", $viewContent, $layoutContent);
   }

   protected function layoutContent()
   {
      $layout = Application::$app->controller->layout;
     
         ob_start();
      require_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
      return ob_get_clean();
   }
   protected function renderOnlyVIew($view, $param)
   {
      foreach ($param as $key => $value) {
         $$key = $value;
      }

      ob_start();
      require_once Application::$ROOT_DIR . "/views/$view.php";
      return ob_get_clean();
   }
}
