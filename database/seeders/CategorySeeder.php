<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'category_name'         => 'Panduan Ramadan & Syawal',
                'category_slug'         => 'panduan-ramadan-syawal',
                'category_description'  => ''
            ],
            [
                'category_name'         => 'E-Book Terbitan ABIM Sempena Ramadan Dan Syawal',
                'category_slug'         => 'ebook-terbitan-abim',
                'category_description'  => ''
            ],
        ];

        foreach($categories as $category) {
            Category::create($category);
        }
    }
}
