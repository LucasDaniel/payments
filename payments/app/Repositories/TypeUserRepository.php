<?php

namespace App\Repositories;

use App\Models\TypeUser;

class TypeUserRepository extends BaseRepository
{

    public function __construct() {
        $this->model = new TypeUser();
    }

    public function getIdTypeUser(string $type): int {
        return $this->model::where('type','LIKE',$type)
                ->get()->first()->id;
    }
    
}