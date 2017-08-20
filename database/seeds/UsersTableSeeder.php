<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name         = 'kentaro';
        $user->email = 'admin@kentaro.lk';
        $user->password  = Hash::make('password');
        $user->save();
    }
}
