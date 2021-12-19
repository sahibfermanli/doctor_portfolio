<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\DoctorController;
use App\Http\Controllers\Backend\EducationController;
use App\Http\Controllers\Backend\SkillController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/{any}', [BackendController::class, 'index'])->where('any', '.*');
        Route::get('/', [BackendController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'adminAPI', 'as' => 'adminAPI.'], function () {
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/add', [UserController::class, 'store'])->name('add');
            Route::post('/update/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('delete');
        });

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

            Route::group(['prefix' => 'skills', 'as' => 'skills.'], function () {
                Route::get('/{doctor}', [SkillController::class, 'index'])->name('index');
                Route::post('/{doctor}/add/', [SkillController::class, 'store'])->name('add');
                Route::post('/update/{skill}', [SkillController::class, 'update'])->name('update');
                Route::delete('/delete/{skill}', [SkillController::class, 'destroy'])->name('delete');
            });
        });

        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/add', [CategoryController::class, 'store'])->name('add');
            Route::post('/update/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('delete');
        });

        Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::post('/add', [BlogController::class, 'store'])->name('add');
            Route::post('/update/{blog}', [BlogController::class, 'update'])->name('update');
            Route::delete('/delete/{blog}', [BlogController::class, 'destroy'])->name('delete');

            Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
                Route::get('/{blog}', [CommentController::class, 'index'])->name('index');
                Route::post('/{blog}/add/', [CommentController::class, 'store'])->name('add');
                Route::post('/update/{comment}', [CommentController::class, 'update'])->name('update');
                Route::delete('/delete/{comment}', [CommentController::class, 'destroy'])->name('delete');
            });
        });
    });
});
