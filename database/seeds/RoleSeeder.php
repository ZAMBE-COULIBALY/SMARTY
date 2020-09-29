<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $date = new DateTime(null);

        DB::table('roles')->insert([
            'label' => 'Super Administrator',
            'description' => 'Administrateur fonctionnel en charge du paramétrage des comptes utilisateurs et du système',
            'level' => 1,
            'slug' => Str::slug('Super Administrator',"_")
        ]);

        DB::table('roles')->insert([
           'label' => 'Administrator',
           'description' => 'Administrateur fonctionnel en charge du paramétrage des comptes utilisateurs et du système',
           'level' => 2,
           'slug' => Str::slug('Administrator')
       ]);

       DB::table('roles')->insert([
           'label' => 'Manager',
           'description' => 'Agent en charge des agences',
           'level' =>3,
           'slug' => Str::slug('Manager')
       ]);

       DB::table('roles')->insert([
        'label' => 'Agent Chief',
        'description' => 'Agent en charge des chargements et souscriptions',
        'level' => 4,
        'slug' => Str::slug('Agent Chief','_')
    ]);

       DB::table('roles')->insert([
        'label' => 'Agent',
        'description' => 'Agent en charge des souscriptions',
        'level' => 5,
        'slug' => Str::slug('Agent')
    ]);

    DB::table('roles')->insert([
        'label' => 'Gestionnaire sinistres',
        'description' => 'Agent NSIA en charge des sinistres',
        'level' => 3,
        'slug' => Str::slug('Claims Manager','_')
    ]);

    }
}
