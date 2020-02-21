<?php

use Illuminate\Database\Seeder;

class UsersRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // $role = Role::create(['name' => 'writer']);
    public function run()
    {
        DB::table('roles')->insert([
            'name' => "Utulisateur",
            'slug' => "user",
            "guard_name" => "web",
        ]);

        DB::table('roles')->insert([
            'name' => "Administrateur",
            'slug' => "admin",
            "guard_name" => "web",
        ]);

        DB::table('roles')->insert([
            'name' => "Super Admin",
            'slug' => "superadmin",
            "guard_name" => "web",
        ]);

        DB::table('roles')->insert([
            'name' => "Redacteur",
            'slug' => "redac",
            "guard_name" => "web",
        ]);
    }
}
