<?php

namespace App\Exceptions;

use GraphQL\Error\Error;
use Nuwave\Lighthouse\Execution\AuthenticationErrorHandler as LighthouseAuthenticationErrorHandler;
use Closure;
use Illuminate\Support\Facades\Log;

class CustomGraphqlAuthExceptionHandler extends LighthouseAuthenticationErrorHandler
{
    public function __invoke(?Error $error, Closure $next): ?array
    {
        Log::error($error);
        if ($error && $error->getPrevious() instanceof \Illuminate\Auth\AuthenticationException) {
            return [
                'message' => 'Please include a valid authorization token',
            ];
        }

        return $next($error);
    }
}
