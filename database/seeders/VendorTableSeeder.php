<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::insert(
            [
                [
                    'id' => 3,
                    'name' => 'Kamarudeen',
                    'address' => '1234-SCF',
                    'city' => 'New Delhi',
                    'state' => 'Delhi',
                    'country' => 'India',
                    'pincode' => '110001',
                    'mobile' => '09076548762',
                    'email' => 'kamarudeen@gmail.com',
                    'status' => 0
                ]
            ]
        );
    }
}
