<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('1234567890'),
//                'gender' => 'male',
                'role' => 1,
                'username' => 'admin123'
            ]
        ];
//        foreach ($user as $u)
//            User::create($u);
//        \App\AccountType::create(['user_id'=>1,'role'=>1]);
    }
}
