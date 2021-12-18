<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\DoctorController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/{any}', [BackendController::class, 'index'])->where('any', '.*');
    Route::get('/', [BackendController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'adminAPI', 'as' => 'adminAPI.'], function () {
    Route::group(['prefix' => 'doctor', 'as' => 'doctor.'], function () {
        Route::get('', [DoctorController::class, 'index'])->name('index');
        Route::post('/update/{doctor}', [DoctorController::class, 'update'])->name('update');
    });
});
