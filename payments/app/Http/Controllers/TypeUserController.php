<?php

namespace App\Http\Controllers;

use App\Models\TypeUser;
use App\Repositories\TypeUserRepository;
use Illuminate\Http\Request;

class TypeUserController extends Controller
{
    public function __construct() {
        $this->model = new TypeUser();
        $this->repository = new TypeUserRepository();
    }
}
