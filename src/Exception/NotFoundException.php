<?php

namespace Opensaucesystems\Lxd\Exception;

use Http\Client\Exception\HttpException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class NotFoundException extends HttpException
{
    protected $message = 'Not found.';
    
    public function __construct(RequestInterface $request, ResponseInterface $response, ?\Exception $previous = null)
    {
        parent::__construct($this->message, $request, $response, $previous);
    }
}
