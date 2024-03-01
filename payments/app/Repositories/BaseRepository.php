<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function all(): Collection {
        return $this->model::all();
    }

    public function find(int $id): Model|null {
        return $this->model::find($id);
    }
}