<?php

namespace Database\Seeders;

use App\Enums\EnumTypeUser;
use App\Models\TypeUser;
use App\Utils\Constants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeUsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tu = new TypeUser();
        $tu->type = EnumTypeUser::COMUM->value;
        $tu->save();

        $tu = new TypeUser();
        $tu->type = EnumTypeUser::STORE->value;
        $tu->save();
    }
}
