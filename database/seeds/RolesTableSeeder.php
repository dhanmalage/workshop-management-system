<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new Role();
        $owner->name         = 'owner';
        $owner->display_name = 'Project Owner'; // optional
        $owner->description  = 'Project owner is the owner of a given project'; // optional
        $owner->save();

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Administrator'; // optional
        $admin->description  = 'User is allowed to manage and edit other users'; // optional
        $admin->save();

        $user1 = User::where('id', '=', '1')->first();
        // role attach alias
        $user1->attachRole($owner); // parameter can be an Role object, array, or id
        // or eloquent's original technique
        //$user1->roles()->attach($owner->id); // id only

        $user2 = User::where('id', '=', '2')->first();
        // role attach alias
        $user2->attachRole($admin); // parameter can be an Role object, array, or id
        // or eloquent's original technique
        //$user2->roles()->attach($admin->id); // id only
    }
}
