<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        //
        $categories = [
            ['name' => 'Music'],
            ['name' => 'Film & Animation'],
            ['name' => 'Pets & Animals'],
            ['name' => 'Sports'],
            ['name' => 'Travel & Events'],
            ['name' => 'Gaming'],
            ['name' => 'People & Blogs'],
            ['name' => 'Comedy'],
            ['name' => 'Entertainment'],
            ['name' => 'News & Politics'],
            ['name' => 'How-to & Style'],
            ['name' => 'Non-Profit & Activism'],
            ['name' => 'Other'],

        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
