<?php

use App\Http\Controllers\TransferController;
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

Route::post('/transfer/transfer',[TransferController::class, 'transfer']);
Route::post('/transfer/returnTransfer',[TransferController::class, 'returnTransfer']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
