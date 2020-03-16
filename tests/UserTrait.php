<?php
/**
 * Created by PhpStorm.
 * User: fatah
 * Date: 05/12/2017
 * Time: 13:26
 */

namespace Tests;



use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DB;
use Faker\Factory;
use Faker\Generator as Faker;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Role;

trait UserTrait
{
    public $roleCreated = false;

    public function CreateUser($numbre = 1, $role = "user")
    {
        if ($numbre == 1) {
            $user = factory(User::class)
                ->create();
            $user->assignRole(Role::whereSlug($role)->first());
            $user->profile()->create();
            return $user;
        }

        return factory(User::class, $numbre)
            ->create()
            ->each(function ($u) use ($role) {
                $u->assignRole(Role::whereSlug($role)->first());
            });
    }

    private function apiAuth($user, $liste = [])
    {
        Passport::actingAs(
            $user,
            $liste
        );
    }

    private function createRole()
    {
        if (!$this->roleCreated) {
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
            $this->roleCreated = true;
        }


    }

    private function UserSuperAdmin()
    {
        $this->createRole();

        $user = $this->CreateUser(1, "superadmin");

        $this->be($user);
        return $user;
    }

    private function UserAdmin()
    {
        $this->createRole();

        $user = $this->CreateUser(1, "admin");
        $this->be($user);
        return $user;
    }

    private function UserRedac()
    {
        $this->createRole();

        $user = $this->CreateUser(1, "redac");

        $this->be($user);
        return $user;
    }

    private function SimpleUser()
    {
        $this->createRole();

        $user = $this->CreateUser(1, "user");

        $this->be($user);
        return $user;
    }

    private function createRankForum()
    {
        factory(Rank::class)->create(
            [
                "name" => "Administrateur",
                "msg" => -2,
                "special" => 1,
                "numbre_start" => -2
            ]);

        factory(Rank::class)->create(
            [
                "name" => "Redacteur",
                "msg" => -1,
                "special" => 1,
                "numbre_start" => -1
            ]);

        factory(Rank::class)->create(
            [
                "name" => "Membre Inactif",
                "msg" => 0,
                "special" => 0,
                "numbre_start" => 0
            ]);

        factory(Rank::class)->create(
            [
                "name" => "Membre Actif",
                "msg" => 10,
                "special" => 0,
                "numbre_start" => 0
            ]);
    }

    public function SetToken($user)
    {
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', 'http://localhost'
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        $tokens = $user->createToken('TestToken');

        $token = $tokens->accessToken;
        $header = [];
        $header['Accept'] = 'application/json';
        $header['Authorization'] = 'Bearer ' . $token;

        return $header;
    }

}
