<?php

namespace app\core\html;
// use app\core\Modal;

class Field
{
    public $errors;
    public string $attributes;
    public string $type;
    public string $placeholder;
    public string $label;
    public function __construct($errors,$label, $type, $attributes, $placeholder)
    {
        $this->errors = $errors;
        $this->label = $label;
        $this->type = $type;
        $this->attributes = $attributes;
        $this->placeholder = $placeholder;
    }

    public function __toString()
    {
        $field = '<div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">%s</label>
                    <input type="%s" class="form-control %s" name="%s" id="exampleFormControlInput1" placeholder="%s">
                    <span class="text-danger">%s</span>
                  </div>';
        return sprintf(
            $field,
            $this->label,
            $this->type,
            $this->errors->hasError($this->attributes)?'is-invalid':'',
            $this->attributes,
            $this->placeholder,
            $this->errors->getFirstError($this->attributes),
        );
    }
}
