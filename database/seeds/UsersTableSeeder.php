<?php

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_super_admin = Role::where('name', 'superadmin')->first();
        $role_admin  = Role::where('name', 'admin')->first();

        $user = new Admin();
        $user->fname = 'SiteAdmin';
        $user->lname = 'Administrator';
        $user->national_id = '12345678';
        $user->username = 'superadmin';
        $user->email = 'superadmin@alvixwriting.com';
        $user->role_id = $role_super_admin->id;
        $user->password = bcrypt('secret');
        $user->save();

        $admin = new Admin();
        $admin->fname = 'John';
        $admin->lname = 'Doe';
        $admin->national_id = '2345678';
        $admin->username = 'admin';
        $admin->email = 'admin@alvixwriting.com';
        $admin->password = bcrypt('admin');
        $admin->role_id = $role_admin->id;

        $admin->save();
    }
}
