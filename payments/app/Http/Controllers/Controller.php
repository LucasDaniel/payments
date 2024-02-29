<?php

namespace App\Http\Controllers;

use App\Dictionary\Dictionary;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, Dictionary;

    protected $return;

    protected function exception($e) {
        throw new Exception($e['msg'],$e['code']);
    }
}
