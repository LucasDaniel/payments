<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c = new Wallet();
        $c->id_user = 1;
        $c->value = 1000;
        $c->save();

        $c = new Wallet();
        $c->id_user = 2;
        $c->value = 1000;
        $c->save();

        $c = new Wallet();
        $c->id_user = 3;
        $c->value = 1000;
        $c->save();

        $c = new Wallet();
        $c->id_user = 4;
        $c->value = 1000;
        $c->save();
    }
}
