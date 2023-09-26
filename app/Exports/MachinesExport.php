<?php

namespace App\Exports;

use App\Models\Using;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class MachinesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        // $data = DB::table('usings')
        //     ->orderBy('id')->get();
        // return $data;
        return Using::all();
       
    }
}
