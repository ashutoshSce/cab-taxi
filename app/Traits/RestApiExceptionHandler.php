<?php

namespace App\Traits;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

trait RestApiExceptionHandler
{
    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param Throwable $e
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     * @throws Throwable
     */
    protected function getJsonResponseForException(Request $request, Throwable $e)
    {
        if ($this->isValidationException($e)) {
            return $this->jsonResponse(['errors' => $e->validator->errors()], 422);
        }

        return parent::render($request, $e);
    }

    /**
     * Determines if the given exception is a ValidationException.
     *
     * @param Throwable $e
     * @return bool
     */
    protected function isValidationException(Throwable $e)
    {
        return $e instanceof ValidationException;
    }

    /**
     * Returns json response.
     *
     * @param array|null $payload
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload = null, $statusCode = 404)
    {
        $payload = $payload ?: [];

        return response()->json($payload, $statusCode);
    }
}
