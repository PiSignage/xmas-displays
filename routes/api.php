<?php

use App\Http\Controllers\Api\DisplayController;
use Illuminate\Support\Facades\Route;

Route::get('displays', [DisplayController::class, 'index']);
