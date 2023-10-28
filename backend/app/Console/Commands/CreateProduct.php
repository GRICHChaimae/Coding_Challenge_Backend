<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\ProductsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Product';

    /**
     * Execute the console command.
     */
    public function handle(ProductsService $productsService)
    {
        $category_id = $this->ask('Enter the category id');
        $name = $this->ask('Enter the product name:');
        $description = $this->ask('Enter the product description:');
        $price = $this->ask('Enter the product price:');
        $imagePath = $this->ask('Enter the product image:');
        $uploadedFile = new \Illuminate\Http\UploadedFile($imagePath, basename($imagePath), mime_content_type($imagePath), 0, true);
        $data = [
            'category_id' => $category_id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $uploadedFile,
        ];

        $response = $productsService->createProduct($data);
        $responseData = json_decode($response->getContent(), true);
        $status = $responseData['status'];
        if ($status === 'success') {
            $this->info('Product Created Successfully');
        } else {
            $this->error('Failed to create Product: ' . $response['status']);
        }
    }
}
