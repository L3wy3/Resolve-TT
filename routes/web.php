<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\AgentController::class,'showdata']);
Route::post('/{id}', [App\Http\Controllers\AgentController::class,'updateTarget'])->name('agents.update');
