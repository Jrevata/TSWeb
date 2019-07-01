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

use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    return view('welcome');
});

//Login
    Route::get('/login', 'LoginController@confirmToken');
    Route::post('/login', 'LoginController@login');
    
    Route::post('/logout', 'LoginController@logout');

//Projects
    Route::get('/home', 'ProjectController@index');
        //function(){Cache::flush();});
    Route::post('/project/create', 'ProjectController@create');
    Route::post('/project/update', 'ProjectController@update');
    Route::delete('/projects/delete/{idProject}', 'ProjectController@deleteProject');
    
//Users
    Route::get('/users', 'UserController@index');
    Route::post('/users/store', 'UserController@store');
    Route::post('/users/update', 'UserController@update');
    Route::delete('/users/delete/{idUser}', 'UserController@deleteUser');

//Sprints
    Route::get('/sprints/{idProject}', 'SprintController@index');
    Route::post('/sprints/create/{idProject}', 'SprintController@create');
    Route::post('/sprints/update/{idProject}', 'SprintController@update');
    Route::delete('/sprints/delete/{idSprint}', 'SprintController@destroy');

//Team
    Route::get('/team/{idProject}', 'TeamController@index');
    Route::post('/team/newMember/{idProject}', 'TeamController@newMember');
    Route::delete('/team/deleteMember/{idUser}/{idProject}', 'TeamController@deleteMember');

//Daily
    Route::get('/daily/{idProject}/{idSprint}', 'DailyController@index');
    Route::get('/daily/listDaily/{idSprint}/{idUser}', 'DailyController@getDailies');

//MoodToday
    Route::get('/moodtoday/{idProject}/{idSprint}', 'MoodTodayController@index');
    Route::get('/moodtoday/listMoodToday/{idSprint}/{idUser}','MoodTodayController@getMoodTodays');

//Forum
    Route::get('/forum/{idProject}/{idSprint}', 'ForumController@index');
    Route::post('/forum/store', 'ForumController@store');



