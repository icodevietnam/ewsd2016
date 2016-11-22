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
Router::get('/admin/faculty', 'App\Controllers\Faculty@index');
Router::get('/admin/entry', 'App\Controllers\Entry@index');
Router::get('/admin/file', 'App\Controllers\File@index');
Router::get('/admin/profile', 'App\Controllers\Profile@profile');
Router::get('/admin/contact-us', 'App\Controllers\Contact@index');
Router::get('/admin/change-password', 'App\Controllers\Profile@changePassword');
Router::post('/user/change-profile','App\Controllers\Profile@updateProfile');
Router::post('/user/changeMyPassword','App\Controllers\Profile@changeMyPassword');
Router::get('/home','App\Controllers\HomeIndex@index');
Router::get('/contact-us','App\Controllers\HomeIndex@aboutUsPage');
Router::get('/','App\Controllers\HomeIndex@index');

Router::get('/create-entry','App\Controllers\HomeIndex@createEntry');
Router::get('/your-entry','App\Controllers\Entry@yourEntries');
Router::get('/profile','App\Controllers\HomeIndex@profile');
//Login User
Router::get('/user/login', 'App\Controllers\HomeIndex@loginAndSignUpPage');

//Login Admin
Router::post('/login', 'App\Controllers\Login@login');
Router::post('/admin/login','App\Controllers\Login@loginConsole');
Router::get('/admin/login','App\Controllers\Login@index');
Router::get('/admin/logout','App\Controllers\Login@logOutAdmin');
Router::get('/logout','App\Controllers\Login@logOut');

//Faculty Home
Router::get('/contribute/(:all)','App\Controllers\Entry@facultyPage');
Router::get('/entry/getFacultyPage','App\Controllers\Entry@getFacultyPage');
Router::get('/entry','App\Controllers\Entry@viewEntry');
Router::get('/entry/getAll', 'App\Controllers\Entry@getAll');
Router::get('/entry/getFaculty','App\Controllers\Entry@getFaculty');
Router::get('/entry/preReviewCode','App\Controllers\Entry@preReviewCode');
Router::post('/entry/checkCode','App\Controllers\Entry@checkCode');

Router::get('/comment/getByEntry','App\Controllers\Comment@getByEntry');

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
Router::get('/faculty/getEntriesByEachAcademicYear', 'App\Controllers\Faculty@getEntriesByEachAcademicYear');

Router::get('/faculty/getContributorsByEachAcademicYear', 'App\Controllers\Faculty@getContributorsByEachAcademicYear');

//Entry Admin Action
Router::get('/entry/getAll', 'App\Controllers\Entry@getAll');
Router::post('/entry/add', 'App\Controllers\Entry@add');
Router::get('/entry/getEntryByStatus', 'App\Controllers\Entry@getYourEntries');


//File Action
Router::post('/file/checkDocument', 'App\Controllers\File@checkDocument');
Router::post('/file/checkImage', 'App\Controllers\File@checkImage');
//Role Admin Action
Router::get('/file/getAll', 'App\Controllers\File@getAll');
Router::post('/file/add', 'App\Controllers\File@add');
Router::post('/file/delete', 'App\Controllers\File@delete');
Router::get('/file/get', 'App\Controllers\File@get');
Router::post('/file/update', 'App\Controllers\File@update');

//User Admin Action
Router::get('/user/getAll', 'App\Controllers\User@getAll');
Router::get('/user/getUserByCode', 'App\Controllers\User@getUserByCode');
Router::post('/user/add', 'App\Controllers\User@add');
Router::post('/user/delete', 'App\Controllers\User@delete');
Router::get('/user/get', 'App\Controllers\User@get');
Router::post('/user/update', 'App\Controllers\User@update');
Router::get('/user/checkEmail','App\Controllers\User@checkEmailExist');
Router::get('/user/checkUser','App\Controllers\User@checkUsernameExist');
Router::get('/user/checkPassword','App\Controllers\User@checkPasswordExist');
Router::post('/user/createStudent','App\Controllers\User@createStudent');
Router::get('/user/reloadMkcoor','App\Controllers\Faculty@reloadMkcoor');

//Notification Admin Action
Router::get('/notification/getAll', 'App\Controllers\Notification@getAll');
Router::post('/notification/add', 'App\Controllers\Notification@addNotification');
Router::post('/notification/delete', 'App\Controllers\Notification@delete');
Router::get('/notification/get', 'App\Controllers\Notification@get');
Router::post('/notification/update', 'App\Controllers\Notification@update');

/** End default routes */

/** Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');
/** End Module routes. */

/** If no route found. */
Router::error('Core\Error@index');

/** Execute matched routes. */
$router->dispatch();
