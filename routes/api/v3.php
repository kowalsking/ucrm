<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DocsController;

Route::prefix('v3')->group(function () {
    // Маршрути для документів
    Route::prefix('docs')->group(function () {
        Route::get('/', [DocsController::class, 'index']);
        Route::post('/', [DocsController::class, 'store']);
        Route::get('/{doc}', [DocsController::class, 'show']);
        Route::patch('/{doc}/status', [DocsController::class, 'updateStatus']);
        Route::delete('/{doc}', [DocsController::class, 'destroy']);
    });
}); 