<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Back\Dashboard;



/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/



Route::prefix('admin')->name('admin.')->group(function()
{
    Route::get('panel', "App\Http\Controllers\Back\Dashboard@index")->middleware('isAdmin')->name('dashboard'); 
    Route::get('giris', "App\Http\Controllers\Back\AuthController@login")->middleware('isLogin')->name('login'); 
    Route::post('giris', "App\Http\Controllers\Back\AuthController@loginPost")->middleware('isLogin')->name('login.post');
    Route::get('cikis', "App\Http\Controllers\Back\AuthController@logout")->middleware('isAdmin')->name('logout');
    Route::get('/toggle', "App\Http\Controllers\Back\ArticleController@statusChange")->middleware('isAdmin')->name('toggle');
    Route::get('/deletearticle/{id}', "App\Http\Controllers\Back\ArticleController@delete")->middleware('isAdmin')->name('delete.article');
    Route::get('/harddeletearticle/{id}', "App\Http\Controllers\Back\ArticleController@hardDelete")->middleware('isAdmin')->name('hard.delete.article');
    Route::get('/recoverarticle/{id}', "App\Http\Controllers\Back\ArticleController@recover")->middleware('isAdmin')->name('recover.article');
    Route::get('makaleler/silinenler', "App\Http\Controllers\Back\ArticleController@trashed")->middleware('isAdmin')->name('trashed.article');
    Route::resource('makaleler', "App\Http\Controllers\Back\ArticleController")->middleware('isAdmin');
    

    Route::get('/kategoriler', "App\Http\Controllers\Back\CategoryController@index")->name('category.index');
    Route::post('/kategoriler/create', "App\Http\Controllers\Back\CategoryController@create")->name('category.create');
    Route::post('/kategoriler/update', "App\Http\Controllers\Back\CategoryController@update")->name('category.update');
    Route::post('/kategoriler/delete', "App\Http\Controllers\Back\CategoryController@delete")->name('category.delete');
    Route::get('/kategori/status', "App\Http\Controllers\Back\CategoryController@statusChange")->name('category.switch');
    Route::get('/kategori/getData', "App\Http\Controllers\Back\CategoryController@getData")->name('category.getData');

    // PAGE'S ROUTES
    Route::get('/sayfalar', "App\Http\Controllers\Back\PageController@index")->middleware('isAdmin')->name('page.index');
    Route::get('/sayfa/toggle', "App\Http\Controllers\Back\PageController@statusChange")->middleware('isAdmin')->name('page.toggle');
    Route::get('/sayfalar/guncelle/{id}', "App\Http\Controllers\Back\PageController@update")->middleware('isAdmin')->name('page.edit');
    Route::post('/sayfalar/guncelle/{id}', "App\Http\Controllers\Back\PageController@updatePost")->middleware('isAdmin')->name('page.edit.post');
    Route::get('/sayfalar/olustur', "App\Http\Controllers\Back\PageController@create")->middleware('isAdmin')->name('page.create');
    Route::post('/sayfalar/olustur', "App\Http\Controllers\Back\PageController@post")->middleware('isAdmin')->name('page.post');
    Route::get('/sayfa/sil/{id}', "App\Http\Controllers\Back\PageController@delete")->middleware('isAdmin')->name('page.delete');


    Route::get('/ayarlar', "App\Http\Controllers\Back\ConfigController@index")->middleware('isAdmin')->name('config.index');
    Route::post('/ayarlar/update', "App\Http\Controllers\Back\ConfigController@update")->middleware('isAdmin')->name('config.update');




});




/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('site-bakimda', function(){
    return view('\front.offline');
});


Route::get('/', "App\Http\Controllers\HomepageController@index")->name('hompage'); 
Route::get('/sayfa', "App\Http\Controllers\HomepageController@index"); 
Route::get('/iletisim', "App\Http\Controllers\HomepageController@contact")->name('contact'); 
Route::post('/iletisim', "App\Http\Controllers\HomepageController@contactpost")->name('contact.post'); 
Route::get('/kategori/{category}', "App\Http\Controllers\HomepageController@category")->name('category'); 
Route::get('/{Category}/{slug}', "App\Http\Controllers\HomepageController@single")->name('single');
Route::get('/{slug}', "App\Http\Controllers\HomepageController@page")->name('page'); 







