<?php

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


Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'],function(){
     //dashboard and modules
     Route::get('/','DashboardController@index')->name('dashboard');

    //surveis
    Route::resource('surveis','SurveyController');
    Route::post('survey','SurveyController@index')->name('survey.index');
    Route::post('survey/store','SurveyController@store')->name('survey.store');
    Route::get('surveyModuleFormDelete/{id}','SurveyController@surveyModuleFormDelete')->name('survey.module.form.delete');

    //videos
    Route::resource('videos','VideoController');
    Route::post('video/search','VideoController@index')->name('video.index');
    Route::get('videoModuleFormDelete/{id}','VideoController@videoModuleFormDelete')->name('video.module.form.delete');

    //roles
    Route::resource('roles','RoleController');
    Route::post('roles/store','RoleController@store')->name('role.store');
    Route::post('searchRoles','RoleController@index');
    Route::post('searchRoleUser/{id}','RoleController@searchRoleUser')->name('role.users.show');
    Route::get('roleModuleFormDelete/{id}','RoleController@roleModuleFormDelete')->name('role.module.form.delete');

    //categoires
    Route::resource('categories','CategoryController');
    Route::post('searchCategory','CategoryController@index')->name('category.index');
    Route::post('category/store','CategoryController@store')->name('category.store');
    Route::post('searchCategorySurvey/{id}','CategoryController@searchCategorySurvey')->name('category.surveis.show');
    Route::get('categoryModuleFormDelete/{id}','CategoryController@categoryModuleFormDelete')->name('category.module.form.delete');

    //options
    Route::resource('options','OptionsController');
    Route::get('optionModuleFormDelete/{id}','OptionsController@optionModuleFormDelete')->name('option.module.form.delete');
    Route::post('searchSurveyOption/{id}','SurveyController@searchSurveyOption')->name('survey.options.show');
    Route::post('searchOptions','OptionsController@index')->name('option.index');
    Route::get('option/{id}','OptionsController@create')->name('option.create');
    Route::post('option/store','OptionsController@store')->name('option.store');

    //index user, do modulo administrator
    Route::get('indexModuleUser','DashboardController@indexModuleUser')->name('index.module.user');
    Route::post('indexModuleUser','DashboardController@indexModuleUser')->name('index.module.user.search');

    //CRUD User
    Route::post('createModuleUserWithRole','DashboardController@createModuleUserWithRole')->name('create.module.user.with.role');
    Route::get('userModuleFormCreate','DashboardController@userModuleFormCreate')->name('user.module.form.create');
    Route::get('userModuleFormEdit/{id}','DashboardController@userModuleFormEdit')->name('user.module.form.edit');
    Route::put('updateModuleUserWithRole/{id}','DashboardController@updateModuleUserWithRole')->name('update.module.user.with.role');
    Route::get('userModuleFormDelete/{id}','DashboardController@userModuleFormDelete')->name('user.module.form.delete');
    Route::post('deleteModuleUserWithRole/{id}','DashboardController@deleteModuleUserWithRole')->name('delete.module.user.with.role');

    //Gráphics
    Route::get('statistics','StatistcsController@index')->name('statistics.index');
    Route::get('month','StatistcsController@month')->name('statistics.month');

    //Newsletters
    Route::get('newletters','NewletterController@index')->name('letters.index');
    Route::post('SearchNewletters','NewletterController@index')->name('letter.index');
    Route::post('store','NewletterController@store')->name('letters.store');
    Route::get('NewsletterModuleFormDelete/{id}','NewletterController@formDelete')->name('letter.form.delete');
    Route::delete('destroy/{id}','NewletterController@destroy')->name('letters.destroy');
});

Route::group(['prefix' => 'guest', 'middleware' => 'auth'],function(){
    Route::get('/','UserController@index')->name('guest.index');
    Route::get('edit','UserController@edit')->name('guest.edit');
    Route::get('editPassword','UserController@editPassword')->name('guest.editPassword');
    Route::post('update','UserController@update')->name('guest.update');
    Route::post('updatePassword','UserController@updatePassword')->name('guest.updatePassword');
    Route::get('showSurveyProfile','UserController@showSurveyProfile')->name('guest.showSurveyProfile');
});
//COOCKIES
//Route::get('coockies','DashboardController@coockies')->name('dashboard.coockies');


Route::get('/','SiteController@index')->name('site.index');
Route::get('/register','SiteController@create')->name('site.create');
Route::post('/store','SiteController@store')->name('site.store');
Route::get('showSurvey/{id}','SiteController@show')->name('site.show');
Route::post('/site/search','SiteController@index')->name('site.search.index');
Route::get('/category/{slug}','SiteController@searchCategory')->name('site.category');
Route::get('contacts','SiteController@contacts')->name('site.contacts');
Route::post('contacts/email','SiteController@contactStore')->name('site.contacts.request');
Route::get('aboutUs','SiteController@aboutUs')->name('site.aboutUs');
Route::get('forgetPasswordForm','SiteController@forgetPasswordForm')->name('site.forgetPasswordForm');
Route::post('forgetEmailStore','SiteController@forgetEmailStore')->name('site.forgetEmailStore');
Route::post('/results/survey/option','SiteController@resultsSurvey');

/******************************************************************
 * Rotas de Autenticação
 ******************************************************************/
// Authentication Routes...
Route::get('login', [
  'as' => 'login',
  'uses' => 'Auth\LoginController@showLoginForm'
])->name('site.login');
Route::post('login', [
  'as' => '',
  'uses' => 'Auth\LoginController@login'
])->name('site.login');
Route::get('logout', [
  'as' => 'logout',
  'uses' => 'Auth\LoginController@logout'
]);

// Password Reset Routes...
Route::post('password/email', [
  'as' => 'password.email',
  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
  'as' => 'password.request',
  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
  'as' => '',
  'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
  'as' => 'password.reset',
  'uses' => 'Auth\ResetPasswordController@showResetForm'
]);
/******************************************************************
 * Rotas de Autenticação
 ******************************************************************/
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
