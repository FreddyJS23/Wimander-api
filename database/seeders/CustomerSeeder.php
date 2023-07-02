<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(30)->state(new Sequence(['user_id' => 1], ['user_id' => 2]))->hasConnection(1, function (array $attributes, Customer $customer) {
            return [
                'customer_id' => $customer->id,
                'user_id' => $customer->user_id
            ];
        })->create();
    }
}
