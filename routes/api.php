<?php

use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;


Route::post('/login', [LoginController::class, 'login']);

Route::post('/createworkspace', [WorkspaceController::class, 'createWorkspace']);

Route::get('/workspaces', [WorkspaceController::class, 'getWorkspaces']);

Route::post('/createtask', [TaskController::class, 'createTask']);

Route::get('/fetchadmins', [UserController::class, 'fetchAdmins']);

Route::get('/workspaces/{id}', [WorkspaceController::class, 'getSpecificWorkspace']);

Route::get('/workspaces/{workdspace_id}/tasks', [TaskController::class, 'getTasksByWorkspace']);


Route::get('/php-version', function () {
    return response()->json([
        'app_version' => env('APP_VERSION'),
        'php_version' => phpversion(),
    ]);
});
