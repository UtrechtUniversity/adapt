<?php
namespace App\Forms\Fields;

abstract class BaseElement
{
    public $name;
    
    public $label;
    
    protected $template;
    
    protected $rules = [];
    
    protected function __construct($fieldConfiguration) {
        $this->name = $fieldConfiguration['name'];
        $this->label = $fieldConfiguration['label'];
        $this->rules = $fieldConfiguration['rules'];
    }
    
    public function getTemplate() {
        return $this->template;
    }
}

