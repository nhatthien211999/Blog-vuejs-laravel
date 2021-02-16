
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Data\Users\UserController;
use App\Http\Controllers\Data\Users\Logs\UserLogController;
use App\Http\Controllers\Data\Accounts\UserAccountController;
use App\Http\Controllers\Data\Accounts\Updates\NameUpdateController;
use App\Http\Controllers\Data\Accounts\Updates\EmailUpdateController;
use App\Http\Controllers\Data\Users\Updates\UpdatePasswordController;

/*
* prefix : data
* namespace : Data
*/
    
    Route::prefix('accounts')->namespace('Accounts')->group(function(){
        Route::get('user/{user?}', [UserAccountController::class, 'index']);
        Route::prefix('updates')->namespace('Updates')->group(function(){
            Route::put('email/{user}', [EmailUpdateController::class, 'update']);
            Route::put('name/{user}', [NameUpdateController::class, 'update']);
        });
    });

    Route::prefix('users')->namespace('Users')->group(function(){
        Route::prefix('logs')->namespace('Logs')->group(function(){
            Route::get('{user}', [UserLogController::class, 'index']);
        });

        Route::prefix('updates')->namespace('Updates')->group(function(){
            Route::put('/password/{user}', [UpdatePasswordController::class, 'update']);
            Route::post('/sent-reset-link/{user}', [UpdatePasswordController::class, 'sendResetLink']);
        });

        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
        Route::put('/{user}', [UserController::class, 'update']);
    });
    