<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Orchid\Platform\Database\Seeders\OrchidDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Orchid Seeder
        // $this->call([
        //     AttachmentSeeder::class,
        // ]);

        // Essential Seeder
        $this->call([
            StateSeeder::class,
            GroupSeeder::class,
            CategorySeeder::class,
            ProgramSeeder::class,
        ]);


        // $this->call([
        //     CredentialSeeder::class,
        //     CollectionSeeder::class,
        //     BillSeeder::class,
        //     CommentByBillSeeder::class
        // ]);
    }
}
