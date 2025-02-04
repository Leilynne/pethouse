<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UserNotFoundException extends HttpException
{
    public function __construct()
    {
        parent::__construct(404,'User not found');
    }
}
