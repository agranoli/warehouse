<?php

use App\Http\Controllers\GetCategoryController;
use App\Http\Controllers\GetUsersController;
use App\Http\Controllers\NewCategoryController;
use App\Http\Controllers\GetItemsController;
use App\Http\Controllers\NewEventController;
use App\Http\Controllers\NewItemController;
use \App\Http\Controllers\GetAvailableItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/categories', [NewCategoryController::class, 'store']);
Route::post('/items', [NewItemController::class, 'store']);
Route::get('/available-items', [GetAvailableItems::class, 'getAvailableItems']);
Route::get('/categories', [GetCategoryController::class, 'index']);
Route::get('/items', [GetItemsController::class, 'index']);
Route::get('/items/{id}', [GetItemsController::class, 'show']);
Route::post('/events', [NewEventController::class, 'store']);
Route::get('/users', [GetUsersController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
