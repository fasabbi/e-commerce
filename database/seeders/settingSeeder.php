<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class settingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'setting_name' => 'phone', 
            'setting_value' => '01000100', 
            // 'name' => Str::random(10),
            // 'email' => Str::random(10) . '@gmail.com',
            // 'passsword' => Hash::make('password'),
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'email', 
            'setting_value' => Str::random(10) . '@gmail.com',
        ]);
    }
}
