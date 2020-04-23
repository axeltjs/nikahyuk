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
        $check = User::get();
        if($check->isEmpty()){
            $user[] = [
                'name' => 'Axel Saputra',
                'email' => 'admin@gmail.com',
                'phone' => '082154981441',
                'email_verified_at' => now(),
                'password' => bcrypt('123123'),
                'remember_token' => Str::random(10),
            ];
    
            $user[] = [
                'name' => 'Adel',
                'email' => 'vendor@gmail.com',
                'phone' => '082154981442',
                'email_verified_at' => now(),
                'password' => bcrypt('123123'),
                'remember_token' => Str::random(10),
            ];
    
            $user[] = [
                'name' => 'Customer',
                'email' => 'customer@gmail.com',
                'phone' => '082154981443',
                'email_verified_at' => now(),
                'password' => bcrypt('123123'),
                'remember_token' => Str::random(10),
            ];
    
            $role = ['Admin','Vendor','Customer'];
    
            foreach($user as $i => $item){
                $newUser = User::create($item); 
                $newUser->assignRole($role[$i]);
            }
    
        }
        
    }
}
