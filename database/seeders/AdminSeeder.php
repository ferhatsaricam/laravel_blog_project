<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name'=> 'ferhat sarıçam',
            'email'=> 'ferhat_saricam@yahoo.com',
            'password'=> bcrypt('qwerty'),
        ]);
    }
}
