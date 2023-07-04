<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KeywordExport implements FromCollection, WithHeadings
{
    protected $keywords;
    
    public function __construct($keywords)
    {
        $this->keywords = $keywords;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return collect($this->keywords);
    }
    
    public function headings(): array
    {
        return [
            'label',
            'uri',
            'vocab-uri'
        ];
    }
}
