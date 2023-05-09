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
Route::group(['prefix' =>'post/{id}'], function() {
    Route::get('/', [Main::class, 'post'])->name('post.view');
    Route::get('update', [Main::class, 'post'])->name('post.update');
});
Route::resource('post', Feed::class)->only('create', 'store', 'show', 'edit', 'update','destroy');
Route::get('feed', [Feed::class, 'list'])->name('feed');
