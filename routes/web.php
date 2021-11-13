<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', '\App\Http\Controllers\FeedController@index');


Route::get('/home', function () {
    return redirect("/");
});


/*
 * Routes for Chat Controller
*/
Route::get('/chat', function () {
    return view('chat.index');
});

/*
 * Routes for File Controller
*/
Route::get('/files', function () {
    return view('files.index');
});

/*
 * Routes for Link Controller
*/
Route::get('link/new', 'LinkController@getNewCommunityLink')->middleware('auth');;
Route::post('link/new', 'LinkController@postNewCommunityLink')->middleware('auth');;
Route::get('link/{id}/comments', 'LinkController@getViewCommunityLink');
Route::get('link/check', 'LinkController@LookupLink');
Route::get('vote/{type}/{id}', 'VoteController@postVote');


/*
 * Routes for User / Auth Controller
*/
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

/*
 * Routes for Notepad Controller
*/
Route::resource('notepad/create', 'NotepadController@getIndex');
Route::resource('notepads', 'NotepadController@notepadList');
Route::post('notepad/create', array(
    'middleware' => Array("auth", "jwtAuth"),
    'uses' => 'NotepadController@create'
));

/*
 * Routes for Page Controller
*/
Route::resource('page/create', 'PageController@showCreate');
Route::resource('user/1/pages', 'PageController@myPages');
Route::post('page/create', array(
    'middleware' => Array("page", "auth"),
    'uses' => 'PageController@postCreate'
));
Route::resource('page/{id}/view', "PageController@showPage");
Route::resource('page/{id}/copy', "PageController@postCopy");

/*
 * Routes for Community Controller
*/
Route::resource('c/create', 'CommunityController@getCreate');
Route::resource('c/list', 'CommunityController@getIndex');
Route::post('c/create', array(
    'middleware' => Array("community", "auth"),
    'uses' => 'CommunityController@postCreate'
));
Route::resource('community/view', "CommunityController@viewPage", array(
    'middleware' => "community",
    'uses' => 'CommunityController@viewPage'
));
Route::get('p/{community}', ['as' => 'upload-post', 'uses' =>'FeedController@index']);



/*
 * Routes for Image Controller
*/
Route::get('upload', ['as' => 'upload-post', 'uses' =>'ImageController@postUpload']);
Route::post('upload', ['as' => 'upload-post', 'uses' =>'ImageController@postUpload']);
Route::post('upload/delete', ['as' => 'upload-remove', 'uses' =>'ImageController@deleteUpload']);


/*
 * Routes for User Controller
*/
Route::post('settings/email', 'UserController@postEmail');
Route::post('settings/password', 'UserController@postPassword');
Route::get('/settings', function () {
    $user = Auth::User();
    return view('settings.index', ["user"=>$user]);
});


/*
 * Routes for Node.JS Socket Controller
*/
Route::get('socket', 'SocketController@index');
Route::get('sendmessage', 'SocketController@sendMessage');
Route::get('writemessage', 'SocketController@writemessage');


/*
 * Routes for API
*/
Route::get('api/communities/search', 'CommunityController@searchAPI');


/*
 * Routes for Misc. 
*/
Route::resource('torrent', 'PageController@torrent');
