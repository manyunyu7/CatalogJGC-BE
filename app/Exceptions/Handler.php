<?php

namespace App\Exceptions;

use App\Helper\Killa;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

use Illuminate\Validation\ValidationException;
use Psy\Readline\Hoa\FileException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthenticationException) {
            return Killa::responseErrorWithMetaAndResult(401, 0, 'Unauthenticated.', []);
        }

        if ($exception instanceof AuthorizationException) {
            return Killa::responseErrorWithMetaAndResult(403, 0, 'Forbidden.', []);
        }

        if ($exception instanceof ThrottleRequestsException) {
            return Killa::responseErrorWithMetaAndResult(429, 0, 'Too Many Requests.', []);
        }

        if ($exception instanceof HttpException) {
            return Killa::responseErrorWithMetaAndResult($exception->getStatusCode(), 0, $exception->getMessage(), []);
        }

        if ($exception instanceof ModelNotFoundException) {
            return Killa::responseErrorWithMetaAndResult(404, 0, 'Resource not found.', []);
        }

        if ($exception instanceof TokenMismatchException) {
            return Killa::responseErrorWithMetaAndResult(419, 0, 'CSRF token mismatch.', []);
        }

        if ($exception instanceof FileException) {
            return Killa::responseErrorWithMetaAndResult(500, 0, 'File handling error.', [$exception->getMessage()]);
        }

        if ($exception instanceof ValidationException) {
            // Flatten the error messages array
            $errorMessages = implode(' ', array_map(function ($messages) {
                return implode(' ', $messages);
            }, $exception->errors()));

            // Log the response for debugging
            Log::debug('Validation Error Response:', [
                'message' => $errorMessages,
                'errors' => $exception->errors(),
                'failed_rules' => $exception->validator->failed(),
                'input' => $exception->validator->getData()
            ]);

            return Killa::responseErrorWithMetaAndResult(422, 0, $errorMessages, [
                'errors' => $exception->errors(),
                'failed_rules' => $exception->validator->failed(),
                'input' => $exception->validator->getData()
            ]);
        }

        if ($exception instanceof NotFoundHttpException) {
            return Killa::responseErrorWithMetaAndResult(
                404,
                0,
                $exception->getMessage() ?: '404 Not Found', // Ensure a non-empty message
                []
            );
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return Killa::responseErrorWithMetaAndResult(405, 0, '405 Method Not Allowed', []);
        }


        if ($exception instanceof BindingResolutionException) {
            return Killa::responseErrorWithMetaAndResult(405, 0, 'Binding Resolution Exception', [$exception->getMessage()]);
        }

        if ($exception instanceof QueryException) {
            // Get the full error message from the exception
            $errorMessage = $exception->getMessage();

            return Killa::responseErrorWithMetaAndResult(422, 0, $errorMessage, [
                'error_details' => $exception->getMessage(), // Include the full error message in the meta
            ]);
        }
        return Killa::responseErrorWithMetaAndResult(500, 0, '500 An Error Has Occurred' + $exception, []);

        return parent::render($request, $exception);
    }
}
