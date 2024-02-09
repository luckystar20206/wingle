<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'product_name' => 'Cloth 1',
                'image_name' => "test-image",
                'image_path' => "https://source.unsplash.com/500x450/?clothes",
                'price' => 39,
                'pincode' => 391421,
                'featured' => true,
                'rating' => 4.8
            ],
            [
                'product_name' => 'Cloth 2',
                'image_name' => "test-image",
                'image_path' => "https://source.unsplash.com/500x450/?clothes",
                'price' => 39,
                'pincode' => 391421,
                'featured' => true,
                'rating' => 4.3
            ],
            [
                'product_name' => 'Cloth 3',
                'image_name' => "test-image",
                'image_path' => "https://source.unsplash.com/500x450/?clothes",
                'price' => 39,
                'pincode' => 391421,
                'featured' => true,
                'rating' => 4.0
            ],
            [
                'product_name' => 'Cloth 4',
                'image_name' => "test-image",
                'image_path' => "https://source.unsplash.com/500x450/?clothes",
                'price' => 39,
                'pincode' => 391421,
                'featured' => true,
                'rating' => 4.1
            ],
            [
                'product_name' => 'Cloth 5',
                'image_name' => "test-image",
                'image_path' => "https://source.unsplash.com/500x450/?clothes",
                'price' => 39,
                'pincode' => 391421,
                'featured' => false,
                'rating' => 4.3
            ],
        );

        foreach ($data as $val){
            Product::factory()->create([
                'product_name' => $val['product_name'],
                'image' => $val['image_name'],
                'price' => $val['price'],
                'pincode' => $val['pincode'],
                'featured' => $val['featured'],
                'rating' => $val['rating'],
            ]);
        }
    }
}
