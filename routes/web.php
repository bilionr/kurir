<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KurirController;

Route::apiResource('kurirs', KurirController::class);
