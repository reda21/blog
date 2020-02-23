<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = factory(User::class)
            ->create([
                "username" => "reda21",
                'email' => "redacherfaoui@gmail.com",
                "email_show" => 1,
                'password' => bcrypt("bejaia21"),
                "email_verified_at" => Carbon::now(),
                'first_name' => "reda",
                'last_name' => "cherfaoui",
            ]);

        $user->assignRole(Role::findById(3));
        $user->profile()->create();

        $user = factory(User::class)
            ->create([
                "username" => "redmax",
                'email' => "redacherfaouimx@gmail.com",
                "email_show" => 1,
                'password' => bcrypt("bejaia21"),
                "email_verified_at" => Carbon::now(),
                'first_name' => "reda",
                'last_name' => "cherfaoui",
            ]);
        $user->assignRole(Role::findById(2));
        $user->profile()->create();

        factory(User::class, 2)->create()
            ->each(function ($u) {
                $u->assignRole(Role::findById(4));
                $u->profile()->create();
            });

        factory(User::class, 20)->create()
            ->each(function ($u) {
                $u->assignRole(Role::findById(1));
                $u->profile()->create();
            });

    }
}
