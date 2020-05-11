<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountUpdateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\ChangeCoverRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\UserRepository;
use App\Rules\ImageSize;
use App\Services\Helper;
use App\Services\Image as ImageDB;
use App\Traits\MailResetUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use OpenApi\Annotations as OA;
use App\Http\Resources\User as UserRessouce;

class UserController extends Controller
{
    /**
     *
     */
    use MailResetUsers;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;


    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     *
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->init();
    }

    /**
     * @OA\Get(
     *     path="/me",
     *     tags={"user", "get"},
     *     security={"petstore_auth"},
     *     @OA\Response(
     *     response="200",
     *      description="la response",
     *      @OA\JsonContent(ref="#/components/schemas/User")
     *   )
     * )
     * @param Request $request
     * @return UserRessouce
     */
    public function me(Request $request): UserRessouce
    {
        return new UserRessouce($request->user());
    }

    /**
     * @OA\Get(
     *     path="/user",
     *     security={"apiKey"},
     *     tags={"user", "get"},
     *     @OA\Parameter(name="limit",in="query",description="nompbre d'utulisateur a recupérer", required=false, @OA\Schema(type="integer"), example="10"),
     *     @OA\Response(
     *     response="200",
     *      description="la response",
     *      @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *   )
     * )
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserRessouce::collection($this->userRepository->all());
    }

    /**
     * @OA\Get(
     *     path="/user/{id}",
     *     tags={"user", "get"},
     *     security={"petstore_auth"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="la response",
     *          @OA\JsonContent(ref="#/components/schemas/User-item")
     *       ),
     *      @OA\Response(response=404, ref="#/components/responses/NotFound")
     * )
     * @param int $index
     * @return UserRessouce
     */
    public function show(int $index): UserRessouce
    {
        return new UserRessouce($this->userRepository->find($index));
    }

    public function store(AdminUpdateRequest $request)
    {

    }

    /**
     * @OA\Put(
     *     path="/user/{id}",
     *     tags={"user", "put"},
     *     security={"apiKey"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\RequestBody(ref="#/components/requestBodies/AdminUpdateRequest")
     *
     * )
     */
    public function update()
    {

    }

    public function profileUpdate(ProfileUpdateRequest $request)
    {
        $me = $request->user();
        $data = [
            'sexe' => in_array($request->sexe, ['-', 'm', 'f']) ? $request->sexe : "",
            'location' => $request->location,
            'bio' => $request->bio,
            'twitter_username' => $request->twitter_username,
            'facebook_username' => $request->facebook_username,
            'google_plus_username' => $request->google_plus_username,
            'pinterest_username' => $request->google_plus_username,
            'dribbble_username' => $request->dribbble_username,
            'github_username' => $request->github_username,
            'url' => $request->url
        ];

        $me->email_show = $request->email_hidden ? 0 : 1;
        $me->profile->update($data);
        $save = $me->save();
        if ($save)
            return Helper::responseSuccess("this succes");
        return Helper::responseError("Errors!", 500);


    }

    public function accountUpdate(AccountUpdateRequest $request)
    {
        $me = $request->user();
        if ($request->email != $me->email) {
            $inputs = $request->only(["username", "first_name", "last_name"]);
            $this->sendMailAddressChange($me, $request->email);
            $save = $me->update($inputs);

        } else {

            $inputs = $request->only(["username", "email", "first_name", "last_name"]);
            $save = $me->update($inputs);
        }
        $save = $me->update($inputs);
        if ($save)
            return Helper::responseSuccess("this succes");
        return Helper::responseError("Errors!", 500);
    }

    public function changeAvatar(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            "avatar" => ['required', "image", "max:2000", new ImageSize(200, 200)]
        ]);
        if ($validatedData->fails()) return Helper::responseErrorValidator($validatedData->errors()->toArray());
        $me = $request->user();
        $file = $request->avatar->getPathName();
        $image = Image::make($file);
        $imageName = sprintf("img/profile_images/%s.avatar.jpg", $me->username);
        $save = $image->save(public_path() . "/" . $imageName);

        if ($save) {
            $me->profile->update([
                'avatar' => $imageName,
                'avatar_status' => ImageDB::AVATAR_STATUS_LOCALE,
            ]);
            return Helper::responseSuccess("image a été telechargé");
        }
        return Helper::responseError("operation érronée", 422);

    }

    public function changeCover(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            "cover" => ['required', "image", "max:2000", new ImageSize(300, 1000)]
        ]);
        if ($validatedData->fails()) return Helper::responseErrorValidator($validatedData->errors()->toArray());
        $me = $request->user();
        $file = $request->cover->getPathName();
        $image = Image::make($file);
        $imageName = sprintf("img/cover_images/%s.cover.jpg", $me->username);
        $save = $image->save(public_path() . "/" . $imageName);

        if ($save) {
            $me->profile->update([
                'cover' => $imageName,
            ]);
            return Helper::responseSuccess("image a été telechargé");
        }
        return Helper::responseError("operation érronée", 422);
    }
}
