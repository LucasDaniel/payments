<?php

namespace Database\Seeders;

use App\Models\Transfer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransferSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $t = new Transfer();
        $t->id_state = 4;
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();

        $t = new Transfer();
        $t->id_state = 1;
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();

        $t = new Transfer();
        $t->id_state = 3;
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();

        $t = new Transfer();
        $t->id_state = 2;
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();

        $t = new Transfer();
        $t->id_state = 2;
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();

        $t = new Transfer();
        $t->id_state = 2;
        $t->payer = 2;
        $t->payee = 3;
        $t->value = 100;
        $t->save();
    }
}
