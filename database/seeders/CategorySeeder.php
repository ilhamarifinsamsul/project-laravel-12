<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get all categories
        $categories = [
            ['name' => 'Electronics'],
            ['name' => 'Fashion'],
            ['name' => 'Automotive']
        ];

        // insert categories
        // foreach ($categories as $category){
        //     Category::create($category);
        // }
        DB::table('category')->insert($categories);
    }
}
