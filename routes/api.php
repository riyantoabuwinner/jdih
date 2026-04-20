<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/documents', [ApiController::class, 'documents']);
Route::get('/documents/{id}', [ApiController::class, 'document']);
Route::get('/search', [ApiController::class, 'search']);
Route::get('/categories', [ApiController::class, 'categories']);
Route::get('/news', [ApiController::class, 'news']);

// JDIHN Integration
Route::get('/jdihn', [\App\Http\Controllers\Api\JdihnController::class, 'index']);
