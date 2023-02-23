<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
// use Illuminate\Routing\AbstractRouteCollection;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e)
    {

        // if (!$request->wantsJson()) {
        //     return response()->json( [
        //         'success' => false,
        //         'message' => 'put the application/json.',
        //     ], 405 ); 
        // }

        if ($e instanceof MethodNotAllowedHttpException && $request->wantsJson()) 
        {
            return response()->json( [
                    'success' => false,
                    'message' => 'Method is not allowed for the requested route.',
                ], 405 );
        }

        return parent::render($request, $e);
    }
}
