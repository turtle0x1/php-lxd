<?php

namespace Opensaucesystems\Lxd\Exception;

use Http\Client\Exception\HttpException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BadRequestException extends HttpException
{
    private $fallbackMessage = "LXD produced an error state but we could not parse the response";

    public function __construct(RequestInterface $request, ResponseInterface $response, \Exception $previous = null)
    {
        $content = json_decode($response->getBody()->getContents(), true);

        $message = json_last_error() !== 0 ? $this->fallbackMessage : $content["error"];

        parent::__construct($message, $request, $response, $previous);
    }
}
