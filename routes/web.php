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

//get of the main pages

Route::get('/', 'Applicants@index');

Route::get('/appointment', 'Applicants@appointment');

Route::get('/new-participant', 'Applicants@newParticipant');

Route::get('/hired', 'Applicants@hired');

Route::get('/noshow', 'Applicants@noShow');

Route::get('/pcompleted', 'Applicants@completed');

Route::get('/nothired', 'Applicants@notHired');

Route::get('/pnotcompleted', 'Applicants@pNotCompleted');

Route::get('/onhold', 'Applicants@onHold');

Route::get('/archive', 'Applicants@archive');

Route::get('/search', 'Applicants@search');

Route::get('/displayall', 'Applicants@displayAll');

Route::get('/success/{address}', 'Applicants@success');

Route::get('/register-new', 'HomeController@register');

Route::get('/login', 'HomeController@login');

//post of the main pages

Route::post('/addapp', 'Applicants@storeApp');

Route::post('/appointment', 'Applicants@updateApp');

Route::post('/overapp/{id}', 'Applicants@overrideApp');

Route::post('/participant', 'Applicants@updatePart');

Route::post('/addpart/{id}', 'Applicants@storePart');

Route::post('/hired', 'Applicants@updateHired');

Route::post('/addhired/{id}', 'Applicants@storeHired');

Route::post('/noshow', 'Applicants@updateNoShow');

Route::post('/upnoshow/{id}', 'Applicants@storeNoShow');

Route::post('/pcompleted', 'Applicants@updatePCompleted');

Route::post('/upcompleted/{id}', 'Applicants@storePCompleted');

Route::post('/nothired', 'Applicants@updateNotHired');

Route::post('/upnothired/{id}', 'Applicants@storeNotHired');

Route::post('/pnotcompleted', 'Applicants@updatePNotCompleted');

Route::post('/upnotcompleted/{id}', 'Applicants@storePNotCompleted');

Route::post('/onhold', 'Applicants@updateOnHold');

Route::post('/uponhold/{id}', 'Applicants@storeOnHold');

Route::post('/search', 'Applicants@searchDisplay');

// download resumes

Route::post('/getfirstresume/{id}', 'Applicants@getFirstResume');

Route::post('/getupdatedresume/{id}', 'Applicants@getLastResume');

// download word document

Route::post('/createWord', 'ListWord@createApplicantsList');

Route::post('/dlall', 'ListWord@displayAllList');


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
