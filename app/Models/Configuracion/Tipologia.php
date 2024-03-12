<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipologia extends Model
{
    use HasFactory;

    protected $table = 'tipologia';
    protected $fillable=[
        'nombre',
        'descripcion',
    ];

}
