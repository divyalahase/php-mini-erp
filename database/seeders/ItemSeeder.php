<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'item_code' => 'ITM001',
                'item_name' => 'Laptop',
                'unit_of_measure' => 'pcs',
                'opening_stock' => 10,
                'stock' => 10,
                'company_id' => 1,
            ],
            [
                'item_code' => 'ITM002',
                'item_name' => 'Mouse',
                'unit_of_measure' => 'pcs',
                'opening_stock' => 50,
                'stock' => 50,
                'company_id' => 1,
            ],
            [
                'item_code' => 'ITM003',
                'item_name' => 'Keyboard',
                'unit_of_measure' => 'pcs',
                'opening_stock' => 30,
                'stock' => 30,
                'company_id' => 1,
            ],
            [
                'item_code' => 'ITM004',
                'item_name' => 'Monitor',
                'unit_of_measure' => 'pcs',
                'opening_stock' => 20,
                'stock' => 20,
                'company_id' => 1,
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
