<?php

use App\Http\Controllers\EmailTestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EmailTestController::class, 'showForm']);
Route::post('/send-test-email', [EmailTestController::class, 'sendTest']);