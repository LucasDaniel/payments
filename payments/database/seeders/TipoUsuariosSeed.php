<?php

namespace Database\Seeders;

use App\Models\TipoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoUsuariosSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tu = new TipoUsuario("Comum");
        $tu->save();

        $tu = new TipoUsuario("Logista");
        $tu->save();
    }
}
