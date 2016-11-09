<?php

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;

/** Get the Router instance. */
$router = Router::getInstance();

/** Define static routes. */


// Default Routing
Router::any('/admin/user', 'App\Controllers\User@index');
Router::any('/admin/role', 'App\Controllers\Role@index');
Router::any('/admin/level', 'App\Controllers\Level@index');
Router::any('/admin/statistics', 'App\Controllers\Dashboard@index');
Router::any('/admin/reports', 'App\Controllers\Dashboard@reports');
Router::any('/admin','App\Controllers\Dashboard@index');
Router::any('/admin/','App\Controllers\Dashboard@index');
Router::get('/admin/notification', 'App\Controllers\Notification@index');
Router::get('/admin/news', 'App\Controllers\Notification@index2');
Router::get('/admin/question-answer', 'App\Controllers\Question@index');
Router::get('/admin/faculty', 'App\Controllers\Faculty@index');
Router::get('/admin/profile', 'App\Controllers\Profile@profile');
Router::get('/admin/change-password', 'App\Controllers\Profile@changePassword');
Router::post('/user/change-profile','App\Controllers\Profile@updateProfile');
Router::post('/user/changeMyPassword','App\Controllers\Profile@changeMyPassword');
Router::get('/home','App\Controllers\HomeIndex@index');
Router::get('/contact-us','App\Controllers\HomeIndex@aboutUsPage');
Router::get('/','App\Controllers\HomeIndex@index');

//Login User
Router::get('/user/login', 'App\Controllers\HomeIndex@loginAndSignUpPage');

//Login Admin
Router::post('login', 'App\Controllers\Login@login');
Router::post('/admin/login','App\Controllers\Login@loginConsole');
Router::get('/admin/login','App\Controllers\Login@index');
Router::get('/admin/logout','App\Controllers\Login@logOutAdmin');
Router::get('/logout','App\Controllers\Login@logOut');

//Faculty Home
Router::get('/contribute/(:all)','App\Controllers\HomeIndex@facultyPage');


//Role Admin Action
Router::get('/role/getAll', 'App\Controllers\Role@getAll');
Router::post('/role/add', 'App\Controllers\Role@add');
Router::post('/role/delete', 'App\Controllers\Role@delete');
Router::get('/role/get', 'App\Controllers\Role@get');
Router::post('/role/update', 'App\Controllers\Role@update');

//Faculty Admin Action
Router::get('/faculty/getAll', 'App\Controllers\Faculty@getAll');
Router::post('/faculty/add', 'App\Controllers\Faculty@add');
Router::post('/faculty/delete', 'App\Controllers\Faculty@delete');
Router::get('/faculty/get', 'App\Controllers\Faculty@get');
Router::post('/faculty/update', 'App\Controllers\Faculty@update');

//User Admin Action
Router::get('user/getAll', 'App\Controllers\User@getAll');
Router::get('user/getUserByCode', 'App\Controllers\User@getUserByCode');
Router::post('user/add', 'App\Controllers\User@add');
Router::post('user/delete', 'App\Controllers\User@delete');
Router::get('user/get', 'App\Controllers\User@get');
Router::post('user/update', 'App\Controllers\User@update');
Router::get('user/checkEmail','App\Controllers\User@checkEmailExist');
Router::get('user/checkUser','App\Controllers\User@checkUsernameExist');
Router::get('user/checkPassword','App\Controllers\User@checkPasswordExist');
Router::post('user/createStudent','App\Controllers\User@createStudent');

//Notification Admin Action
Router::get('notification/getAll', 'App\Controllers\Notification@getAll');
Router::post('notification/add', 'App\Controllers\Notification@addNotification');
Router::post('notification/delete', 'App\Controllers\Notification@delete');
Router::get('notification/get', 'App\Controllers\Notification@get');
Router::post('notification/update', 'App\Controllers\Notification@update');

//News Admin Action
Router::get('news/getAll', 'App\Controllers\Notification@getAllNews');
Router::post('news/delete', 'App\Controllers\Notification@delete');
Router::post('news/add', 'App\Controllers\Notification@addNews');
Router::post('news/update', 'App\Controllers\Notification@update');
Router::get('news/get', 'App\Controllers\Notification@get');

//Question and ansaer Admin Action
Router::get('question/getAll', 'App\Controllers\Question@getAll');
Router::post('question/delete', 'App\Controllers\Question@delete');
Router::post('question/add', 'App\Controllers\Question@add');
Router::post('question/update', 'App\Controllers\Question@update');
Router::get('question/get', 'App\Controllers\Question@get');

Router::get('answer/getAnswerById', 'App\Controllers\Question@getAnswerbyID');
Router::post('answer/delete', 'App\Controllers\Question@deleteAns');
Router::post('answer/add', 'App\Controllers\Question@addAns');
Router::post('answer/update', 'App\Controllers\Question@updateAns');
Router::get('answer/get', 'App\Controllers\Question@getAns');

/** End default routes */

/** Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');
/** End Module routes. */

/** If no route found. */
Router::error('Core\Error@index');

/** Execute matched routes. */
$router->dispatch();
