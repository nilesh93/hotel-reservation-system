<?php

namespace App\Exceptions;

use Exception;
use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GuzzleHttp\Exception\ConnectException;
use Swift_TransportException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // TODO: UNCOMMENT ALL THESE LINES TO HANDLE EXCEPTIONS!
        /*if ($e instanceof ModelNotFoundException) {
            //$e = new NotFoundHttpException($e->getMessage(), $e);

            // HTTP Status code 422 Unprocessable Entity -> Means Request is valid
            // but can't continue due to logic errors.
            return response()->view('errors.modelNotFound', [], 422);
        }

        // HTTP Status code 401 Unauthorized -> Means the user tried to access
        // a page restricted on the level of authentication
        // http://royal.pingdom.com/2009/05/06/the-5-most-common-http-errors-according-to-google/
        elseif ($e instanceof ErrorException) {
            return response()->view('errors.errorException', [], 401);
        }

        // HTTP Status code 503 Service Unavailable -> Means Service is temporarily down
        elseif ($e instanceof ConnectException) {
            return response()->view('errors.ConnectException', [], 401);
        }

        // This occurs when Swift Mailer can't connect to the Internet
        elseif ($e instanceof Swift_TransportException) {
            return response()->view('errors.Swift_TransportException', [], 401);
        }

        // 500 -> Internal Server Error
        else {
            return response()->view('errors.generalException', [], 500);
        }*/

        return parent::render($request, $e);
    }
}
