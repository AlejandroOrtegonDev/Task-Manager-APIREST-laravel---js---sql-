<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/task', function () {
        return 'task list';
    });

    Route::post('/task', function (Request $request) {
        return 'Hello World';
    });

    Route::put('/task/{id}', function (Request $request, $id) {
        return "Update task $id";
    });

    Route::delete('/task/{id}', function ($id) {
        return "Delete task $id";
    });
});