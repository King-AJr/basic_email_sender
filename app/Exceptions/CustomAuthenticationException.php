<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CustomAuthenticationException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        // You can log the exception or perform other actions here
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json(['error' => 'Please include a valid authorization token'], Response::HTTP_UNAUTHORIZED);
    }
}
