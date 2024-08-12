<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class InvalidPetUpdateRequestException extends HttpException
{
    public function __construct()
    {
        parent::__construct(403, 'This animal is not yours');
    }
}
