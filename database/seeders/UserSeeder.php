<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Raul',
            'phone' => '3814143174',
            'email' =>'raul@gmail.com',
            'profile'=>'ADMIN',
            'status'=>'ACTIVE',
            'password'=>bcrypt('12345678')
        ]);

        User::create([
            'name'=>'Jose Alberto',
            'phone' => '3814143174',
            'email' =>'jose@gmail.com',
            'profile'=>'EMPLOYEE',
            'status'=>'ACTIVE',
            'password'=>bcrypt('12345678')
        ]);
    }
}
