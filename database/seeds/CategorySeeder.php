<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category' => 'News'
        ]);
        Category::create([
            'category' => 'Articles'
        ]);
        Category::create([
            'category' => 'Opportunities'
        ]);
        Category::create([
            'category' => 'Events'
        ]);
    }
}
