<?php

namespace App\Rules;

use App\Services\Helper;
use Illuminate\Contracts\Validation\Rule;
use Intervention\Image\Facades\Image;

class ImageSize implements Rule
{
    /**
     * @var int
     */
    private $height;
    /**
     * @var int
     */
    private $width;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $height, int $width)
    {
        //
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
   //     dd(Helper::getimagesize($value), $value);
        $info = Helper::getimagesize($value);
        if ($info["width"] >= $this->width && $info["height"] >= $this->height) return true;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "La taille de :attribute doit être {$this->width} de large et {$this->height} de haut";
    }
}
