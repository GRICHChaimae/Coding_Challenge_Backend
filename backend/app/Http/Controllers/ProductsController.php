<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
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
}