<?php

namespace Tests\Feature;


use DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\{User, Profile};
use Artisan;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;
use Tests\UserTrait;

class UserTest extends TestCase
{
    use UserTrait;

    //   use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        Artisan::call("config:clear");

        Artisan::call("migrate");
    }

    public function testUpdateProfileWithTrue(): void
    {
        $header = $this->SetToken($this->SimpleUser());
        $request = factory(Profile::class)->make()->toArray();
        $email_hidden = $request['email_hidden'] = rand(0, 1);
        $response = $this->json("post", "api/profile", $request, $header); //http://blog.me/api/profile
        //        //   dd($response->content());

        $user = User::first();
        self::assertEquals($user->email_show, $email_hidden ? 0 : 1);
        self::assertEquals($user->profile->bio, $request['bio']);
        self::assertEquals($user->profile->location, $request['location']);
        self::assertEquals($user->profile->facebook_username, $request['facebook_username']);
        self::assertEquals($user->profile->url, $request['url']);
    }

    public function testUpdateAccountWithTrue(): void
    {
        $user = $this->SimpleUser();
        $header = $this->SetToken($user);
        $request = [
            "username" => $user->username,
            "email" => $user->email,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ];
        $response = $this->json("post", "api/account", $request, $header);
//        $response->dump();
        $response->assertSuccessful();

        $count = \DB::table("mail_reset_users")->where("email", $request['email'])->count();
        self::assertEquals($count, 0);
    }

    public function testUpdateAccountWithTrueAndChangeEmail(): void
    {
        $user = $this->SimpleUser();
        $header = $this->SetToken($user);
        $request = [
            "username" => $user->username,
            "email" => "email@gmail.com",
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ];
        $response = $this->json("post", "api/account", $request, $header);
        $response->assertSuccessful();
        $count = \DB::table("mail_reset_users")->where("email", $request['email'])->count();
        self::assertEquals($count, 1);
    }

    public function testUpdateAccountWithGuest(): void
    {
        $user = $this->SimpleUser();
        $request = [
            "username" => $user->username,
            "email" => $user->email,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ];
        $response = $this->json("post", "api/account", $request);
        $data = $response->json();

        $response->assertStatus(401);
        self::assertEquals($data, ["message" => "Unauthenticated."]);
    }

    public function testUpdateAccountWithFakeRequest(): void
    {
        $user = $this->SimpleUser();
        $header = $this->SetToken($user);
        $request = [
            "username" => "",
            "email" => $user->email,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ];
        $response = $this->json("post", "api/account", $request, $header);
        $data = $response->json();

        $response->assertStatus(422);
        self::assertEquals($data["message"], 'The given data was invalid.');
        self::assertArrayHasKey("username", $data["errors"]);
    }

    public function testUpdateAccountWithFakeExisteEmail(): void
    {
        $user = $this->SimpleUser();
        $user2 = $this->SimpleUser();
        $header = $this->SetToken($user);
        $request = [
            "username" => $user->username,
            "email" => $user2->email,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ];
        $response = $this->json("post", "api/account", $request, $header);
        $data = $response->json();

        $response->assertStatus(422);
        self::assertEquals($data["message"], 'The given data was invalid.');
        self::assertArrayHasKey("email", $data["errors"]);
        self::assertEquals($data["errors"]["email"][0], "La valeur du champ adresse email est déjà utilisée.");
    }

    public function testClickResponseMail()
    {
        $user = $this->SimpleUser();
        $table = DB::table('mail_reset_users');
        $token = Password::createToken($user);
        $array = ['email' => 'john@example.com', "token" => $token, "created_at" => now()];
        $table->insert($array);
        $url = "user/email/reset/{$user->id}/{$array['email']}/" . $token;

        $response = $this->get($url);

        self::assertEquals(User::first()->email, $array["email"]);
        $response->assertStatus(302);
        $response->assertRedirect("/");
        self::assertEquals($table->count(), 0);
    }

    public function testClickResponseMailEXpiredMail()
    {
        $user = $this->SimpleUser();
        $table = DB::table('mail_reset_users');
        $token = Password::createToken($user);
        $array = ['email' => 'john@example.com', "token" => $token, "created_at" => now()->subHours(2)];
        $table->insert($array);
        $url = "user/email/reset/{$user->id}/{$array['email']}/" . $token;
        $response = $this->get($url);

        self::assertEquals(User::first()->email, $user->email);
        $response->assertStatus(302);
        $response->assertRedirect("/");
        self::assertEquals($table->count(), 0);
    }

    public function testFile()
    {
        $user = $this->SimpleUser();
        $user2 = $this->SimpleUser();
        $upload = $this->actingAs($user,'api')->json('post', 'api/avatar', [
            'avatar' => $file = UploadedFile::fake()->image('random.jpg', 300, 300),
   //         'img' => UploadedFile::fake()->image("red.jpg", 200, 200),
            "red" => 5,
        ]);

        dd($user->profile->avatar, $user->avatar, $user2->avatar);


        $upload->assertSuccessful();

        // Assert the file was stored...
        Storage::disk("local")->assertExists('avatar.jpg');
        Storage::disk("local")->assertExists('.\avatars\avatar.jpg');

        dump($upload->content());
        self::assertTrue(true);
    }


}
