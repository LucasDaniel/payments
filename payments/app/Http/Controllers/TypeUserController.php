<?php

namespace App\Http\Controllers;

use App\Models\TypeUser;
use App\Repositories\TypeUserRepository;
use Illuminate\Http\Request;

class TypeUserController extends Controller
{
    /**
     * Constructor, set model and repository
     */    
    public function __construct() {
        $this->model = new TypeUser();
        $this->repository = new TypeUserRepository();
    }
}
