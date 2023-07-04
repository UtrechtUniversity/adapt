<?php
namespace App\Forms;

use Illuminate\Support\Facades\Validator;

class FormBuilder
{
    
    public static function createForm(array $configuration) {
        //validate configuration
        $rules = [
            'name' => 'required',
            'description' => '',
            'fields' => '',
            'fields.*.name' => 'distinct'
        ];
        
        $validator = Validator::make($configuration, $rules);
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            dd($errors->first());
        } else {
            
            return new Form($configuration['name'], $configuration['description'], $configuration['fields']);
        }
        
        
        return new Form($configuration['name'], $configuration['description'], $configuration['fields']);       
    }
}

