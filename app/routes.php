<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/

Route::get('/', function()
{
    return View::make('home');
});

Route::get('/results', function()
{
    return View::make('results');
});

Route::get('/account', function()
{
    $account = new Account;
    // $account->privileges = '';
    // $account->name = 'Fifth User';
    // $account->username = 'fifthuser';
    // $account->password = 'fifth_password';
    // $account->password_confirmation = 'fifth_password';
    // $account->location = '';
    // $account->phone = '';
    // $account->email = 'fifthuser@example.com';
    // $account->social = '';
    // $account->last_ip = $_SERVER['REMOTE_ADDR'];

    if (!$account->save())
    {
        echo $account->errors();
    }
    else {
        echo 'ok';
    }
});

/*
|--------------------------------------------------------------------------
| Services
|--------------------------------------------------------------------------
*/

Route::get('/search'        , 'SearchController@index');
Route::get('/search/{query}', 'SearchController@show');

Route::get('/beg'     , 'BegController@index');
Route::get('/beg/{id}', 'BegController@show');
Route::put('/beg/{id}', 'BegController@update');

Route::get('/borrow'     , 'BorrowController@index');
Route::get('/borrow/{id}', 'BorrowController@show');
Route::put('/borrow/{id}', 'BorrowController@update');

Route::get('/share'     , 'ShareController@index');
Route::get('/share/{id}', 'ShareController@show');
Route::put('/share/{id}', 'ShareController@update');

// Route::get('/accounts', 'AccountController@getIndex');
Route::get('/accounts', function()
{
    $accounts = Account::all();
    return View::make('accounts')->with('accounts', $accounts);
});

Route::post('/auth/login', array('before' => 'csrf_json', 'uses' => 'AuthController@login'));
Route::get('/auth/logout', 'AuthController@logout');
Route::get('/auth/status', 'AuthController@status');

Route::post('/contact', function()
{
    $name = Input::get('name');
    $email = Input::get('email');
    $note = Input::get('note');
    $timestamp = date('r');
    $data = array('name' => $name, 'email' => $email, 'note' => $note, 'timestamp' => $timestamp); 

    Mail::send('emails.contact', $data, function($message) use ($name, $email)
    {   
        $message->from($email, $name);
        $message->to('admin@begborrowshare.com', 'Admin')->subject('Beg, Borrow, Share Contact Form');
        return Response::json(array('text' => 'Thanks for your message, we\'ll get back to you soon!'));
    });
});