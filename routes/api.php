<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MomoCallbackController;

Route::post('/momo/callback', [MomoCallbackController::class, 'handle']);
