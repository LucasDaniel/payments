<?php

namespace Database\Seeders;

use App\Models\Carteira;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarteirasSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c = new Carteira(1,1000);
        $c->save();

        $c = new Carteira(2,1000);
        $c->save();

        $c = new Carteira(3,0);
        $c->save();

        $c = new Carteira(4,0);
        $c->save();
    }
}
