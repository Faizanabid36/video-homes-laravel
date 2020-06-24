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
            ['role'=>'admin','slug'=>'admin'],
            ['role'=>'realtor','slug'=>'realtor'],
            ['role'=>'video provider','slug'=>'video-provider'],
        ];
        foreach ($roles as $role)
            UserRole::create($role);
    }
}
