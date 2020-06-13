<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user[] = [
            'name' => 'Axel Saputra',
            'email' => 'admin@gmail.com',
            'phone' => '082154981441',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'),
            'remember_token' => Str::random(10),
            'role' => 'Admin'
        ];

        $user[] = [
            'name' => 'Adel Anggraini',
            'email' => 'vendor@gmail.com',
            'phone' => '082154981442',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'),
            'remember_token' => Str::random(10),
            'role' => 'Vendor'
        ];

        $user[] = [
            'name' => 'Rohit Vaswani',
            'email' => 'vendor1@gmail.com',
            'phone' => '082154981442',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'),
            'remember_token' => Str::random(10),
            'role' => 'Vendor'
        ];

        $user[] = [
            'name' => 'Mudit Trivendi',
            'email' => 'vendor2@gmail.com',
            'phone' => '082154981442',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'),
            'remember_token' => Str::random(10),
            'role' => 'Vendor'
        ];

        $user[] = [
            'name' => 'Nadine Putri',
            'email' => 'vendor3@gmail.com',
            'phone' => '082154981442',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'),
            'remember_token' => Str::random(10),
            'role' => 'Vendor'
        ];

        $user[] = [
            'name' => 'Muzib',
            'email' => 'customer@gmail.com',
            'phone' => '082154981443',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'),
            'remember_token' => Str::random(10),
            'role' => 'Customer'
        ];

        $user[] = [
            'name' => 'Wawan',
            'email' => 'customer2@gmail.com',
            'phone' => '082154981100',
            'email_verified_at' => now(),
            'password' => bcrypt('123123'),
            'remember_token' => Str::random(10),
            'role' => 'Customer'
        ];

        foreach($user as $i => $item){
            $newUser = User::firstOrCreate(['email' => $item['email']], collect($item)->except('role')->toArray()); 
            $newUser->assignRole($item['role']);
        }
    }
}
