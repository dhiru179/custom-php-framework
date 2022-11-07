<?php

namespace app\core\html;
use app\core\html\Field;

class  Form
{
    public static function begin(string $action, string $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }
    public static function end()
    {
        return '</form>';
    }

    public function field($errors,$label,$type,$attributes,$placeholder)
    {
        return new Field($errors,$label,$type,$attributes,$placeholder);
    }
}
