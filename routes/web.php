<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

/** Public routes begins here */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/** Public routes ends here */


/*
| ---------------------------------------------------------------------------
*/


/** Auth routes begins here */
Route::middleware(['auth'])->group(function () {

    // Routes for home controller
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Article routes
    Route::post('articles/update/{id}', [ArticleController::class, 'update']);
    Route::resource('articles', ArticleController::class, ['except' => ['update']]);
});
/** Auth routes ends here */
