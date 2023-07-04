<?php
namespace App\Forms\Fields;

class TextElement extends BaseElement
{
    public $description = "";
    
    public function __construct($fieldConfiguration) {
        parent::__construct($fieldConfiguration);
        $this->template = 'forms.fields.text';
        $this->description = $fieldConfiguration['description'];
    }
}

