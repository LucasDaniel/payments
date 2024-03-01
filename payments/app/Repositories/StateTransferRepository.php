<?php

namespace App\Repositories;

use App\Models\StateTransfer;
use Illuminate\Database\Eloquent\Model;

class StateTransferRepository extends BaseRepository
{

    /**
     * Begin the model
     */
    public function __construct() {
        $this->model = new StateTransfer();
    }

    /**
     * Get id by state transfer
     * @param string
     * @return int
     */
    public function getIdStateTransfer(string $state): int {
        return $this->model::where('state','LIKE',$state)
                ->get()->first()->id;
    }
    
}