<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['name' => 'ABC Pvt Ltd', 'address' => '123 Main St'],
            ['name' => 'XYZ Corp', 'address' => '456 High St'],
            ['name' => 'Mega Traders', 'address' => '789 Market St'],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
