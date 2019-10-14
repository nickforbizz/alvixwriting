<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->name = 'admin';
        $role_user->description = 'A Default Admin sees default pages';
        $role_user->save();

        $role_admin = new Role();
        $role_admin->name = 'superadmin';
        $role_admin->description = 'A Superadmin User can see everyThing';
        $role_admin->save();
    }
}
