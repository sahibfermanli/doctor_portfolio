<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\DoctorController;
use App\Http\Controllers\Backend\EducationController;
use App\Http\Controllers\Backend\SocialController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/{any}', [BackendController::class, 'index'])->where('any', '.*');
        Route::get('/', [BackendController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'adminAPI', 'as' => 'adminAPI.'], function () {
        Route::group(['prefix' => 'doctor', 'as' => 'doctor.'], function () {
            Route::get('', [DoctorController::class, 'index'])->name('index');
            Route::post('/update/{doctor}', [DoctorController::class, 'update'])->name('update');

            Route::group(['prefix' => 'socials', 'as' => 'socials.'], function () {
                Route::get('/{doctor}', [SocialController::class, 'index'])->name('index');
                Route::post('/{doctor}/add/', [SocialController::class, 'store'])->name('add');
                Route::post('/update/{social}', [SocialController::class, 'update'])->name('update');
                Route::delete('/delete/{social}', [SocialController::class, 'destroy'])->name('delete');
            });

            Route::group(['prefix' => 'education', 'as' => 'education.'], function () {
                Route::get('/{doctor}', [EducationController::class, 'index'])->name('index');
                Route::post('/{doctor}/add/', [EducationController::class, 'store'])->name('add');
                Route::post('/update/{education}', [EducationController::class, 'update'])->name('update');
                Route::delete('/delete/{education}', [EducationController::class, 'destroy'])->name('delete');
            });
        });
    });
});
