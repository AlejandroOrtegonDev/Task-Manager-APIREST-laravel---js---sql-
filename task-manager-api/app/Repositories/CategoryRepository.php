<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all categories ordered by name
     */
    public function allOrderedByName()
    {
        return $this->model->orderBy('name')->get();
    }

    /**
     * Get categories by search term
     */
    public function searchByName($term)
    {
        return $this->model->where('name', 'like', "%{$term}%")->get();
    }
}
