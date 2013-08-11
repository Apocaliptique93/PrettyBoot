<?php
Route::controller(array(
    'admin.booter',
    'admin.blacklist',
    'admin.news',
    'admin.plan',
    'admin.server',
    'admin.users.actions.plan',
    'admin.users.actions.history',
    'admin.users.actions',
    'admin.users',
    'admin.settings',
    'admin.support',
    'admin.transaction',

    'mod.users.actions.plan',
    'mod.users.actions.history',
    'mod.users.actions',
    'mod.users',
    'mod',

    'buy.blacklist', // Buy blacklist for user's Skype and IP
    'support', //Handles all USER support routes
    'meme', // Handles IPLogger (meme as less suspicious name)
    'plan', // Handles plan actions
    'admin', // Handles admin panel
    'booter', // Handles all booter related things (User)
    'user' // Handles register and login

));





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



Route::get(array('/', 'home', 'sup', 'bro'), function()
{

    if(Auth::check())
    {
        return View::make('page.user_home')
            ->with('news', News::order_by('created_at', 'DESC')->paginate(4));
        ;
    }
	return View::make('page.user.login');
});

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
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
    if(@$_SERVER["HTTP_CF_CONNECTING_IP"])
    {
        $CF = array('204.93.240.0/24','204.93.177.0/24','199.27.128.0/21','173.245.48.0/20','103.21.244.0/22','103.22.200.0/22','103.31.4.0/22','141.101.64.0/18','108.162.192.0/18','190.93.240.0/20','188.114.96.0/20','197.234.240.0/22','198.41.128.0/17','162.158.0.0/15');
        foreach($CF as $range)
        {
            if(Appsettings::isCloudFlare($range))
            {
                $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
                break;
            }
        }


    }
    $dtz = new DateTimeZone(Config::get('application.timezone'));
    $time_in_sofia = new DateTime('now', $dtz);
    $offset =  $dtz->getOffset( $time_in_sofia )/3600;
    $offset = $offset.':00';
    $offset = ($offset < 0 ? $offset : "+".$offset);
    DB::query('SET time_zone = ?', array($offset));


    /*
     *
     * Check if logged in user is banned
     */


    if(Auth::check())
    {
        Auth::user()->touch();

        if(Auth::user()->isBanned())
        {

            return View::make('error.banned')->with('user', Auth::user());
        }
    }
});

Route::filter('after', function($response)
{
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('/user/login');
});

Route::filter('guest', function()
{
    if(!Auth::guest()){
        return View::make('msg.error')
            ->with('error', 'You are already a member and logged in.');
    }
});

Route::filter('admin', function()
{
   if(Auth::guest())
   {
       return Redirect::to('/user/login');
   }
   if(Auth::user()->group != 3)
   {
       return View::make('msg.error')
           ->with('error', 'You do not have sufficient rights to visit this page');
   }
});
Route::filter('mod', function()
{
    if(Auth::guest())
    {
        return Redirect::to('/user/login');
    }
    if(Auth::user()->group < 2)
    {
        return View::make('msg.error')
            ->with('error', 'You do not have sufficient rights to visit this page');
    }
});

Route::filter('booter', function()
{
   if(Auth::user()->hasPlanExpired())
   {
       return View::make('msg.error')
           ->with('error', 'You need to have an active plan to be allowed in here. <br /> <a href="/plan">Click here to purchase a plan.</a>');
   }
});