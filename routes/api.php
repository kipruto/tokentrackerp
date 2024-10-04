<?php

use App\Http\Controllers\api\WorkspaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::post('/login', [LoginController::class, 'login']);

Route::post('/createworkspace', [WorkspaceController::class, 'createWorkspace']);

Route::get('/workspaces', [WorkspaceController::class, 'getWorkspaces']);

Route::get('/workspaces/{id}', [WorkspaceController::class, 'getSpecificWorkspace']);

Route::get('/php-version', function () {
    return response()->json([
        'app_version' => env('APP_VERSION'),
        'php_version' => phpversion(),
    ]);
});
