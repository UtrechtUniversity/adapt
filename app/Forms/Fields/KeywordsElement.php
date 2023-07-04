<?php
namespace App\Forms\Fields;

class KeywordsElement extends BaseElement
{    
    public $vocabularyLocation;
    
    public function __construct($fieldConfiguration) {
        parent::__construct($fieldConfiguration);
        $this->template = 'forms.fields.keywords';
        $this->vocabularyLocation = $fieldConfiguration['vocabularyLocation'];
    }
}

