<?php

use App\Http\Controllers\DeleteController;
use App\Http\Controllers\GetCategoryController;
use App\Http\Controllers\GetEventController;
use App\Http\Controllers\GetUsersController;
use App\Http\Controllers\NewCategoryController;
use App\Http\Controllers\GetItemsController;
use App\Http\Controllers\NewEventController;
use App\Http\Controllers\NewItemController;
use App\Http\Controllers\GetAvailableItems;
use App\Http\Controllers\NewRentController;
use App\Http\Controllers\GetRentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditEventController;
use App\Http\Controllers\EditItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/categories', [NewCategoryController::class, 'store']);
Route::post('/items', [NewItemController::class, 'store']);
Route::get('/available-items', [GetAvailableItems::class, 'getAvailableItems']);
Route::get('/categories', [GetCategoryController::class, 'index']);
Route::get('/items', [GetItemsController::class, 'index']);
Route::get('/items/{id}', [GetItemsController::class, 'show']);
//Route::delete('/event/{id}', [DeleteController::class, 'destroyEvent']);
//Route::delete('/item/{id}', [DeleteController::class, 'destroyItem']);
Route::put('/items/{id}', [EditItemController::class, 'update']); // Route for updating items
Route::post('/events', [NewEventController::class, 'store']);
Route::get('/events', [GetEventController::class, 'index']);
Route::get('/events/{id}', [GetEventController::class, 'show']);
Route::put('/events/{id}', [EditEventController::class, 'update']); // Route for updating events
Route::get('/users', [GetUsersController::class, 'index']);
Route::get('/status', [AuthController::class, 'status']);
Route::post('/rent', [NewRentController::class,'store'])->middleware('auth:sanctum');
Route::get('/rents', [GetRentController::class, 'index']);
Route::get('/rents/{id}', [GetRentController::class, 'show']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
