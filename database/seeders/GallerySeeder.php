<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $galleries = [
            [
                'gallery_name'          => '', 
                'gallery_description'   => '', 
                'program_id'            => 1, 
            ]
        ];

        foreach($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
