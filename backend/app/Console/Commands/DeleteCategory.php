<?php

namespace App\Console\Commands;

use App\Models\Category;
use Exception;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');

        try {
            $delete_category = Category::where('id', $id)->delete();

            if ($delete_category) {
                $this->info('Category Deleted Successfully');
            } else {
                $this->error('Failed to delete Category');
            }
        } catch (Exception $ex) {
            $this->error('error', $ex->getMessage());
        }
    }
}
