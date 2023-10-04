<?php

namespace App\Console\Commands;

use App\Models\Product;
use Exception;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete product';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');

        try {
            $delete_product = Product::where('id', $id)->delete();

            if ($delete_product) {
                $this->info('Product Deleted Successfully');
            } else {
                $this->error('Failed to delete Product');
            }
        } catch (Exception $ex) {
            $this->error('error: ' . $ex->getMessage());
        }
    }
}
