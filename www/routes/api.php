<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('voyages', Api\VoyageApiController::class)->names('api.voyages');
    Route::get('voyages/{voyage}/participants', [Api\VoyageApiController::class, 'participants']);
});

