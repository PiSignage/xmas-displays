<?php

use App\Http\Controllers\Api\DisplayController;
use Illuminate\Support\Facades\Route;

// Route::post('displays', [DisplayController::class, 'index']);
Route::get('/displays', [DisplayController::class, 'app']);
