<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

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
        $this->renderable(function (ModelNotFoundException $e,$request) {
           
            // code is not working returns normal 404
            if( $request->wantsJson() || $request->is('api/*') ){
                return response()->json([
                    'error' => 'Record Not Found',
                    'message' => $e->getMessage()
                ] , 404);
            } 
        });

        $this->renderable(function (AuthorizationException $e,$request) {
           
            if( $request->wantsJson() || $request->is('api/*') ){

                throw new AuthorizationException($e->getMessage(), 403);
            } 
        });

        $this->reportable(function (Throwable $e) {
        //    throw new Exception($e->getMessage());
        });
    }
}
