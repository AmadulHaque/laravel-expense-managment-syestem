<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array();
        $data['email'] = 'test@egmail.com';
        $data['phone'] = '12345678';
        $data['shop_title'] = 'test';
        $data['address'] = 'test';
        $data['address_two'] = 'test';
        $data['currency'] = '৳';
        DB::table('settings')->insert($data);
    }
}
