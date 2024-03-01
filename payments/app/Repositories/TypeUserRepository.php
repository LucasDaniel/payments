<?php

namespace App\Repositories;

use App\Models\TypeUser;

class TypeUserRepository extends BaseRepository
{

    /**
     * Begin the model
     */
    public function __construct() {
        $this->model = new TypeUser();
    }

    /**
     * Get the type user by string type
     * @param string
     * @return int
     */
    public function getIdTypeUser(string $type): int {
        return $this->model::where('type','LIKE',$type)
                ->get()->first()->id;
    }
    
}