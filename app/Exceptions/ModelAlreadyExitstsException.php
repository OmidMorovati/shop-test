<?php


namespace App\Exceptions;

use Illuminate\Http\Response;

class ModelAlreadyExitstsException extends \Exception
{
    protected $message = 'record already updated';
    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;
}
