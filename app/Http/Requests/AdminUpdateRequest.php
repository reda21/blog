<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\RequestBody;

/**
 * @RequestBody(
 *     request="AdminUpdateRequest",
 *     required=true,
 *     @JsonContent(
 *          required={"name", "email"},
 *          @OA\Property(property="name", type="string"),
 *          @OA\Property(property="email",type="string"),
 *      )
 * )
 * Class AdminUpdateRequest
 * @package App\Http\Requests
 */
class AdminUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
