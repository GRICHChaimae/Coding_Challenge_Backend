<?php

namespace App\Repositories;

use App\Models\Product;

class ProductsRepository
{
    public function create($data)
    {
        return Product::create($data);
    }

    public function getAll()
    {
        return Product::with('categories')->paginate(9);
    }

    public function sortByNameOrByPrice($sort)
    {
        return Product::with('categories')->where('name', $sort)->orWhere('price', $sort)->paginate(9);
    }

    public function filterByCtegory($category_id)
    {
        return Product::with('categories')->where('category_id', $category_id)->paginate(9);
    }
}
