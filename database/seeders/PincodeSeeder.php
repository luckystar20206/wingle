<?php

namespace Database\Seeders;

use App\Models\Pincode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PincodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pincodes = [391421, 391111, 391510, 391150, 391740];
        $area_names = ['Abhol', 'Achisara', 'Adiran', 'Agar', 'Ajod	'];

        $data = array(
            [
                'pincode' => 390018,
                'area_name' => 'Karelibaug',
            ],
            [
                'pincode' => 391421,
                'area_name' => 'Abhol',
            ],
            [
                'pincode' => 391111,
                'area_name' => 'Achisara',
            ],
            [
                'pincode' => 391510,
                'area_name' => 'Adiran',
            ],
            [
                'pincode' => 391150,
                'area_name' => 'Agar',
            ],
            [
                'pincode' => 391740,
                'area_name' => 'Ajod',
            ],

    );

        foreach($data as $val) {
            Pincode::factory()->create([
                'pincode' => $val['pincode'],
                'area_name' => $val['area_name'],
            ]);
        }
    }
}
