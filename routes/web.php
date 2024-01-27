<?php

use App\Http\Controllers\commentsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\postController;
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
//Definimos las rutas para el login
//usamos el middleware guest para que sea reenviado si no esta autenticado
Route::get('/',[homeController::class,'index']) -> name('index') -> middleware('guest');
Route::post('/',[homeController::class,'login'])-> name('login');
Route::post('home/',[homeController::class,'logout'])-> name('logout');
//Rutas con middleware auth para dar accesos a estas url solo si el usuario esta autenticado
Route::controller(postController::class) -> group(function(){
    Route::get('home','home') -> name('home') -> middleware('auth');
    Route::get('post/createPost','create') -> name('post.createPost')-> middleware('auth');
    Route::post('post/savepost','savepost') -> name('post.savepost')-> middleware('auth');
    Route::get('post/showPost/{post_id}','showPost') -> name('post.showPost')-> middleware('auth');
    Route::get('post/ShowPost/{post_id}/editPost','editPost') -> name('post.editPost')-> middleware('auth');
    Route::put('post/posts/{post_id}',  'updatePost')->name('post.updatePost')-> middleware('auth');
    Route::delete('post/posts/{post}', 'destroyPost') ->name('post.destroyPost')-> middleware('auth');
});
//Rutas con middleware auth para dar accesos a estas url solo si el usuario esta autenticado
Route::controller(commentsController::class) -> group(function(){
    Route::post('post/savecomments','savecomments') -> name('post.savecomments')-> middleware('auth');
    Route::delete('post/{comment}', 'destroycomments') ->name('comments.destroycomments')-> middleware('auth');
    Route::get('post/ShowPost/{comments}/editcomments',  'editcomments')->name('post.editcomments')-> middleware('auth');
    Route::put('post/ShowPost/{comments}',  'updatecomments')->name('post.updatecomments')-> middleware('auth');
});