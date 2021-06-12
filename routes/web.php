<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\PortfolioCategoriesController;
use App\Http\Controllers\PortfolioPositionController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Sidebar;
use App\Http\Controllers\tagsController;
use App\Http\Controllers\CategoryRelatedServiceController;
use App\Http\Controllers\CountController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\InfosController;
use App\Http\Controllers\PortfolioItemsController;
use App\Http\Controllers\TermsPoliciesController;
use App\Models\PortfolioItem;
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
Route::get('/clients', [Sidebar::class,'clients'])->name('backend.clients');
Route::get('/services', [Sidebar::class,'services'])->name('backend.serve');
Route::get('/tags', [Sidebar::class,'tags'])->name('backend.tags');
Route::get('/category-related-services', [Sidebar::class,'catServices'])->name('backend.catservices');
Route::get('/portfolio-items', [Sidebar::class,'portfolioItem'])->name('backend.portfolioItem');
Route::get('/infos', [Sidebar::class,'infos'])->name('backend.infos');
Route::get('/counts', [Sidebar::class,'counts'])->name('backend.counts');
Route::get('/faqs', [Sidebar::class,'faqs'])->name('backend.faqs');
Route::get('/terms-policies', [Sidebar::class,'terms'])->name('backend.terms');

//Portfolio categories
Route::post('portfolio-categories/store', [PortfolioCategoriesController::class,'portfolioStore'])->name('portfoliocat.store');
Route::delete('portfolio-categories-del/{id}', [PortfolioCategoriesController::class,'portfolioDestrotoy'])->name('portfoliocat.destroy');
Route::get('portfolio-categories/{id}/edit', [PortfolioCategoriesController::class,'portfolioEdit']);
Route::post('portfolio-categories/updated', [PortfolioCategoriesController::class,'portfolioUpdated'])->name('portfoliocat.updated');

//Portfolio Position
Route::post('portfolio-position/store', [PortfolioPositionController::class,'Store'])->name('portfolioitem.store');
Route::delete('portfolio-position-del/{id}', [PortfolioPositionController::class,'destroy'])->name('portfolioposition.destroy');
Route::get('portfolio-position/{id}/edit', [PortfolioPositionController::class,'portfolioEdit']);
Route::post('portfolio-position/updated', [PortfolioPositionController::class,'updated'])->name('portfolioposition.updated');
// Clients
Route::post('clients/store', [ClientsController::class,'store'])->name('clients.store');
Route::delete('clients/{id}', [ClientsController::class,'destroy'])->name('clients.destroy');
Route::get('clients/{id}/edit', [ClientsController::class,'edit']);
Route::post('clients/updated', [ClientsController::class,'updated'])->name('clients.updated');
// Services
Route::post('services/store', [ServicesController::class,'store'])->name('services.store');
Route::delete('services/{id}', [ServicesController::class,'destroy'])->name('services.destroy');
Route::get('services/{id}/edit', [ServicesController::class,'edit']);
Route::post('services/updated', [ServicesController::class,'updated'])->name('services.updated');
//Tags
Route::post('tags/store', [tagsController::class,'store'])->name('tags.store');
Route::get('tagsdelete', [tagsController::class,'destroy'])->name('tags.destroy');
Route::get('tags/{id}/edit', [tagsController::class,'edit']);
Route::post('tags/updated', [tagsController::class,'updated'])->name('tags.updated');

//Category Related Services
Route::post('catservices/store', [CategoryRelatedServiceController::class,'store'])->name('catservices.store');
Route::get('catservicesdelete', [CategoryRelatedServiceController::class,'destroy'])->name('catservices.destroy');
Route::get('catservices/{id}/edit', [CategoryRelatedServiceController::class,'edit']);
Route::post('catservices/updated', [CategoryRelatedServiceController::class,'updated'])->name('catservices.updated');

//Info
Route::post('infos/store', [InfosController::class,'store'])->name('infos.store');
Route::get('infosdelete', [InfosController::class,'destroy'])->name('infos.destroy');
Route::get('infos/{id}/edit', [InfosController::class,'edit']);
Route::post('infos/updated', [InfosController::class,'updated'])->name('infos.updated');

//Count
Route::post('count/store', [CountController::class,'store'])->name('count.store');
Route::get('countdelete', [CountController::class,'destroy'])->name('count.destroy');
Route::get('count/{id}/edit', [CountController::class,'edit']);
Route::post('count/updated', [CountController::class,'updated'])->name('count.updated');

//Count
Route::post('faqs/store', [FaqsController::class,'store'])->name('faqs.store');
Route::get('faqsdelete', [FaqsController::class,'destroy'])->name('faqs.destroy');
Route::get('faqs/{id}/edit', [FaqsController::class,'edit']);
Route::post('faqs/updated', [FaqsController::class,'updated'])->name('faqs.updated');
//Tems Policies
Route::post('terms/store', [TermsPoliciesController::class,'store'])->name('terms.store');
Route::get('termsdelete', [TermsPoliciesController::class,'destroy'])->name('terms.destroy');
Route::get('terms/{id}/edit', [TermsPoliciesController::class,'edit']);
Route::post('terms/updated', [TermsPoliciesController::class,'updated'])->name('terms.updated');


//Conditional Dropdown
Route::get('out-category/{id}', [PortfolioItemsController::class,'catToItem']);
