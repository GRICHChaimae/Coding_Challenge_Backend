<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\FilterProductRequest;
use App\Http\Requests\SortProductRequest;
use App\Services\ProductsService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $productsService;
    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    public function createProduct(AddProductRequest $request)
    {
        return $this->productsService->createProduct($request);
    }

    public function getAllProducts()
    {
        return $this->productsService->getAllProducts();
    }

    public function sortProductsByNameOrPrice(SortProductRequest $request)
    {
        return $this->productsService->sortProductsByNameOrPrice($request);
    }

    public function filterProductsByCategory(FilterProductRequest $request)
    {
        return $this->productsService->filterProductsByCategory($request);
    }
}
