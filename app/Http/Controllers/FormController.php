<?php
namespace App\Http\Controllers;

use App\Forms\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\KeywordExport;
use Maatwebsite\Excel\Facades\Excel;

class FormController extends Controller
{
    // display linsk to forms
    public function index() 
    {        
        return view('index');
    }
    
    // adapt form
    public function form1() 
    {
        return view('form1');
    }
    
    // samples form
    public function form2() 
    {
        return view('form2');
    }
    
    // keyword selector form
    public function form3() 
    {
        $filePath = 'forms/form3/config.json';
        
        if(Storage::disk()->exists($filePath)) {
            $config = json_decode(Storage::get($filePath), true);
            
            $form = FormBuilder::createForm($config);           
            
            return view('form3', ['form' => $form]);
        } else {
            dd('invalid config location');
        }

        return view('form3');
    }
    
    public function processForm(Request $request) 
    {
        dd($request->all());
    }
    
    public function processKeywordsFormExcel(Request $request) 
    {
        // validate atleast one required???
        //dd($request->input('sampleKeywords'));               
        $export = new KeywordExport($request->input('sampleKeywords'));
        
        return Excel::download($export, 'keywords.xlsx');
        
        dd($request->all());
        
        
    }
}

