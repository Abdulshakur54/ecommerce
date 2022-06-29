<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
           [ 
            'name'=>'Super Admin',
            'type'=>'superadmin',
            'vendor_id'=>'0',
            'mobile'=>'08106413226',
            'email'=>'mabdulshakur54@gmail.com',
            'password'=>Hash::make('qqqqqq'),
            'image'=>'',
            'status'=>1
           ]
           ];
           Admin::insert($adminRecords);
    }
}
