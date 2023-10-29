<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return  Category::with('parentCategory')
            ->whereNotNull('parent_category')
            ->get();
    }
}
