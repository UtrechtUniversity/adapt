<?php
namespace App\Forms;

use App\Forms\Fields\TextElement;
use App\Forms\Fields\KeywordsElement;

class Form
{
    public $name;
    
    public $description;
    
    protected $fields = [];
    
    
    public function __construct($name, $description, $fields) {
        $this->name = $name;
        
        $this->description = $description;
        
        foreach ($fields as $field) {
            $this->addField($field);
        }
    }
    
    public function addField($fieldConfiguration) {
        switch ($fieldConfiguration['type']) {
            case "text":
                $this->fields[] = new TextElement($fieldConfiguration);
                break;
                
            case "keywords":
                $this->fields[] = new KeywordsElement($fieldConfiguration);
                break;
        }
    }
    
    public function getFields() {
        return $this->fields;
    }
}

