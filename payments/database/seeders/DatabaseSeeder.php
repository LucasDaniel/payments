<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\StateTransfer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TypeUsersSeed::class,
            UserSeed::class,
            WalletsSeed::class,
            StateTransferSeed::class,
        ]);
    }
}
