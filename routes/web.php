<?php

use App\Http\Controllers\Frontend\MyInformationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('about', [MyInformationController::class, 'index'])->name('about');
Route::get('my-skills', [SkillController::class, 'index'])->name('skills');
