<?php

namespace App\Models\producto;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto'; 
    protected $primaryKey = 'ID_Producto';

    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Descripcion',
        'Precio',
        'Stock',
        'ID_Proveedor',
        'Imagen',
        'Estado'
    ];
}
