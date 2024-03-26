<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            ['guard_name'=>'web', 'group_name'=>'category','name'=>'category-list'],
            ['guard_name'=>'web', 'group_name'=>'category','name'=>'category-create'],
            ['guard_name'=>'web', 'group_name'=>'category','name'=>'category-edit'],
            ['guard_name'=>'web', 'group_name'=>'category','name'=>'category-delete'],

            ['guard_name'=>'web', 'group_name'=>'purchase','name'=>'purchase-list'],
            ['guard_name'=>'web', 'group_name'=>'purchase','name'=>'purchase-create'],
            ['guard_name'=>'web', 'group_name'=>'purchase','name'=>'purchase-edit'],
            ['guard_name'=>'web', 'group_name'=>'purchase','name'=>'purchase-delete'],

            ['guard_name'=>'web', 'group_name'=>'transactions','name'=>'transactions-list'],
            ['guard_name'=>'web', 'group_name'=>'transactions','name'=>'transactions-create'],
            ['guard_name'=>'web', 'group_name'=>'transactions','name'=>'transactions-edit'],
            ['guard_name'=>'web', 'group_name'=>'transactions','name'=>'transactions-delete'],

            ['guard_name'=>'web', 'group_name'=>'setting','name'=>'setting-menu'],
            ['guard_name'=>'web', 'group_name'=>'setting','name'=>'setting-edit'],

        ];
        Permission::insert($permissions);
    }
}

