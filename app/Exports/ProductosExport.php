<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductosExport implements FromCollection
{
    public function collection()
    {
        return DB::table('producto')
            ->select(
                'Nombre',
                'Precio',
                'Stock',
                'Estado',
                'Genero'
            )
            ->get();
    }
}