<?php

namespace App\Exceptions;

use Exception;

class InvalidPetUpdateRequestException extends Exception
{
    public function __construct()
    {
        parent::__construct('This animal is not your', 403);
    }
}
