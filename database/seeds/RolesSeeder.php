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
        $user_tags=[
            ['tag_name'=>'Real Estate Agent'],
            ['tag_name'=>'Team Leader'],
            ['tag_name'=>'Commercial Broker'],
        ];
        foreach ($roles as $role)
            UserRole::create($role);
        foreach($user_tags as $user_tag)
            UserTags::create($user_tag);

    }
}
