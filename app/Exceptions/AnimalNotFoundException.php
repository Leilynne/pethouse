<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AnimalNotFoundException extends HttpException
{
    public function __construct()
    {
        parent::__construct(404,'Animal not found');
    }
}
