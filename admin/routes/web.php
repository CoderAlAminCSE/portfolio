<?php

use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@HomeIndex')->middleware('loginCheck');
Route::get('/visitor','VisitorController@VisitorIndex')->middleware('loginCheck');

//Admin panel services management
Route::get('/services','servicesController@ServicesIndex')->middleware('loginCheck');
Route::get('/getServicesData','servicesController@getServicesData')->middleware('loginCheck');
Route::post('/deleteService','servicesController@deleteService')->middleware('loginCheck');
Route::post('/detailsService','servicesController@getServicesDetails')->middleware('loginCheck');
Route::post('/updateService','servicesController@UpdateService')->middleware('loginCheck');
Route::post('/addService','servicesController@addService')->middleware('loginCheck');

//Admin panel courses management
Route::get('/courses','courseController@CourseIndex')->middleware('loginCheck');
Route::get('/getCoursesData','courseController@getCourseData')->middleware('loginCheck');
Route::post('/deleteCourses','courseController@deleteCourse')->middleware('loginCheck');
Route::post('/detailsCourses','courseController@getCourseDetails')->middleware('loginCheck');
Route::post('/updateCourses','courseController@UpdateCourse')->middleware('loginCheck');
Route::post('/addCourses','courseController@addCourse')->middleware('loginCheck');

//Admin panel project management
Route::get('/project','projecController@ProjectIndex')->middleware('loginCheck');
Route::get('/getProjectData','projecController@getProjectData')->middleware('loginCheck');
Route::post('/deleteProject','projecController@deleteProject')->middleware('loginCheck');
Route::post('/detailsProject','projecController@getProjectDetails')->middleware('loginCheck');
Route::post('/updateProject','projecController@UpdateProject')->middleware('loginCheck');
Route::post('/addProject','projecController@addProject')->middleware('loginCheck');


//Admin panel contact management
Route::get('/contact','contactController@ContactIndex')->middleware('loginCheck');
Route::get('/getContactData', 'contactController@getContactData')->middleware('loginCheck');
Route::post('/ContactDelete', 'contactController@ContactDelete')->middleware('loginCheck');


// Admin Panel Review Management
Route::get('/Review', 'ReviewController@ReviewIndex')->middleware('loginCheck');
Route::get('/getReviewData', 'ReviewController@getReviewData')->middleware('loginCheck');
Route::post('/ReviewDetails', 'ReviewController@getReviewDetails')->middleware('loginCheck');
Route::post('/ReviewDelete', 'ReviewController@ReviewDelete')->middleware('loginCheck');
Route::post('/ReviewUpdate', 'ReviewController@ReviewUpdate')->middleware('loginCheck');
Route::post('/ReviewAdd', 'ReviewController@ReviewAdd')->middleware('loginCheck');


// Admin Panel Login Management
Route::get('/Login', 'loginController@LoginIndex');
Route::post('/onLogin', 'loginController@onLogin');
Route::get('/Logout', 'loginController@onLogout');


