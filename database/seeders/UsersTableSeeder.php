<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // Admin
            [
                "first_name" => "John",
                "last_name" => "Admin",
                "username" => "Admin",
                "email" => "ifeanyichukwujohn70@gmail.com",
                "password" => Hash::make('admin'),
                "role" => "admin",
                "status" => "active",
            ],
            // Vendor
            [
                "first_name" => "John",
                "last_name" => "Seller",
                "username" => "Seller",
                "email" => "seller@gmail.com",
                "password" => Hash::make('seller'),
                "role" => "seller",
                "status" => "active",
            ],
            // Customer
            [
                "first_name" => "John",
                "last_name" => "Customer",
                "username" => "Customer",
                "email" => "customer@gmail.com",
                "password" => Hash::make('customer'),
                "role" => "customer",
                "status" => "active",
            ]
        ]);
    }
}
