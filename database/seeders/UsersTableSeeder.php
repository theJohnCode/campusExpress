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
                "fullname" => "John Admin",
                "username" => "Admin",
                "email" => "ifeanyichukwujohn70@gmail.com",
                "password" => Hash::make('admin'),
                "role" => "admin",
                "status" => "active",
            ],
            // Vendor
            [
                "fullname" => "John Vendor",
                "username" => "Vendor",
                "email" => "vendor@gmail.com",
                "password" => Hash::make('vendor'),
                "role" => "vendor",
                "status" => "active",
            ],
            // Customer
            [
                "fullname" => "John Customer",
                "username" => "Customer",
                "email" => "customer@gmail.com",
                "password" => Hash::make('customer'),
                "role" => "customer",
                "status" => "active",
            ]
        ]);
    }
}
