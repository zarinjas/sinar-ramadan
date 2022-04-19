<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Orchid\Attachment\Models\Attachment;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attachment::create([
            'name'          => 'no-image-default', 
            'original_name' => 'no-image-default', 
            'mime'          => 'image/jpeg', 
            'extension'     => 'jpg', 
            'size'          => 12280, 
            'sort'          => 0, 
            'path'          => 'public-images/', 
            'description'   => null, 
            'alt'           => 'No Images Found', 
            'disk'          => 'public', 
            'user_id'       => 1, 
            'group'         => null,
        ]);
    }
}
