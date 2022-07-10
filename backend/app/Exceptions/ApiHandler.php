<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

trait ApiHandler
{
    /**
     * Trata os erros personalizados
     *
     * @param Throwable $e
     * @return Response
     */

    public function traitErrors(Throwable $e): Response|false
    {
        if ($e instanceof ModelNotFoundException) {
            return $this->modelNotFoundException();
        }

        if ($e instanceof ValidationException) {
            return $this->validationException($e);
        }

        return false;
    }


    /**
     * Retorna o erro quando o registro não for encontrado
     *
     * @return Response
     */
    public function modelNotFoundException(): Response
    {
       return $this->standardAnswer(
            "registro-nao-encontrado",
            "O sistema não encontrou o registro que você está buscando",
            404
        );
    }

    /**
     * Retorna o erro quando os dados não são válidos
     *
     * @param ValidationException $e
     * @return Response
    */
    public function validationException(ValidationException $e): Response
    {
        return $this->standardAnswer(
            "erro-validacao",
                "Dados enviados são inválidos",
                400,
                $e->errors()
        );
    }

    /**
     *Retorna uma resposta padrão para os erros da API
     *
     * @param string  $code
     * @param string  $message
     * @param integer $status
     * @param array|null $errors
     * @return Response
     */
    public function standardAnswer(
        string $code,
        string $message,
        int $status,
        array $errors = null
    ): Response {
        $dataResponse = [
            'code'    => $code,
            'message' => $message,
            'status'  => $status,

        ];

        if ($errors) {
            $dataResponse = $dataResponse  + ['errors' => $errors];
        }

        return response(
            $dataResponse,
            $status
        );
    }
}
