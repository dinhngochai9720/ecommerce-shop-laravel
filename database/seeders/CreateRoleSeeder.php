<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert(['name' => 'admin', 'display_name' => 'admin system'],);
        DB::table('roles')->insert(['name' => 'user', 'display_name' => 'user system'],);
        DB::table('roles')->insert(['name' => 'client', 'display_name' => 'client system']);
    }
}