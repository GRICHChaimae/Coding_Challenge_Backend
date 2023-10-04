<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

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
    public function handle()
    {
        $category_id = $this->ask('Enter the category id');
        $name = $this->ask('Enter the product name:');
        $description = $this->ask('Enter the product description:');
        $price = $this->ask('Enter the product price:');
        $imagePath = $this->ask('Enter the product image:');

        $imageUrl = asset($imagePath);

        $extension = File::extension(public_path($imagePath));
        $filename = 'product-image.' . $extension;

        $response = Http::attach(
            'image',
            file_get_contents(public_path($imagePath)),
            $filename
        )->post('http://127.0.0.1:8000/api/add-product', [
            'category_id' => $category_id,
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'image' => $imageUrl,
        ]);

        if ($response->successful()) {
            $this->info('Product Created Successfully');
        } else {
            $this->error('Failed to create Product' . $response->status());
        }
    }
}
