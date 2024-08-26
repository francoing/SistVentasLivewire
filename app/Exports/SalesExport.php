<?php

namespace App\Exports;


use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class SalesExport implements FromCollection
{
    public function collection()
    {
        return Sale::all();
    }
}
