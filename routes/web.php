<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\PortfolioCategoriesController;
use App\Http\Controllers\PortfolioPositionController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Sidebar;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\CategoryRelatedServiceController;
use App\Http\Controllers\CountController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\InfosController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PortfolioItemsController;
use App\Http\Controllers\ReqServiceController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TermsPoliciesController;
use App\Http\Controllers\ViewController;
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

/// Route::get('/', function(){
//     return view('welcome');
// });
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});


Route::post('/auth/check',[MainController::class, 'check'])->name('auth.check');

Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/auth/login', [MainController::class,'login'])->name('auth.login');
    Route::get('/auth/logout',[MainController::class, 'logout'])->name('auth.logout');
    Route::get('/', [Sidebar::class,'index']);
    Route::get('/portfolio-categories', [Sidebar::class,'portfolio_cat'])->name('backend.portfolio_cat');
    Route::get('/portfolio-position', [Sidebar::class,'portfolio_position'])->name('backend.portfolio_position');
    Route::get('/clients', [Sidebar::class,'clients'])->name('backend.clients');
    Route::get('/services', [Sidebar::class,'services'])->name('backend.serve');
    Route::get('/req-services', [Sidebar::class,'reqServices'])->name('backend.reqserve');
    Route::get('/tags', [Sidebar::class,'tags'])->name('backend.tags');
    Route::get('/category-related-services', [Sidebar::class,'catServices'])->name('backend.catservices');
    Route::get('/portfolio-items', [Sidebar::class,'portfolioItem'])->name('backend.portfolioItem');
    Route::get('/infos', [Sidebar::class,'infos'])->name('backend.infos');
    Route::get('/counts', [Sidebar::class,'counts'])->name('backend.counts');
    Route::get('/faqs', [Sidebar::class,'faqs'])->name('backend.faqs');
    Route::get('/terms-policies', [Sidebar::class,'terms'])->name('backend.terms');
    Route::get('/settings', [Sidebar::class,'settings'])->name('auth.settings');


     //Portfolio categories
    Route::post('portfolio-categories/store', [PortfolioCategoriesController::class,'portfolioStore'])->name('portfoliocat.store');
    Route::get('portfoliocategoriesdelete', [PortfolioCategoriesController::class,'portfolioDestrotoy'])->name('portfoliocat.destroy');
    Route::get('portfolio-categories/{id}/edit', [PortfolioCategoriesController::class,'portfolioEdit']);
    Route::post('portfolio-categories/updated', [PortfolioCategoriesController::class,'portfolioUpdated'])->name('portfoliocat.updated');


    //Portfolio Position
    Route::post('portfolio-position/store', [PortfolioPositionController::class,'Store'])->name('portfolioitem.store');
    Route::delete('portfolio-position-del/{id}', [PortfolioPositionController::class,'destroy'])->name('portfolioposition.destroy');
    Route::get('portfolio-position/{id}/edit', [PortfolioPositionController::class,'portfolioEdit']);
    Route::post('portfolio-position/updated', [PortfolioPositionController::class,'updated'])->name('portfolioposition.updated');

    // Services
    Route::post('services/store', [ServicesController::class,'store'])->name('services.store');
    Route::get('servicesdelete', [ServicesController::class,'destroy'])->name('services.destroy');
    Route::get('services/{id}/edit', [ServicesController::class,'edit']);
    Route::post('services/updated', [ServicesController::class,'updated'])->name('services.updated');

    // Requested Services
    Route::get('reqservicesdelete', [ReqServiceController::class,'destroy'])->name('reqservices.destroy');
    Route::get('req-services/{id}/edit', [ReqServiceController::class,'edit']);
    Route::post('req-services/updated', [ReqServiceController::class,'updated'])->name('reqservices.updated');

    //Tags
    Route::post('tags/store', [TagsController::class,'store'])->name('tags.store');
    Route::get('tagsdelete', [TagsController::class,'destroy'])->name('tags.destroy');
    Route::get('tags/{id}/edit', [TagsController::class,'edit']);
    Route::post('tags/updated', [TagsController::class,'updated'])->name('tags.updated');

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
    Route::get('terms/{id}/edit',[TermsPoliciesController::class,'edit']);
    Route::post('terms/updated', [TermsPoliciesController::class,'updated'])->name('terms.updated');

    //Conditional Dropdown/ajax call
    Route::get('out-category/{id}', [PortfolioItemsController::class,'catToItem']);
    Route::get('out-category-for-position/{id}', [CategoryRelatedServiceController::class,'catServices']);
    Route::get('out-category-for-portfolio-position/{id}', [PortfolioItemsController::class,'portfolioPositionSet']);
    Route::get('out-cat-value/{id}', [PortfolioItemsController::class,'portfolioPositionSetTwo']);
    Route::get('client-level/{id}', [ClientsController::class,'clientPosition']);
    Route::get('client-level-update/{id}', [ClientsController::class,'clientPositionUpdate']);
    Route::get('get-precedence/{id}/{value}', [ClientsController::class,'quickPass']);
    Route::get('get-precedence-update/{id}/{value}', [ClientsController::class,'quickPassUpdate']);

    //Category related dropdown/ajax
    Route::get('related-level/{id}', [CategoryRelatedServiceController::class,'relatedPosition']);
    Route::get('related-level-update/{id}', [CategoryRelatedServiceController::class,'relatedPositionUpdate']);

    Route::get('get-position/{id}/{value}', [CategoryRelatedServiceController::class,'quickPositionPass']);
    Route::get('get-position-update/{id}/{value}', [CategoryRelatedServiceController::class,'quickPositionPassUpdate']);

    //portfolio items
    Route::post('portfolio-rest-items', [PortfolioItemsController::class,'dataPass'])->name('portfolioitem.passing');

    Route::post('portfolio-rest-items/store', [PortfolioItemsController::class,'store'])->name('portfolio.store');
    Route::get('itemdelete', [PortfolioItemsController::class,'destroy'])->name('portfolio.destroy');
    Route::get('portfoliorestitemsedit/{id}/edit', [PortfolioItemsController::class,'edit']);
    Route::post('portfolio-rest-items/updated', [PortfolioItemsController::class,'updated'])->name('portfolio.updated');

    //View Modal route
    Route::get('cat-view/{id}', [ViewController::class,'viewCat'])->name('cat.view');
    Route::get('item-view/{id}', [ViewController::class,'viewItem'])->name('item.view');
    Route::get('client-view/{id}', [ViewController::class,'viewClient'])->name('client.view');
    Route::get('service-view/{id}', [ViewController::class,'viewService'])->name('service.view');
    Route::get('req-service-view/{id}', [ViewController::class,'viewReqService'])->name('reqservice.view');
    Route::get('tag-view/{id}', [ViewController::class,'viewTag'])->name('tag.view');
    Route::get('catservice-view/{id}', [ViewController::class,'viewCatservice'])->name('catservice.view');
    Route::get('info-view/{id}', [ViewController::class,'viewInfo'])->name('info.view');
    Route::get('count-view/{id}', [ViewController::class,'viewCount'])->name('count.view');
    Route::get('faq-view/{id}', [ViewController::class,'viewFaq'])->name('faq.view');
    Route::get('term-view/{id}', [ViewController::class,'viewTerm'])->name('term.view');

// Clients
    Route::post('clients/store', [ClientsController::class,'store'])->name('clients.store');
    Route::get('clientsdelete', [ClientsController::class,'destroy'])->name('clients.destroy');
    Route::get('clients/{id}/edit', [ClientsController::class,'edit']);
    Route::post('clients/update', [ClientsController::class,'updated'])->name('clients.updated');


    //Category Related Services
    Route::post('catservices/store', [CategoryRelatedServiceController::class,'store'])->name('catservices.store');
    Route::get('catservicesdelete', [CategoryRelatedServiceController::class,'destroy'])->name('catservices.destroy');
    Route::get('catservices/{id}/edit', [CategoryRelatedServiceController::class,'edit']);
    Route::post('catservices/updated', [CategoryRelatedServiceController::class,'updated'])->name('catservices.updated');


    Route::post('old-password', [ResetPasswordController::class,'oldPass'])->name('reset.check');
    Route::post('change-password', [ResetPasswordController::class,'newPass'])->name('newPass.change');


});
