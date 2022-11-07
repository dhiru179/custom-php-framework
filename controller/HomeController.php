<?php
namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class HomeController extends Controller{
    function home()
    {
        $a = [
            "name"=>"Dhiraj",
            "ip"=>'12.2030.2',
            "data"=>"",
            "error"=>"",
        ];
        return $this->render('contact',$a);
    }
    function submitData(Request $request)
    {
     
        $v= $request->isPost();
        $data = [
            'data'=>$request->getBody(),
            'error'=>$this->validation($request->getBody()),
        ];
        if($request->isPost())
        {
            return $this->render('contact',$data);
        }

    }
    function validation($data)
    {
        $error = [];
        foreach($data as $key=>$value)
        {
            if(empty($value))
            {
                $error[$key] = 'This '.$key.' field is required';
            }
        }
        return $error;
    }
}
