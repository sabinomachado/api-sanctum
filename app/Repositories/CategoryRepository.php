<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends EloquentCrudRepository implements ModelRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

}
