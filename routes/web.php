<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
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
Route::group(['prefix' => 'contact', 'as' => 'contact.'], function() {
    Route::get('', [ContactController::class, 'index'])->name('index');
    Route::post('', [ContactController::class, 'store'])->name('store');
});
Route::group(['prefix' => 'blog', 'as' => 'blog.'], function() {
    Route::get('{slug?}', [BlogController::class, 'index'])->name('index');
    Route::get('show/{slug}', [BlogController::class, 'show'])->name('show');
    Route::post('comment/add/{blog}', [BlogController::class, 'store_comment'])->name('add_comment');
});

include ('admin.php');
