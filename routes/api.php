<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware([
    'guest'
])->controller(\App\Http\Controllers\Api\User\Guest\RegisterController::class)->prefix('guest')->group(function () {
    Route::post('register', 'action')->name('api.user.register.action');
});
