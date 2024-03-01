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
    protected $model;
    protected $repository;

    protected function exception(array $e): void {
        throw new Exception($e['msg'],$e['code']);
    }

    public function list() {
        return $this->repository->all();
    }

    public function show(int $id) {
        return $this->repository->find($id);
    }
}
