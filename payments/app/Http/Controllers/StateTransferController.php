<?php

namespace App\Http\Controllers;

use App\Models\StateTransfer;
use App\Repositories\StateTransferRepository;
use Illuminate\Http\Request;

class StateTransferController extends Controller
{
    
    public function __construct() {
        $this->model = new StateTransfer();
        $this->repository = new StateTransferRepository();
    }

}
