<?php
namespace app\modal;

use app\core\Modal;

class RegisterModal extends Modal{
    // public string $name = "";
    // public string $email="";
    // public string $password="";
    // public string $cnfPassword="";


    public function register(){
        echo "create register modal";
    }

    // public function rules(): array
    // {
    //     return [
    //         // 'name'=>[self::RULE_REQUIRED],
    //         // 'email'=>[self::RULE_REQUIRED],
    //         // 'email'=>[self::RULE_REQUIRED,self::RULE_EMAIL],
    //         // 'password'=>[self::RULE_REQUIRED,[self::RULE_MIN,'min'=>8],[self::RULE_MAX,'max'=>24]],
    //         // 'cnfPassword'=>[self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']],
    //     ];

    // }
}
?>