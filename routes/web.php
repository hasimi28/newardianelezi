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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;



//Route::get('admin', 'Admin\AdmController@dashboard');

Auth::routes();

Route::prefix('backend')->middleware('role:superadministrator|administrator|editor|author|contributor')->group(function(){

Route::get('/','Admin\AdmController@dashboard');
Route::resource('/users','Admin\UserController');
Route::get('/dashboard','Admin\AdmController@dashboard')->name('backend.dashboard');
Route::resource('/permissions', 'Admin\PermissionController');
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
//Route::post('dropzone/delete', ['as' => 'dropzone.delete', 'uses' => 'GalleryController@dropzoneDelete']);
Route::resource('/gallerycat', 'Admin\GalleryCat');
Route::resource('/event', 'Admin\EventController');
Route::post('/del_all_post','Admin\AjaxController@del_all_post');
Route::post('/del_all_tags','Admin\AjaxController@del_all_tags');
Route::post('/del_all_questions','Admin\AjaxController@del_all_questions');
Route::post('/del_all_video','Admin\AjaxController@del_all_video');
Route::post('/del_all_videode','Admin\AjaxController@del_all_videode');
Route::post('/del_all_videokatsq','Admin\AjaxController@del_all_videokatsq');
Route::post('/del_all_videokatde','Admin\AjaxController@del_all_videokatde');
Route::post('/del_all_event','Admin\AjaxController@del_all_event');
Route::post('/del_all_users','Admin\AjaxController@del_all_users');
Route::post('/del_cat_post','Admin\AjaxController@del_cat_post');



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
Route::get('/keshilla', 'GalleryController@index');
Route::get('/findsq', 'FindVideoController@findsq');
Route::get('/onvideo/{cat}/{videoname}/', 'FindVideoController@urlvideo');
Route::get('/onvideo', 'FindVideoController@video');
Route::get('/onvideo/{cat}', 'FindVideoController@bycategory');

Route::get('/onvideode/{cat}/{videoname}/', 'FindVideoController@urlvideo_de');
Route::get('/onvideode', 'FindVideoController@video_de');
Route::get('/onvideode/{cat}', 'FindVideoController@bycategory_de');
Route::get('/sendemail', 'SendEmailController@SendMessage');


