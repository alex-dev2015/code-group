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
     *     path="/clients/{client}",
     *     summary="Mostra os detalhes de um cliente",
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
