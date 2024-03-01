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

    /**
     * Controller variables
     */
    protected $return;
    protected $model;
    protected $repository;

    /**
     * Function to throw a new exception
     * @param array
     * @return void
     */
    protected function exception(array $e): void {
        throw new Exception($e['msg'],$e['code']);
    }

    /**
     * List all datas of repositrory
     */
    public function list() {
        return $this->repository->all();
    }

    /**
     * Get the data of repository by id
     * @param int
     */
    public function show(int $id) {
        return $this->repository->find($id);
    }
}
