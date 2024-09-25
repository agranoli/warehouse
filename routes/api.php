<?php

//use App\Http\Controllers\GetCategoryController;
use App\Http\Controllers\GetCategoryController;
use App\Http\Controllers\NewCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\NewCategoryController;

Route::post('/categories', [NewCategoryController::class, 'store']);
Route::get('/categories', [GetCategoryController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
