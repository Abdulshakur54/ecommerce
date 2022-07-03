<?php

namespace Database\Seeders;

use App\Models\VendorBankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VendorBankDetail::insert(
            [
                [
                    'vendor_id' => 3,
                    'account_name' => 'Kamarudeen',
                    'bank_name' => 'ICICI',
                    'account_number' => '3489438909',
                    'bank_ifsc_code' => '4786867698'
                ]
            ]
        );
    }
}
