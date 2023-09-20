<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends EloquentCrudRepository implements ModelRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}
