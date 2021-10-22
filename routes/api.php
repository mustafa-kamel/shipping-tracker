<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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

Route::get('/delivered', [\App\Http\Controllers\Admin\ShippingController::class, 'delivered'])->name('shippings.delivered');

Route::get('external-api/', function () {
    $response = Http::get('https://jsonplaceholder.typicode.com/posts');
    return $response->json();
});
