<?php

namespace App\Repositories;

use App\Models\StateTransfer;

class StateTransferRepository
{
    public static function getIdStateTransfer($state): int {
        return StateTransfer::where('state','LIKE',$state)
                ->get()->first()->id;
    }
    
}