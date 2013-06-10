<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/


Route::get('home/login', function() {
	return Redirect::to_route('login');
});
//register /login to point to home/login for get 
Route::get('login', array('as' => 'login',  'uses'=> 'home@login'));

Route::get('resetpassword', array('as' => 'resetpassword',  'uses'=> 'home@resetpassword'));


Route::get('home/register', function() {
	return Redirect::to_route('register');
});

Route::get('register', array('as' => 'register', 'uses' => 'applicant@register'));

//register post to post_login in home controller
Route::post('login', 'home@login');
Route::post('resetpassword', 'home@resetpassword');
Route::post('register', 'applicant@register');
Route::get('logout', 'home@logout');
Route::get('job/search', 'job@search');
Route::get('job/shortlist_tag', 'job@shortlist_tag');
Route::get('job/shortlist_category', 'job@shortlist_category');
Route::post('job/shortlist', 'job@shortlist');
Route::get('job/article', 'job@article');

Route::controller('home');
//EMPLOYER//
Route::controller('employer.post');
Route::controller('employer.template');
Route::controller('employer.profile');
Route::controller('employer.payment');
Route::controller('employer.email');
Route::controller('employer.candidate');
Route::controller('employer');
//APPLICANT//
Route::controller('applicant');


Route::controller(Controller::detect());
/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	if( isset ( $_SERVER['HTTP_REFERER'] ) ) {
		$referer = $_SERVER['HTTP_REFERER'];
		Session::put('referer', $referer);
	}
		
	//return Redirect::to('/employer/register');
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{	
	$referer = $_SERVER['PHP_SELF'];
	Session::put('referer', $referer);
	if (Auth::guest()) return Redirect::to('login');
});

Route::filter('applicant', function() {
	
	if(Auth::user()->role->name != "applicant") {
		return Redirect::to('login');
	}
});

Route::filter('employer', function() {
	if(Auth::user()->role->name != "employer") {
		return Redirect::to('login');
	}
});