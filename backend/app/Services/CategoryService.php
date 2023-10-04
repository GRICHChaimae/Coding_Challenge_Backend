<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Exception;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories() {
        try{
            $allCategories = $this->categoryRepository->getAll();
            return response()->json([
                'status' => 'success',
                'Categories' => $allCategories
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'failed',
                'error' => $ex->getMessage()
            ]);
        }
    }
}
