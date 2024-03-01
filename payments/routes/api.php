<?php

use App\Http\Controllers\StateTransferController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TypeUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/state_transfer/all',[StateTransferController::class, 'list']);
Route::get('/state_transfer/{id}',[StateTransferController::class, 'show']);
Route::get('/type_user/all',[TypeUserController::class, 'list']);
Route::get('/type_user/{id}',[TypeUserController::class, 'show']);
Route::get('/user/all',[UserController::class, 'list']);
Route::get('/user/{id}',[UserController::class, 'show']);
Route::get('/wallet/all',[WalletController::class, 'list']);
Route::get('/wallet/{id}',[WalletController::class, 'show']);

Route::get('/transfer/all',[TransferController::class, 'list']);
Route::get('/transfer/{id}',[TransferController::class, 'show']);
Route::post('/transfer/transfer',[TransferController::class, 'transfer']);
Route::post('/transfer/returnTransfer',[TransferController::class, 'returnTransfer']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
