<?php

namespace Database\Factories\Billplz;

use App\Models\Billplz\Bill;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    protected $model = Bill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bill_id'       => $this->faker->unique()->bothify('?#?#???#'),
            'donator_name'  => $this->faker->name,
            'is_anonymous'  => mt_rand(0,1),  
            'paid_amount'   => $this->faker->randomFloat(2, 0, 1000),  
            'paid_at'       => $this->faker->dateTimeBetween('-8 Days')->format('Y-m-d H:i:s')
        ];
    }
}
