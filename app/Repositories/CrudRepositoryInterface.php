<?php
// app/Repositories/CrudRepositoryInterface.php

namespace App\Repositories;

interface CrudRepositoryInterface
{
    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function getById($id);

    public function getAll();
}
