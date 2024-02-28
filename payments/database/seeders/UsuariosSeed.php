<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $u = new Usuario(1,'Lucas Daniel Beltrame','34567898765','lucas@email.com','a');
        $u->save();

        $u = new Usuario(1,'Lima Rodrigues','98765423456','lima@email.com','b');
        $u->save();

        $u = new Usuario(2,'Padaria','45678987654','padaria@email.com','c');
        $u->save();

        $u = new Usuario(2,'Farmacia','56789876543','farmacia@email.com','d');
        $u->save();
    }
}
