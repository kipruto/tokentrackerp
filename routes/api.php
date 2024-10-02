<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['api']], function () {


});

Route::get('/php-version', function () {
    return response()->json([
        'app_version' => env('APP_VERSION'),
        'php_version' => phpversion(),
    ]);
});
