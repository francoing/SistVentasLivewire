<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'LAVARAVEL Y LIREWIRE',
            'cost' => 200,
            'price'=> 350,
            'barcode' =>'75010065987',
            'stock'=>1000,
            'alerts'=>10,
            'category_id'=>1,
            'image'=> 'curso.png'

        ]);

        Product::create([
            'name' => 'QUESO ILOLAI',
            'cost' => 800,
            'price'=> 950,
            'barcode' =>'75010065989',
            'stock'=>1000,
            'alerts'=>10,
            'category_id'=>1,
            'image'=> 'queso.png'

        ]);

        Product::create([
            'name' => 'MIRINDA',
            'cost' => 1300,
            'price'=> 1350,
            'barcode' =>'75010065988',
            'stock'=>1000,
            'alerts'=>10,
            'category_id'=>1,
            'image'=> 'mirinda.png'

        ]);
    }
}
