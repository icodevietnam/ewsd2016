<?php

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;

/** Get the Router instance. */
$router = Router::getInstance();

/** Define static routes. */

Router::get('/news','App\Controllers\HomeNews@news');
Router::get('/exam','App\Controllers\HomeExam@exam');
Router::get('/notifications','App\Controllers\HomeNews@notifications');
Router::get('/home','App\Controllers\HomeIndex@index');

Router::get('/test','App\Controllers\HomeExam@test');
Router::get('/code','App\Controllers\HomeExam@testByCode');
Router::get('/review','App\Controllers\HomeExam@reviewByCode');

Router::post('/test/markTest','App\Controllers\HomeExam@markTest');

Router::get('/history','App\Controllers\HomeHistory@index');

Router::get('/answer/getAnswer','App\Controllers\Question@getAnswer');
Router::get('/answer/checkAnswer','App\Controllers\Question@checkAnswer');

// Default Routing
Router::any('admin/user', 'App\Controllers\User@index');
Router::any('admin/role', 'App\Controllers\Role@index');
Router::any('admin/level', 'App\Controllers\Level@index');
Router::any('admin/dashboard', 'App\Controllers\Dashboard@index');
Router::any('admin','App\Controllers\Dashboard@index');
Router::any('admin/','App\Controllers\Dashboard@index');
Router::get('admin/notification', 'App\Controllers\Notification@index');
Router::get('admin/news', 'App\Controllers\Notification@index2');
Router::get('admin/question-answer', 'App\Controllers\Question@index');
Router::get('admin/profile', 'App\Controllers\Profile@profile');
Router::get('admin/change-password', 'App\Controllers\Profile@changePassword');
Router::post('user/change-profile','App\Controllers\Profile@updateProfile');
Router::post('user/changeMyPassword','App\Controllers\Profile@changeMyPassword');
Router::get('/home','App\Controllers\HomeIndex@index');
Router::get('/about-us','App\Controllers\HomeAbout@index');
Router::get('/','App\Controllers\HomeIndex@index');

//Login Admin
Router::post('login', 'App\Controllers\Login@login');
Router::post('admin/login','App\Controllers\Login@loginAdmin');
Router::get('admin/login','App\Controllers\Login@index');
Router::get('admin/logout','App\Controllers\Login@logOutAdmin');
Router::get('logout','App\Controllers\Login@logOut');


//Role Admin Action
Router::get('role/getAll', 'App\Controllers\Role@getAll');
Router::post('role/add', 'App\Controllers\Role@add');
Router::post('role/delete', 'App\Controllers\Role@delete');
Router::get('role/get', 'App\Controllers\Role@get');
Router::post('role/update', 'App\Controllers\Role@update');

//User Admin Action
Router::get('user/getAll', 'App\Controllers\User@getAll');
Router::post('user/add', 'App\Controllers\User@add');
Router::post('user/delete', 'App\Controllers\User@delete');
Router::get('user/get', 'App\Controllers\User@get');
Router::post('user/update', 'App\Controllers\User@update');
Router::get('user/checkEmail','App\Controllers\User@checkEmailExist');
Router::get('user/checkUser','App\Controllers\User@checkUsernameExist');
Router::get('user/checkPassword','App\Controllers\User@checkPasswordExist');
Router::post('user/createStudent','App\Controllers\User@createStudent');

//Level Admin Action
Router::get('level/getAll', 'App\Controllers\Level@getAll');
Router::post('level/add', 'App\Controllers\Level@add');
Router::post('level/delete', 'App\Controllers\Level@delete');
Router::get('level/get', 'App\Controllers\Level@get');
Router::post('level/update', 'App\Controllers\Level@update');

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
