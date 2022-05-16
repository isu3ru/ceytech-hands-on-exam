<?php

namespace App\Validators;

use Rakit\Validation\Rule;

/**
 * Image resolution validation class for Rakit\Validation\Validator
 * @see https://github.com/rakit/validation
 * @author Isuru Ranawaka <isuru@ceytech.lk>
 */
class Resolution extends Rule
{
    protected $message = ":attribute needs to have the resolution of :expectedWidth X :expectedHeight in pixels.";

    protected $fillableParams = ['width', 'height'];

    public function check($file): bool
    {
        // make sure required parameters exists
        $this->requireParameters(['width', 'height']);

        // getting parameters
        $expectedWidth = $this->parameter('width');
        $expectedHeight = $this->parameter('height');

        // check the resolution
        $fileinfo = @getimagesize($file["tmp_name"]);
        $actualWidth = $fileinfo[0];
        $actualHeight = $fileinfo[1];
        if (($actualWidth != $expectedWidth) || ($actualHeight != $expectedHeight)) {
            // return false if the image is not the expected resolution
            return false;
        }

        // everything is ok, jpg and in expected resolution, return true
        return true;
    }
}
