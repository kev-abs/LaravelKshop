<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmpleadosExport implements FromCollection
{
    public function collection()
    {
        return DB::table('empleado')
            ->select(
                'Nombre',
                'Correo',
                'Cargo',
                'Telefono',
                'Estado'
            )
            ->get();
    }
}