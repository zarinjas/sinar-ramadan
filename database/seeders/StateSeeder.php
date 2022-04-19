<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            // [
            //     "state_name"  => "Wilayah Persekutuan Kuala Lumpur",
            //     "state_code"  => "MY-14",
            //     "subdivision" => "federal territory"
            // ],
            [
                "state_name"  => "Wilayah Persekutuan Labuan",
                "state_code"  => "MY-15",
                "subdivision" => "federal territory"
            ],
            [
                "state_name"  => "Abim Pusat",
                "state_code"  => "MY-99",
                "subdivision" => "abim center"
            ],
            // [
            //     "state_name"  => "Wilayah Persekutuan Putrajaya",
            //     "state_code"  => "MY-16",
            //     "subdivision" => "federal territory"
            // ],
            [
                "state_name"  => "Johor",
                "state_code"  => "MY-01",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Kedah",
                "state_code"  => "MY-02",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Kelantan",
                "state_code"  => "MY-03",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Melaka",
                "state_code"  => "MY-04",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Negeri Sembilan",
                "state_code"  => "MY-05",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Pahang",
                "state_code"  => "MY-06",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Perak",
                "state_code"  => "MY-08",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Perlis",
                "state_code"  => "MY-09",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Pulau Pinang",
                "state_code"  => "MY-07",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Sabah",
                "state_code"  => "MY-12",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Sarawak",
                "state_code"  => "MY-13",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Lembah Klang",
                "state_code"  => "MY-10",
                "subdivision" => "state"
            ],
            [
                "state_name"  => "Terengganu",
                "state_code"  => "MY-11",
                "subdivision" => "state"
            ]
        ];

        foreach($states as $state) {
            State::create($state);
        }
    }
}
