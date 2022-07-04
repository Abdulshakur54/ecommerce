<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorBusiness;

class VendorsBusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VendorBusiness::insert(
            [[
                'vendor_id' => 2,
                'shop_name' => 'John Electronics Store',
                'shop_address' => '1234-SCF',
                'shop_city' => 'New Delhi',
                'shop_state' => 'Delhi',
                'shop_country' => 'India',
                'shop_pincode' => '110001',
                'shop_mobile' => '09076548762',
                'shop_website' => 'sitemakers.in',
                'shop_email' => 'kamarudeen@gmail.com',
                'address_proof' => 'Passport',
                'address_proof_image' => '',
                'business_license_number' => '787988789787978',
                'gst_number' => '434894729832',
                'pan_number' => '673892893832'
            ]]
        );
    }
}
