<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ClientResquest;

class ClientController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/clients",
     *     summary="Lista os clientes cadastrados",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     *
     * Listagem dos clientes com paginação definida em 10.
     *
     * @return Response
     */
    public function index()
    {
        $clientList = Client::paginate(10);
        return response()->json($clientList, 200);
    }


    /**
     * * @OA\Post(
     *     path="/api/clients",
     *     summary="Adiciona um novo cliente",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cpf",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="mail",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string" 
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string" 
     *                 ),
     *                 example={"name": "Alex Sousa", "cpf": "04298745670", "mail": "alex.sousa20@hotmail.com", "phone": "98988888888", "address": "Rua da Esperança"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     * 
     * Cadastra um novo cliente
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientResquest $request): Response
    {
        return response(
            Client::create($request->all()), 201
        );
    }

    /**
     * @OA\Get(
     *     path="/api/clients/{client}",
     *     summary="Mostra os detalhes de um cliente",
     *     @OA\Parameter(
     *         description="Código do Cliente",
     *         in="path",
     *         name="client",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="id", value="1", summary="Código do cliente."),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )    
     * )
     * 
     * Lista um cliente em específico.
     *
     * @param  Client $client
     * @return Client
     */
    public function show(Client $client): Client
    {

        return $client;
    }

    /**
     * @OA\Get(
     *     path="/api/clients/search/{cpf}",
     *     summary="Realiza a busca de um cliente pelo CPF",
     *     @OA\Parameter(
     *         description="CPF do cliente",
     *         in="path",
     *         name="cpf",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="cpf", value="04236547890", summary="CPF do Cliente"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )    
     * )
     * Pesquisa cliente por cpf
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request): Response
    {
        return response(
            Client::where('cpf' , $request["cpf"])->get(), 200
        ); 
    }


    /**
     *  * @OA\Put(
     *     path="/api/clients/{client}",
     *     summary="Atualiza um Cliente",
     *     @OA\Parameter(
     *         description="Código do Cliente",
     *         in="path",
     *         name="client",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         @OA\Examples(example="id", value="1", summary="Código do cliente."),
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="cpf",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="mail",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string" 
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="string" 
     *                 ),
     *                 example={"name": "Alex Sousa", "cpf": "04298745670", "mail": "alex.sousa20@hotmail.com", "phone": "98988888888", "address": "Rua da Esperança"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     * 
     * 
     * Atualiza os dados de um cliente.
     *
     * @param  ClientRequest
     * @param  Client $client
     * @return Client
     */
    public function update(ClientResquest $request, Client $client): Client
    {
        $client->update($request->all());

        return $client;
    }

    /**
     * Remove um cliente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return [];
    }
}
