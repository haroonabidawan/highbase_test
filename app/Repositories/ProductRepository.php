<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    /**
     * Constructor
     *
     * @pram Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
