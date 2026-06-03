<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'Admin',
            'email' => 'baghel083@gmail.com',
            'is_admin'=> 1,
            'country_code'=> '+91',
            'currency'=> 'INR',
            'email_veriifed'=> 0,
            'password'=> Hash::make('admin12345')

        ]);
    }
}
