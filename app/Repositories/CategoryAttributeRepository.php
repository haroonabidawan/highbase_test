<?php

namespace App\Repositories;

use App\Models\CategoryAttribute;

class CategoryAttributeRepository extends BaseRepository
{
    /**
     * Constructor
     *
     * @pram CategoryAttribute $model
     */
    public function __construct(CategoryAttribute $model)
    {
        parent::__construct($model);
    }
}
