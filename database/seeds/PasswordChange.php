<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PasswordChange extends Seeder
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
        $user1->name         = 'irosh';
        $user1->email = 'irosh@kentaro.lk';
        $user1->password  = Hash::make('turbo1942');
        $user1->save();

        /*
         *
         * Default Roles Insertion
         */
        
        $admin = new Role();
        $admin->name         = 'admin_user1';
        $admin->display_name = 'Administrator'; // optional
        $admin->description  = 'User is allowed to manage and edit other users'; // optional
        $admin->save();

        $user1 = User::where('id', '=', '11')->first();
        // role attach alias
        $user1->attachRole($admin); // parameter can be an Role object, array, or id
        // or eloquent's original technique
        //$user1->roles()->attach($owner->id); // id only
        
        /*
         *
         * Default permissions Insertion
         */
        $createPost = new Permission();
        $createPost->name         = 'create-post1';
        $createPost->display_name = 'Create Posts'; // optional
        // Allow a user to...
        $createPost->description  = 'create new blog posts'; // optional
        $createPost->save();

        
        $viewPost = new Permission();
        $viewPost->name         = 'view-post1';
        $viewPost->display_name = 'View Post'; // optional
        // Allow a user to...
        $viewPost->description  = 'view existing post'; // optional
        $viewPost->save();

        $admin->attachPermission($createPost);
        // equivalent to $admin->perms()->sync(array($createPost->id));

        $owner->attachPermissions(array($createPost, $viewPost));
        // equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));

    }
}
