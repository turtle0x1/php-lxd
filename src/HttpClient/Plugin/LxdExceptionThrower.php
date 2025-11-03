<?php

namespace Opensaucesystems\Lxd\HttpClient\Plugin;

use Http\Promise\Promise;
use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Http\Client\Exception\HttpException;
use Opensaucesystems\Lxd\Exception\BadRequestException;
use Opensaucesystems\Lxd\Exception\OperationException;
use Opensaucesystems\Lxd\Exception\AuthenticationFailedException;
use Opensaucesystems\Lxd\Exception\NotFoundException;
use Opensaucesystems\Lxd\Exception\ConflictException;

/**
 * Handle LXD errors.
 */
class LxdExceptionThrower implements Plugin
{
    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        return $next($request)->then(
            function (ResponseInterface $response) {
                // Successful response, just return it.
                return $response;
            },
            function (\Throwable $e) use ($request) {
                if ($e instanceof HttpException) {
                    $response = $e->getResponse();
                    $status = $response->getStatusCode();

                    switch ($status) {
                        case 400:
                            throw new BadRequestException($request, $response, $e);
                        case 401:
                            throw new OperationException($request, $response, $e);
                        case 403:
                            throw new AuthenticationFailedException($request, $response, $e);
                        case 404:
                            throw new NotFoundException($request, $response, $e);
                        case 409:
                            throw new ConflictException($request, $response, $e);
                    }
                }

                // Rethrow unhandled exceptions
                throw $e;
            }
        );
    }
}
