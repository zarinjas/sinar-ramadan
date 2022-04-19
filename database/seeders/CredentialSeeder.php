<?php

namespace Database\Seeders;

use App\Models\Billplz\Credential;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Credential::create([
            'credential_name'   => 'ABIM Billplz',
            'api_key'           => '4e2cc3c3-aaa0-44c7-9561-39208c8aa78d',
            'x_signature'       => 'S-qZefaHBUtsCz6W3ygWRq5A'
        ]);
    }
}
