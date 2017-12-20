<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



//Route::get('admin', 'Admin\AdmController@dashboard');

Auth::routes();

Route::prefix('backend')->middleware('role:superadministrator|administrator|editor|author|contributor')->group(function(){

Route::get('/','Admin\AdmController@dashboard');
Route::resource('/users','Admin\UserController');
Route::get('/dashboard','Admin\AdmController@dashboard')->name('backend.dashboard');
Route::resource('/permissions', 'Admin\PermissionController', ['except' => 'destroy']);
Route::resource('/roles', 'Admin\RoleController', ['except' => 'destroy']);
Route::resource('/post', 'Admin\AdminPost');
Route::resource('/category', 'Admin\CategoryPost');
Route::resource('/tags', 'Admin\TagsController');
Route::resource('/questions', 'Admin\QuestionAdmController');
Route::resource('/answer', 'Admin\AnswerController');
Route::resource('/videomanager', 'Admin\VideoAdminController');
Route::resource('/videomanagerde', 'Admin\VideodeAdminController');
Route::resource('/categorymanager', 'Admin\CatVideoController');
Route::resource('/categorymanagerde', 'Admin\CatVideoDeController');
Route::resource('/gallery', 'Admin\GalleryController');
Route::post('dropzone/delete', ['as' => 'dropzone.delete', 'uses' => 'GalleryController@dropzoneDelete']);
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/language', 'LanguageController@change_lang');
Route::get('/kuran', 'KuranController@index');
//Route::get('/postwithcat/{id}', 'CatPostController@posts');
Route::get('/category/{name}',['as'=>'category.post', 'uses'=>'CatPostController@posts'] );

Route::get('/fullpost/{slug}',['as'=>'blog.post', 'uses'=>'CatPostController@idpost'])
    ->where('slug_de','[\w\d\-\_]+');
Route::get('/postwtag/{id}', 'TagspostController@show');
Route::resource('/ask', 'AskController');
Route::get('/vquestions', 'AskController@view_questions');
Route::resource('/video', 'VideoController');
Route::resource('/videode', 'VideodeController');
Route::get('/kuranishqip', 'KuraniController@shqip');