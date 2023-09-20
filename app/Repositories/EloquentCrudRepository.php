<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class EloquentCrudRepository implements CrudRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->getById($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        $record = $this->getById($id);
        return $record->delete();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }
    public function getAll()
    {
        return $this->model->all();
    }

    // Implemente as operações CRUD aqui usando o Eloquent.
}
