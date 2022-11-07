<?php
namespace app\core;

abstract class Modal
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    

    public function loadData($data)
    {
        foreach($data as $key=>$value)
        {
            // if(property_exists($this,$key))
            // {
                $this->{$key}=$value;
            // }
        }
        
    }
    // abstract public function rules(): array;

    public array $errors = [];
    public function validate(array $requestData,array $array)
    {
        $this->loadData($requestData);
        foreach($array as $attributes=>$rules)
        {
            $value = $this->{$attributes};
            foreach($rules as $rule)
            {
                $ruleName = $rule;
                if(!is_string($ruleName))
                {
                    $ruleName = $rule[0];
                }
                if($ruleName === self::RULE_REQUIRED && !$value)
                {
                    $this->addError($attributes,self::RULE_REQUIRED);
                }
                if($ruleName === self::RULE_EMAIL && !filter_var($value,FILTER_VALIDATE_EMAIL))
                {
                    $this->addError($attributes,self::RULE_EMAIL);
                }
                if($ruleName === self::RULE_MIN && strlen($value)>$rule['min'])
                {
                    $this->addError($attributes,self::RULE_MIN,$rule);
                }
                if($ruleName === self::RULE_MAX && strlen($value)<$rule['max'])
                {
                    $this->addError($attributes,self::RULE_MAX,$rule);
                }
                if($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']})
                {
                    $this->addError($attributes,self::RULE_MATCH,$rule);
                }
            }
        }

        return empty($this->errors);
    }

    public function addError(string $attributes,string $rule,$param=[])
    {
        $message = $this->errorMessage()[$rule] ?? '';
        foreach($param as $key=>$value)
        {
            $message = str_replace("{{$key}}",$value,$message);
        }
        $this->errors[$attributes][] = $message;
    }
    public function errorMessage()
    {
       return [
        self:: RULE_REQUIRED => 'This field is required',
        self:: RULE_EMAIL => 'This field must be valid email address',
        self:: RULE_MIN => 'The length of filed must be {min}',
        self:: RULE_MAX => 'The length of filed must be {max}',
        self:: RULE_MATCH => 'The field must be same {match}',
       ]; 
    }

    public function hasError($attributes)
    {
        // return $this->errors[$attributes]?true:false;
        return $this->errors[$attributes]??false;
    }

    public function getFirstError($attributes)
    {
        return $this->errors[$attributes][0]??false;
    }
}
