<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clients',ClientController::class);
// Route::get('search',[ClientController::class,'search']);
// Route::get('status',[ClientController::class,'status']);
// Route::get('cities',[ClientController::class,'cities']);

Route::get('clients/list', function(){
    return view('client_list');
})->name('list');
