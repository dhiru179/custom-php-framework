<?php

namespace app\controller;

use app\core\Controller;
use app\core\Request;
use app\modal\RegisterModal;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }
    public function register(Request $request)
    {
        $registerModal = new RegisterModal();

        $getData = $request->getBody();

        if ($request->isGet()) {
            // return print_r($request->isGet());

        }
        if ($request->isPost()) {
            $validateFiled = [
                'name' => $getData['name'],
                'email' => $getData['email'],
                'password' => $getData['password'],
                'cnfPassword' => $getData['cnfPassword']

            ];


            $isValidation = $registerModal->validate($validateFiled, [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', ['max', 'max' => 8]],
                'cnfPassword' => ['required', ['match', 'match' => 'password']]
            ]);
            if ($isValidation) {
                return "success";
            }
            
            $this->setLayout('auth');
            return $this->render('register', ['errors' => $registerModal]);
        }


        $this->setLayout('auth');
        return $this->render('register', ['errors' => $registerModal]);
    }
}
