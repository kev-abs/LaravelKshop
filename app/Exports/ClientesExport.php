<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientesExport implements FromCollection
{
    public function collection()
    {
        return DB::table('cliente')
            ->select(
                'Nombre',
                'Correo',
                'Telefono',
                'Documento',
                'Estado'
            )
            ->get();
    }
}
