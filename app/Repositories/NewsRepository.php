<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository extends EloquentCrudRepository implements ModelRepositoryInterface
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }


}
