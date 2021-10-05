<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::truncate();
        for ($i = 1; $i <= 2; $i++) {
            $data = [
                'name' => 'Produk ' . $i,
                'desc' => 'Produk Deskripsi ' . $i,
                'condition' => 'new',
                'price' => rand(5000, 10000),
                'created_at' => date('Y-m-d H:i:s')
            ];
            Products::insert($data);
        }
    }
}
