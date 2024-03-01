<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    /**
     * Get all datas of model
     * @return Collection
     */
    public function all(): Collection {
        return $this->model::all();
    }

    /**
     * Find the data of id model
     * @return Model
     */
    public function find(int $id): Model|null {
        return $this->model::find($id);
    }
}