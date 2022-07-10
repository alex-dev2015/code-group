<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui é onde as rotas da API são registradas.
|
*/

Route::apiResource('clients', ClientController::class);
Route::get('clients/search/{cpf}', [ClientController::class, 'search'])->name('clients.search');
