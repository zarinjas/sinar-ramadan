<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            [
                'program_title'     => 'Infaq Ramadan', 
                'program_slug'      => 'infaq-ramadan', 
                'program_content'   => '',  
                'is_publish'        => true, 
                'user_id'           => 1,
            ],
            [
                'program_title'     => 'Bicara Tanwir Ramadan', 
                'program_slug'      => 'bicara-tanwir-ramadan', 
                'program_content'   => '',  
                'is_publish'        => true, 
                'user_id'           => 1,
            ],
            [
                'program_title'     => 'Kempen Seorang Sekampit Beras (KSSB)', 
                'program_slug'      => 'kempen-seorang-sekampit-beras', 
                'program_content'   => '', 
                'is_publish'        => true, 
                'user_id'           => 1,
            ],
            [
                'program_title'     => '30 Hadis Hijau Ramadan', 
                'program_slug'      => 'hadis-hijau-ramadan', 
                'program_content'   => '', 
                'is_publish'        => true, 
                'user_id'           => 1,
            ],
            [
                'program_title'     => '30 Projek Ramadan', 
                'program_slug'      => 'projek-ramadan', 
                'program_content'   => '', 
                'is_publish'        => true, 
                'user_id'           => 1,
            ],
        ];

        foreach($programs as $program) {
            Program::create($program);
        }
    }
}
