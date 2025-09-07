<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['name' => 'John Doe', 'email' => 'john@example.com', 'phone' => '1234567890', 'company_id'=>1],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'phone' => '9876543210', 'company_id'=>1],
            ['name' => 'Acme Corp', 'email' => 'acme@example.com', 'phone' => '5555555555', 'company_id'=>2],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
