<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository extends EloquentCrudRepository implements ModelRepository
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

}
