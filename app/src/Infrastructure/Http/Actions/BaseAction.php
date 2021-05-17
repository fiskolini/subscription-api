<?php


namespace Barkyn\Infrastructure\Http\Actions;


use Psr\Http\Message\ResponseInterface;

abstract class BaseAction
{
    /**
     * Return 200 OK status
     *
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    protected function success(ResponseInterface $response): ResponseInterface
    {
        return $response->withStatus(200);
    }

    /**
     * Return 404 Not Found status
     *
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    protected function notFound(ResponseInterface $response): ResponseInterface
    {
        return $response->withStatus(404);
    }

    /**
     * Return json response
     *
     * @param ResponseInterface $response
     * @param array             $data
     *
     * @return ResponseInterface
     */
    protected function withJson(ResponseInterface $response, array $data): ResponseInterface
    {
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Checks if param was given
     *
     * @param array  $params
     * @param string $key
     *
     * @return bool
     */
    protected function hasParam(array $params, string $key): bool
    {
        return array_key_exists($key, $params);
    }

    /**
     * Get param by it's key
     *
     * @param array  $params
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    protected function param(array $params, string $key, $default = null)
    {
        return $params[$key] ?? $default;
    }
}
