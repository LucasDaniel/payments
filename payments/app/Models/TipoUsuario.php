<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    public function __construct($tipo)
    {
        $this->tipo = $tipo;
    }

    protected $table = 'tipo_usuarios';

    protected $fillable = [
        'tipo'
    ];

}
