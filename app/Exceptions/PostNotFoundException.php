<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class PostNotFoundException extends HttpException
{
    public function __construct()
    {
        parent::__construct(404,'Post not found');
    }
}
