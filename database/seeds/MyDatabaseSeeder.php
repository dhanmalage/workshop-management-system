<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         *
         * Default Users Insertion
         */
        $user1 = new User();
        $user1->name         = 'admin';
        $user1->email = 'admin@kentaro.lk';
        $user1->password  = Hash::make('password');
        $user1->save();

        $user2 = new User();
        $user2->name         = 'kentaro';
        $user2->email = 'kentaro@kentaro.lk';
        $user2->password  = Hash::make('password');
        $user2->save();

        /*
         *
         * Default Roles Insertion
         */
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

        /*
         *
         * Default permissions Insertion
         */
        $createPost = new Permission();
        $createPost->name         = 'create-post';
        $createPost->display_name = 'Create Posts'; // optional
        // Allow a user to...
        $createPost->description  = 'create new blog posts'; // optional
        $createPost->save();

        $editUser = new Permission();
        $editUser->name         = 'edit-user';
        $editUser->display_name = 'Edit Users'; // optional
        // Allow a user to...
        $editUser->description  = 'edit existing users'; // optional
        $editUser->save();

        $viewPost = new Permission();
        $viewPost->name         = 'view-post';
        $viewPost->display_name = 'View Post'; // optional
        // Allow a user to...
        $viewPost->description  = 'view existing post'; // optional
        $viewPost->save();

        $admin->attachPermission($createPost);
        // equivalent to $admin->perms()->sync(array($createPost->id));

        $owner->attachPermissions(array($createPost, $editUser, $viewPost));
        // equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));

    }
}
