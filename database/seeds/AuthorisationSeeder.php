<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class AuthorisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminuser = User::where('username','adminsmarty')->first();
        $adminuser->roles()->attach(Role::where('slug','Super_Administrator')->first());


    }
}
