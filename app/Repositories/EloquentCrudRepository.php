<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class EloquentCrudRepository implements CrudRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return false;
        }
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->model->find($id);
        if (!$record) {
            return false;
        }
        $record->delete();
        return true;
    }
}
