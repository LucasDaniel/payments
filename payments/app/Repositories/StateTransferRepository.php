<?php

namespace App\Repositories;

use App\Models\StateTransfer;
use Illuminate\Database\Eloquent\Model;

class StateTransferRepository extends BaseRepository
{

    public function __construct() {
        $this->model = new StateTransfer();
    }

    public function getIdStateTransfer(string $state): int {
        return $this->model::where('state','LIKE',$state)
                ->get()->first()->id;
    }
    
}