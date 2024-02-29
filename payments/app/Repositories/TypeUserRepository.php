<?php

namespace App\Repositories;

use App\Models\TypeUser;
use Ramsey\Uuid\Uuid;

class TypeUserRepository
{
    public static function getIdTypeUser($type): int {
        return TypeUser::where('type','LIKE',$type)
                ->get()->first()->id;
    }
    
}