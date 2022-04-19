<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use App\Models\Billplz\Collection;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collections = [
            [
                'credential_id'             => 1,
                'billplz_collection_id'     => 'utsx2wdq1',
                'collection_title'          => 'SUMBANGAN 1',
                'collection_description'    => 'sumbangan 1 sinar ramadhan',
                'retina_url'                => 'https://billplz-staging.s3.amazonaws.com/uploads/open_collection/photo/76477/retina_mini_magick20220326-4-1ee8lpm',
                'avatar_url'                => 'https://billplz-staging.s3.amazonaws.com/uploads/open_collection/photo/76477/avatar_mini_magick20220326-4-1ee8lpm'
            ],
            [
                'credential_id'             => 1,
                'billplz_collection_id'     => 'goh_zvw40',
                'collection_title'          => 'SUMBANGAN 2',
                'collection_description'    => 'sumbangan 2 sinar ramadhan',
                'retina_url'                => 'https://billplz-staging.s3.amazonaws.com/uploads/open_collection/photo/76478/retina_mini_magick20220324-4-uxxsk8',
                'avatar_url'                => 'https://billplz-staging.s3.amazonaws.com/uploads/open_collection/photo/76478/avatar_mini_magick20220324-4-uxxsk8'
            ],
        ];
        
        foreach ($collections as $collection) {
            Collection::create($collection);
        }

        foreach(Collection::all() as $collect) {
            $programs = Program::inRandomOrder()->take(rand(1,3))->pluck('id');
            foreach($programs as $program) {
                $collect->programs()->attach($program);
            }
        }
    }
}
