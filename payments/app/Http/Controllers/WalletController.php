<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Repositories\WalletRepository;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Constructor, set model and repository
     */    
    public function __construct() {
        $this->model = new Wallet();
        $this->repository = new WalletRepository();
    }
}
