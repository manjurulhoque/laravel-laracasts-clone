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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/discuss', function () {
	return view('discuss');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function (){
	Route::resource('channels', 'ChannelController');
	Route::resource('discussions', 'DiscussionController');
//	Route::post('/discussion/{slug}', 'DiscussionController@updating')->name('discussion.update');
	Route::post('/discussion/reply/{id}', [
		'uses' => 'DiscussionController@reply',
		'as' => 'discussion.reply'
	]);
	Route::get('/reply/like/{id}', [
		'uses' => 'ReplyController@like',
		'as' => 'reply.like'
	]);
	Route::get('/reply/unlike/{id}', [
		'uses' => 'ReplyController@unlike',
		'as' => 'reply.unlike'
	]);
	Route::get('/reply/edit/{id}', [
		'uses' => 'ReplyController@edit',
		'as' => 'reply.edit'
	]);
	Route::put('/reply/update/{id}', [
		'uses' => 'ReplyController@update',
		'as' => 'reply.update'
	]);
	Route::get('/discussion/watch/{id}', [
		'uses' => 'WatchersController@watch',
		'as' => 'discussion.watch'
	]);
	Route::get('/discussion/unwatch/{id}', [
		'uses' => 'WatchersController@unwatch',
		'as' => 'discussion.unwatch'
	]);
	Route::get('/discussion/best/reply/{id}', [
		'uses' => 'ReplyController@best_answer',
		'as' => 'discussion.best.answer'
	]);

	Route::get('channel/{slug}', [
		'uses' => 'ForumController@channel',
		'as' => 'channel'
	]);
});

Route::get('/forum', 'ForumController@index')->name('forum');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('{provider}/redirect', 'Auth\LoginController@handleProviderCallback')->name('social.callback');