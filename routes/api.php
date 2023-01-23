<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/company/{id}', [CompanyApiController::class, 'getById'])->where('id', '[0-9]+');
Route::post('/company/list', [CompanyApiController::class, 'getList']);

Route::post('/company', [CompanyApiController::class, 'create']);
Route::put('/company/{id}', [CompanyApiController::class, 'update'])->where('id', '[0-9]+');
Route::delete('/company/{id}', [CompanyApiController::class, 'delete'])->where('id', '[0-9]+');
