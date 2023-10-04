<?php

namespace App\Repositories;

use App\Models\Product;

class ProductsRepository
{
    public function create($data)
    {
        return Product::create($data);
    }

    public function getAll() {
        return Product::with('categories')->paginate(9);
    }
}
