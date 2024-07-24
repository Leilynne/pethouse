<?php

namespace App\Exceptions;

use Exception;

class AnimalNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Animal not found', 404);
    }
}
