<?php

namespace Database\Seeders;

use App\Enums\EnumTypeUser;
use App\Models\User;
use App\Repositories\TypeUserRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $u = new User();
        $u->id_type = TypeUserRepository::getIdTypeUser(EnumTypeUser::COMUM->value);
        $u->name = 'Lucas Daniel Beltrame';
        $u->cpf = '34567898765';
        $u->email = 'lucas@email.com';
        $u->password = Hash::make('a');
        $u->save();

        $u = new User();
        $u->id_type = TypeUserRepository::getIdTypeUser(EnumTypeUser::COMUM->value);
        $u->name = 'Lima Rodrigues';
        $u->cpf = '98765423456';
        $u->email = 'lima@email.com';
        $u->password = Hash::make('b');
        $u->save();

        $u = new User();
        $u->id_type = TypeUserRepository::getIdTypeUser(EnumTypeUser::STORE->value);
        $u->name = 'Padaria';
        $u->cpf = '45678987654';
        $u->email = 'padaria@email.com';
        $u->password = Hash::make('c');
        $u->save();

        $u = new User();
        $u->id_type = TypeUserRepository::getIdTypeUser(EnumTypeUser::STORE->value);
        $u->name = 'Farmacia';
        $u->cpf = '56789876543';
        $u->email = 'farmacia@email.com';
        $u->password = Hash::make('d');
        $u->save();
    }
}
