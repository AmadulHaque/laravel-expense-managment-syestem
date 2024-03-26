<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'admin';
        $user->username = 'admin';
        $user->email = 'admin@gmail.com';
        $user->phone = '01712345678';
        $user->address = 'Dhaka';
        $user->photo = null;
        $user->role = '1';
        $user->password = Hash::make('12345678');
        $user->save();
    }
}
