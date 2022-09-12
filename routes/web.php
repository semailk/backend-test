<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test-1', [TestController::class, 'testOne']);

Route::get('test-2', [TestController::class, 'testTwo']);

Route::get('test-3', [TestController::class, 'testThree']);

Route::get('test-4', [TestController::class, 'testFour']);

Route::get('test-5', [TestController::class, 'testFive']);

Route::get('test-6', [TestController::class, 'testSix']);

Route::get('test-7', [TestController::class, 'testSeven']);
Route::get('test-7/store', [TestController::class, 'testSevenStore'])->name('seven-test.store');
