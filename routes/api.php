<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('loginuser', 'App\Http\Controllers\LoginController@login');
Route::post('forgotpass', 'App\Http\Controllers\LoginController@change_password_api');
// Route::post('regispegawai', 'App\Http\Controllers\LoginController@register');



Route::group(['middleware' => 'auth:api-pegawai,api-anggota,api-instructor'], function(){
    Route::get('data-permission','App\Http\Controllers\InstructorPermissionController@getData');
    Route::get('data-schedule/{id}','App\Http\Controllers\InstructorPermissionController@getDataSchedule');
    Route::post('store-data-permission','App\Http\Controllers\InstructorPermissionController@store');
    
    Route::post('booking-class','App\Http\Controllers\BookingClassController@store');
    Route::get('booking-class-history','App\Http\Controllers\BookingClassController@getDataBooking');
    Route::delete('cancel-booking/{id}','App\Http\Controllers\BookingClassController@cancelBooking');

    Route::post('booking-gym','App\Http\Controllers\BookingGymController@store');
    Route::get('booking-gym-history','App\Http\Controllers\BookingGymController@index_booking_gym');
    Route::delete('cancel-booking-gym/{id}','App\Http\Controllers\BookingGymController@cancelBookingGym');

    Route::post('presence-instructor','App\Http\Controllers\InstructorAttendanceController@store');
    Route::get('data-schedule-instructor','App\Http\Controllers\InstructorAttendanceController@index_api_schedule');

    Route::get('instructor-schedule-presence/{id}','App\Http\Controllers\BookingClassController@index_api_schedule_presence');
    Route::get('member-presence/{id}','App\Http\Controllers\BookingClassController@index_api_history_presence');
    Route::post('update-transaction-presence','App\Http\Controllers\BookingClassController@update_transaction');
    Route::get('instructor-history','App\Http\Controllers\BookingClassController@history_instructor');

    Route::get('member-profile/{id}','App\Http\Controllers\MemberController@member_profile');
    Route::get('instructor-profile/{id}','App\Http\Controllers\InstructorController@instructor_profile');
    
    Route::post('logoutuser', 'App\Http\Controllers\LoginController@logout');
});
Route::get('data-daily-schedule','App\Http\Controllers\DailyScheduleController@index_api');


Route::get('income-report','App\Http\Controllers\ReportController@income_report');
Route::get('class-activity-report','App\Http\Controllers\ReportController@class_activity_report');

// Route::group(['middleware' => 'auth:api-anggota'], function(){
//     Route::post('logoutuser', 'App\Http\Controllers\LoginController@logout');
// });

// Route::group(['middleware' => 'auth:api-instructor'], function(){
//     Route::post('logoutuser', 'App\Http\Controllers\LoginController@logout');
// });

// Route::group(['middleware' => 'auth:api-anggota'], function(){
//     Route::post('logoutuser', 'App\Http\Controllers\LoginController@logout');
// });

// Route::get('member', 'App\Http\Controllers\MemberController@api_all');