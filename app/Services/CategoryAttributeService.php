<?php

namespace App\Services;

use App\Repositories\CategoryAttributeRepository;

class CategoryAttributeService extends BaseService
{
    /**
     * Constructor
     *
     * @pram CategoryAttributeRepository $repository
     */
    public function __construct(CategoryAttributeRepository $repository)
    {
        parent::__construct($repository);
    }
}
