<?php

use App\Http\Controllers\PortfolioCategoriesController;
use App\Http\Controllers\PortfolioPositionController;
use App\Http\Controllers\Sidebar;
use Illuminate\Support\Facades\Artisan;
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

// Route::get('/', function () {
//     return view('backend.index');
// });
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/', [Sidebar::class,'index']);
Route::get('/portfolio-categories', [Sidebar::class,'portfolio_cat'])->name('backend.portfolio_cat');
Route::get('/portfolio-position', [Sidebar::class,'portfolio_position'])->name('backend.portfolio_position');

//Portfolio categories
Route::post('portfolio-categories/store', [PortfolioCategoriesController::class,'portfolioStore'])->name('portfoliocat.store');
Route::delete('portfolio-categories-del/{id}', [PortfolioCategoriesController::class,'portfolioDestrotoy'])->name('portfoliocat.destroy');
Route::get('portfolio-categories/{id}/edit', [PortfolioCategoriesController::class,'portfolioEdit']);
Route::post('portfolio-categories/updated', [PortfolioCategoriesController::class,'portfolioUpdated'])->name('portfoliocat.updated');

//Portfolio Item
Route::post('portfolio-position/store', [PortfolioPositionController::class,'Store'])->name('portfolioitem.store');
Route::delete('portfolio-position-del/{id}', [PortfolioPositionController::class,'destroy'])->name('portfolioposition.destroy');
Route::get('portfolio-position/{id}/edit', [PortfolioPositionController::class,'edit']);
Route::post('portfolio-position/updated', [PortfolioPositionController::class,'updated'])->name('portfolioposition.updated');



