<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends EloquentCrudRepository implements ModelRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}
