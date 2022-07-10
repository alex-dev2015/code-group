<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * Incluindo a classe personalizada de erros
     */
    use ApiHandler;

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
     *
     * Sobreecrevendo o método render para manipular as respostas de erro.
     *
     */
    public function render($request, Throwable $e)
    {
        if ($request->is('api/*')) {

            $answerPersonalized = $this->traitErrors($e);

            if ($answerPersonalized) {
                return $answerPersonalized;
            }
        }

        return parent::render($request, $e);
    }
}
