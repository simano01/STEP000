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

// ログインしていなくてもアクセスできるもの
// Contact
Route::get('/contact', 'ContactController@view')->name('contact');
Route::post('/contact', 'ContactController@mail')->name('contact.mail');

// Auth
Auth::routes();

// ログイン後にしかアクセスできないもの
Route::group(['middleware' => 'auth'], function() {

  // Mypage
  Route::get('/mypage', 'MypageController@view')->name('mypage');

  // Profile
  Route::get('/profile/{id}/edit', 'Profile\EditController@view')->name('profile.edit');
  Route::post('/profile/{id}/edit', 'Profile\EditController@update')->name('profile.update');
  Route::get('/profile/{id}', 'Profile\DetailController@view')->name('profile.detail');

  // Step
  Route::get('/step', 'Step\ListController@view')->name('step.list');
  Route::post('/step/category', 'Step\ListController@searchCategory')->name('step.search_category');
  Route::post('/step/word', 'Step\ListController@searchWord')->name('step.search_word');
  Route::get('/step/register', 'Step\RegisterController@view')->name('step.register');
  Route::post('/step/register', 'Step\RegisterController@create')->name('step.create');
  Route::get('/step/{id}/edit', 'Step\EditController@view')->name('step.edit');
  Route::put('/step/{id}/edit', 'Step\EditController@update')->name('step.update');
  Route::delete('/step/{id}/edit', 'Step\EditController@delete')->name('step.delete');
  Route::get('/step/{id}', 'Step\DetailController@view')->name('step.detail');
  Route::post('/step/{id}', 'Step\DetailController@charenge')->name('step.charenge');

  // ChildStep
  Route::get('/childStep/{id}/{child_step_id}', 'Step\ChildStep\DetailController@view')->name('childStep.detail');
  Route::post('/childStep/{id}/{child_step_id}', 'Step\ChildStep\DetailController@clear')->name('childStep.clear');

});

// Home ※上記URL以外のアクセス時には全てhome画面へ飛ばす
Route::get('/{any?}', function () {
    return view('index');
})->where('any', '.+');
