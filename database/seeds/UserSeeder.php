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
                'email' => 'admin@mail.com',
                'password' => Hash::make('1234567890'),
                'gender' => 'male',
                'role' => 1,
                'username' => 'admin123'
            ]
        ];
        foreach ($user as $u)
            User::create($u);
    }
}
