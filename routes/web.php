<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController as Main;
use App\Http\Controllers\FeedController as Feed;

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

Route::get('/',[Main::class, 'index'])->name('index');
Route::get('/test',[Main::class, 'tests'])->name('test');
Route::get('/publisher/{id}',[Main::class, 'publisher'])->name('publisher');
Route::group(['prefix' =>'post/{id}'], function() {
    Route::get('/', [Main::class, 'post'])->name('post.view');
});
Route::resource('article', Feed::class)->only('create', 'store', 'show', 'edit', 'update','destroy');
Route::get('feed', [Feed::class, 'list'])->name('feed');
Route::get('feed/{id}', [Feed::class, 'listPublisher'])->name('feed.for');
Route::put('toggle', [Main::class, 'togglePublisher'])->name('toggle.publisher');
Route::post('upload', [Main::class, 'upload'])->name('upload');
