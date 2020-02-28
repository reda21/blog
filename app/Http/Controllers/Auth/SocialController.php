<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\CaptureIpTrait;
use Carbon\Carbon;
use App\Models\{Social, User, Profile};
use App\Services\Helper;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;
use Storage;

class SocialController extends Controller
{
    /**
     * @param string $provider
     */
    public function getSocialRedirect(string $provider)
    {
        $providerKey = Config::get('services.' . $provider);
        if (empty($providerKey)) {
            return view('welcome')
                ->with('error', trans('socials.noProvider'));
        }
        return redirect()->route("social.handle", ['provider' => $provider]);

        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param string $provider
     * @param Request $request
     */
    public function getSocialHandle(string $provider, Request $request)
    {
        $socialUserObject = json_decode(Storage::disk('public')->get($provider . '.json'));
        $socialUser = null;

        //   $socialUserObject = Socialite::driver($provider)->user();

        //     $socialUser = null;

        // Check if email is already registered
        $userCheck = User::where('email', '=', $socialUserObject->email)->first();

        $email = $socialUserObject->email;

        if (!$socialUserObject->email) {
            $email = 'missing' . Str::random(10) . '@' . Str::random(10) . '.example.org';
        }

        if (empty($userCheck)) {
            $sameSocialId = Social::where('social_id', '=', $socialUserObject->id)
                ->where('provider', '=', $provider)
                ->first();

            if (!$sameSocialId) {
                $ipAddress = new CaptureIpTrait();
                $socialData = new Social();
                $profile = new Profile();
                $role = Role::where('slug', '=', 'user')->first();
                $fullname = explode(' ', $socialUserObject->name);
                if (count($fullname) == 1) {
                    $fullname[1] = '';
                }
                $username = $socialUserObject->nickname;

                if ($username == null) {
                    foreach ($fullname as $name) {
                        $username .= $name;
                    }
                }

                // Check to make sure username does not already exist in DB before recording
                $username = $this->checkUserName($username, $email);

                $user = User::create([
                    'username' => $username,
                    'first_name' => $fullname[0],
                    'last_name' => $fullname[1],
                    'email' => $email,
                    'password' => bcrypt(Str::random(40)),
                    "email_verified_at" => Carbon::now(),
                ]);

                $socialData->social_id = $socialUserObject->id;
                $socialData->provider = $provider;
                $user->social()->save($socialData);
                $user->assignRole($role);

                $user->profile()->save($profile);
                $user->save();

                if ($socialData->provider == 'github') {
                    $user->profile->github_username = $socialUserObject->nickname;
                }

                // Twitter User Object details: https://developer.twitter.com/en/docs/tweets/data-dictionary/overview/user-object
                if ($socialData->provider == 'twitter') {
                    //$user->profile()->twitter_username = $socialUserObject->screen_name;
                    //If the above fails try (The documentation shows screen_name however so Twitters docs may be out of date.):
                    $user->profile->twitter_username = $socialUserObject->nickname;
                }
                $user->profile->save();

                $socialUser = $user;
            } else {
                $socialUser = $sameSocialId->user;
            }

            auth()->login($socialUser, true);

            return redirect(RouteServiceProvider::HOME)->with('success', trans('socials.registerSuccess'));

        }
        $socialUser = $userCheck;

        auth()->login($socialUser, true);

        return redirect(RouteServiceProvider::HOME);

        $socialUserObject = Socialite::driver($provider)->user();
        Storage::disk('public')->put($provider . '.json', response()->json(Helper::objectToArray($socialUserObject)));

    }

    /**
     * Check if username against database and return valid username.
     * If username is not in the DB return the username
     * else generate, check, and return the username.
     *
     * @param string $username
     * @param string $email
     *
     * @return string
     */
    protected function checkUserName($username, $email)
    {
        $userNameCheck = User::whereUsername($username)->first();
        if ($userNameCheck) {
            $i = 1;
            do {
                $username = $this->generateUserName($username);
                $newCheck = User::whereUsername($username)->first();

                if ($newCheck == null) {
                    $newCheck = 0;
                } else {
                    $newCheck = count($newCheck);
                }
            } while ($newCheck != 0);
        }

        return $username;
    }

    /**
     * Generate Username.
     *
     * @param string $username
     *
     * @return string
     */
    protected function generateUserName($username)
    {
        return $username . '_' . Str::random(10);
    }
}
