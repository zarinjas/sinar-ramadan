<?php

namespace Database\Seeders;

use App\Models\Billplz\Bill;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bills = [
            [
                'bill_id'       => 's0c2unu5',
                'donator_name'  => 'MUHAMMAD FADLI',
                'is_anonymous'  => true,  
                'paid_amount'   => 100.00,  
                'paid_at'       => '2022-03-25 02:43:53'
                
            ],
            [
                'bill_id'       => 'pkysveqo',
                'donator_name'  => 'MUHAMMAD FADLI',
                'is_anonymous'  => false,  
                'paid_amount'   => 1000.00,  
                'paid_at'       => '2022-03-25 00:54:41.486'
            ],
            [
                'bill_id'       => 'jjwoq8sg',
                'donator_name'  => 'MUHAMMAD FADLI',
                'is_anonymous'  => true,  
                'paid_amount'   => 10.00,  
                'paid_at'       => '2022-03-24T23:29:59.002'
            ],
            [
                'bill_id'       => 'pi1cn1ym',
                'donator_name'  => 'TEST NAME 2',
                'is_anonymous'  => false,  
                'paid_amount'   => 1234.00,  
                'paid_at'       => '2022-03-26T00:23:45.787'
            ],
            [
                'bill_id'       => 'utfibi1q',
                'donator_name'  => 'LI',
                'is_anonymous'  => false,  
                'paid_amount'   => 543.00,  
                'paid_at'       => '2022-03-26T00:26:23.401'
            ],
        ];

        foreach ($bills as $bill) {
            Bill::create($bill);
        }

        Bill::factory(50)->create();
    }
}
