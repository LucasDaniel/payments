<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
        $this->model = new User();
        $this->repository = new UserRepository();
    }
}
