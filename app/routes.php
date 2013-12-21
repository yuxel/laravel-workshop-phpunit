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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/giris', function()
{
	return View::make('giris');
});


App::bind("file.logger", function () {
    return new FileLogger();
});


Route::post('/giris', function()
{
    $input = Input::get("username");

    if ($input == "phptr") {
        $logger = App::make("file.logger");
        $logger->log("phptr geldi");
    }

	return View::make('girisSonucuGoster', array("username" => $input));
});
