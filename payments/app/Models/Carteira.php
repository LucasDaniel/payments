<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carteira extends Model
{
    use HasFactory;

    public function __construct($id_usuario,$valor)
    {
        $this->id_usuario = $id_usuario;
        $this->valor = $valor;
    }

    protected $table = 'carteiras';

    protected $fillable = [
        'id_usuario',
        'valor'
    ];
}
