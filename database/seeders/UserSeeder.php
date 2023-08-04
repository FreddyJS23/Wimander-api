<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
           
            'name'=>'admin1',
            'last_name'=>'admin',
            'user'=>'admin1',
            'email'=>'admin1@gmail.com',
            'password'=>Hash::make('12345678'),
            'active'=>true,
            'role_id'=>1
         ]);
       
         DB::table('users')->insert([
           
            'name'=>'admin2',
            'last_name'=>'admin',
            'user'=>'admin2',
            'email'=>'admin2@gmail.com',
            'password'=>Hash::make('12345678'),
            'active'=>true,
            'role_id'=>1
         ]);
      
         DB::table('users')->insert([
           
            'name'=>'user1',
            'last_name'=>'user',
            'user'=>'user1',
            'email'=>'user1@gmail.com',
            'password'=>Hash::make('12345678'),
            'active'=>true,
            'role_id'=>2
         ]);
       
        
       
        
    }
}
