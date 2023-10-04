<?php

namespace App\Services;

use App\Repositories\ProductsRepository;
use Exception;

class ProductsService
{
    protected $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function createProduct($request)
    {
        try {
            $image = $request['image'];
            $extenstion = $image->getClientOriginalExtension();
            $image_name = uniqid() . '.' . $extenstion;
            $image->move(public_path('storage/Products_images'), $image_name);
            $data = [
                'category_id' => $request['category_id'],
                'name' => $request['name'],
                'description' => $request['description'],
                'price' => $request['price'],
                'image' => $image_name,
            ];

            $this->productsRepository->create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Product Created Successfully'
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'failed',
                'error' => $ex->getMessage()
            ]);
        }
    }

}