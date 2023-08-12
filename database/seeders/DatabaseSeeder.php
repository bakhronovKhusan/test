<?php

namespace Database\Seeders;

use App\Models\Materials;
use App\Models\ProductMaterials;
use App\Models\Products;
use App\Models\Warehouses;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'Koylak', 'code' => '129567'],
            ['name' => 'Shim',   'code' => '349561']
        ];

        foreach ($products as $product) {
            Products::create($product);
        }

        $elements = [
            ['name' => 'Mato' ],
            ['name' => 'Ip'   ],
            ['name' => 'Tugma'],
            ['name' => 'Zamok']
        ];

        foreach ($elements as $element) {
            Materials::create($element);
        }

        $product_elements = [
            ['product_id' => 1, 'material_id' => 1, 'quantity' => '0.8'],
            ['product_id' => 1, 'material_id' => 3, 'quantity' => '5'  ],
            ['product_id' => 1, 'material_id' => 2, 'quantity' => '10' ],
            ['product_id' => 2, 'material_id' => 1, 'quantity' => '1.4'],
            ['product_id' => 2, 'material_id' => 2, 'quantity' => '10' ],
            ['product_id' => 2, 'material_id' => 4, 'quantity' => '1'  ],
        ];

        foreach ($product_elements as $product_element) {
            ProductMaterials::create($product_element);
        }

        $warehouses = [
            ['material_id' => 1, 'remainder' => 12,   'price'=> '1500'],
            ['material_id' => 1, 'remainder' => 200,  'price'=> '1600'],
            ['material_id' => 2, 'remainder' => 40,   'price'=> '500' ],
            ['material_id' => 2, 'remainder' => 300,  'price'=> '550' ],
            ['material_id' => 3, 'remainder' => 500,  'price'=> '300' ],
            ['material_id' => 4, 'remainder' => 1000, 'price'=> '2000'],
        ];

        foreach ($warehouses as $warehouse){
            Warehouses::create($warehouse);
        }
    }
}
