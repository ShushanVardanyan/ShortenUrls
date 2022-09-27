<?php

use App\Http\Controllers\CsvController;
use App\Http\Controllers\ShortenerController;
use App\Http\Controllers\ShortUserController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__ . '/auth.php';
Route::get('/downloadCsv', [CsvController::class, 'csvDownload'])->name('csv.download');
Route::get('/links', [ShortUserController::class, 'index'])->name('user.links')->middleware('auth');
Route::post('/short', [ShortenerController::class, 'shortenUrl'])->name('shorten.url');
Route::get('/{shortUrlKey}', [ShortenerController::class, 'show'])->name('shorten.show');
