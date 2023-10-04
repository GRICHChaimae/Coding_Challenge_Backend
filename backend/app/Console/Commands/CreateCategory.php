<?php

namespace App\Console\Commands;

use App\Models\Category;
use Exception;
use Illuminate\Console\Command;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create {name} {parent_category}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creat category';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $parent_category = $this->argument('parent_category');

        try {
            $category = Category::create([
                'name' => $name,
                'parent_category' => $parent_category
            ]);

            if($category) {
                $this->info('Category Created Successfully');
            }else {
                $this->info('Failed to Create Category');
            }
        }catch(Exception $ex) {
            $this->info('error' . $ex->getMessage());
        }
    }
}
