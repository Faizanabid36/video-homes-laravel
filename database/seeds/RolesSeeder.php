<?php

use Illuminate\Database\Seeder;
use App\UserRole;
use App\UserTags;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles=[
            ['role'=>'admin'],
            ['role'=>'realtor'],
            ['role'=>'video provider'],
        ];
        foreach ($roles as $role)
            UserRole::create($role);
    }
}
