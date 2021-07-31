<?php

use Illuminate\Support\Facades\Route;

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
Route::resource('test', 'TestController');
Auth::routes();
Route::namespace('Auth')->group(function(){
    /*
    | Login User meliputi POST login, GET form login dan GET logout
    */
    // Route::get('/login','LoginController@showLoginForm')->name('login')->middleware('guest','throttle:1000,5'); // 1000 request per 5 menit
    Route::post('/login','LoginController@login'); // post Login
    Route::get('/logout','LoginController@logout')->name('logout'); // Logout
    // DEPRECATED Route::post('/change-user','LoginController@change_user')->name('change.user'); 
    // NOT USED Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    // NOT USED Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
    // NOT USED Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
});
Route::get('/','HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){
    
    // MASTER USER
    Route::resource('master_user', 'UserController'); // sistem_user
    Route::get('master_user/destroy/{id}', 'UserController@destroy')->name('master_user.destroy'); // delete user data
    
    // MASTER RUANGAN
    Route::resource('master_room', 'RoomController'); // sistem_user
    Route::get('master_room/destroy/{id}', 'RoomController@destroy')->name('master_room.destroy'); // delete user data

    // APP MEETING MINUTE
    Route::resource('app_meeting', 'MeetingController'); // sistem_user
    Route::get('app_meeting/destroy/{id}', 'MeetingController@destroy')->name('app_meeting.destroy'); // delete user data

    // APP KRS CONSULTATION
    Route::resource('app_krs_consultation', 'KRSConsultationController'); // sistem_user
    Route::get('app_krs_consultation/destroy/{id}', 'KRSConsultationController@destroy')->name('app_krs_consultation.destroy'); // delete user data
    Route::post('app_krs_consultation/store','KRSConsultationController@generate')->name('app_krs_consultation.generate');
    Route::view('/app_krs_consultation-generate','apps.krs_consultation.generate_consultation_data')->name('app_krs_consultation.generate_view');
    

    // MASTER STUDENT
    Route::resource('master_student', 'StudentController'); // sistem_user
    Route::get('master_student/destroy/{id}', 'StudentController@destroy')->name('master_student.destroy'); // delete user data


    // Route::resource('app_penelitian', 'PenelitianController'); // sistem_user
    // Route::get('app_penelitian/destroy/{id}', 'PenelitianController@destroy')->name('app_penelitian.destroy'); // delete user data

    // SYSTEM GROUP
    Route::resource('system_group', 'GroupController'); // sistem_user
    Route::get('system_group/destroy/{id}', 'GroupController@destroy')->name('system_group.destroy'); // delete user data

    // ABOUT
    Route::view('/about', 'about')->name('about');
     
    Route::get('/home', 'HomeController@index')->name('home');
});