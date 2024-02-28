<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Usuario extends Model
{
    use HasFactory;

    public function __construct($id_tipo,$nome_completo,$cpf,$email,$senha)
    {
        $this->id_tipo = $id_tipo;
        $this->nome_completo = $nome_completo;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->senha = Hash::make($senha);
    }

    protected $table = 'usuarios';

    protected $fillable = [
        'id_tipo',
        'nome_completo',
        'cpf',
        'email',
        'senha',
    ];

}
