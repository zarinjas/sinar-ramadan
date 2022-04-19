<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'group_name'    => 'Kempen Seorang Sekampit Beras', 
                'group_url'     => null, 
                'district'      => 'Abim Pusat', 
                'address'       => '', 
                'state_id'      => 2, 
                'is_main'       => true, 
            ],
            [
                'group_name'    => 'Infaq Ramadan', 
                'group_url'     => null, 
                'district'      => 'Abim Pusat', 
                'address'       => '', 
                'state_id'      => 2, 
                'is_main'       => true, 
            ],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
