<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Routes related to the login page and auth
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    /*Dashboard Route*/
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

     /*Profile related Routes*/
     Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile'); /* Showing Profile Main Page*/
        Route::post('/profile', 'create')->name('profile.create'); /* Creating new Account*/
        Route::put('/profile', 'update')->name('profile.update'); /* updating user Account*/
        Route::put('/password', 'password')->name('password.update'); /* updating user Account password*/
        Route::delete('/profile/{user}', 'delete')->name('delete.profile'); /* deleting user Account*/
        Route::get('/user/edit/{user}', 'edit')->name('edit.user'); /* editing user Account*/
    });

    /*Goods Related Routes*/
    Route::controller(GoodController::class)->group(function () {
        Route::get('/goods', 'index')->name('good'); /*Showing Goods Main Pages*/
        Route::post('/goods', 'createGood')->name('good.create'); /* Registering New Good */
        Route::get('/goods/{good}', 'editGood')->name('good.edit'); /*Edit registered Good */
        Route::put('/goods', 'updateGood')->name('good.update'); /* Update specified Good */
        Route::get('/goods/delete/{good}','deleteGood')->name('deleteGood');/**Delete specific Good */
    });
    
    
    /*Exchange Rate Related Routes*/
    Route::controller(RateController::class)->group(function () {
        Route::get('/rates', 'index')->name('rate'); /*Showing rates Main Pages*/
        Route::get('/rates/{rate}', 'edit')->name('rate.edit'); /* edit regitered rates */
        Route::post('/rates/update', 'updateRate')->name('rate.update'); /* update regestred rate */
        Route::get('/rates/delete/{rate}','deleteRate')->name('deleteRate');/**Delete specific Rate */
        Route::post('/rates', 'store')->name('rate.store'); /* Registering New rate */
    });
    
    /*Search Related Routes*/
    Route::controller(SearchController::class)->group(function () {
        Route::get('/search', 'index')->name('search'); /*Showing Search Main Pages*/
        Route::post('/search', 'store')->name('search.store'); /* Registering New search */
        Route::post('/search/check', 'check')->name('search.check'); /* edit regitered Search */
    });
});
