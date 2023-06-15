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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();


Route::controller(App\Http\Controllers\LoginController::class)->group(function(){
    Route::get('/','index')->name('loginpage');
    Route::post('login/process','login'); 
    Route::get('/search','search');
    Route::post('/search-email','search_email');
    Route::post('/change-password/{id}','change_password');
});

Route::group(['middleware' => ['cekUserLogin']],function(){
    Route::get('dashboard/main',[App\Http\Controllers\DashboardController::class,'index'])->name('dashboard-main');
    
    Route::group(['middleware' => ['ManajerOperasional']],function(){
        Route::controller(App\Http\Controllers\GeneralScheduleController::class)->group(function(){
            Route::get('dashboard/general-schedule','index');
            Route::get('dashboard/create-general-schedule','create');
            Route::post('dashboard/store-general-schedule','store');
            Route::get('dashboard/edit-general-schedule/{id}','edit');
            Route::put('dashboard/edit-general-schedule/update-general-schedule/{id}','update');
            Route::delete('dashboard/delete-general-schedule/{id}','destroy');
        });
    
        Route::controller(App\Http\Controllers\DailyScheduleController::class)->group(function(){
            Route::get('dashboard/daily-schedule','index');
            Route::get('dashboard/generate-daily-schedule','generate_schedule');
            Route::get('dashboard/edit-daily-schedule/{id}','edit');
            Route::get('dashboard/search-daily-schedule','search');
            Route::put('dashboard/edit-daily-schedule/update-daily-schedule/{id}','update');
            Route::get('dashboard/abolished-daily-schedule/{id}','abolished');
        });

        Route::controller(App\Http\Controllers\InstructorPermissionController::class)->group(function(){
            Route::get('dashboard/instructor-permission','index');
            Route::get('dashboard/permission-confirmation/{id}','confirmation');
        });

        Route::controller(App\Http\Controllers\ReportController::class)->group(function(){
            Route::get('dashboard/income-report','index_income_report');
            Route::get('dashboard/income-report-process','income_report');
            Route::get('dashboard/class-activity-report','index_class_activity_report');
            Route::get('dashboard/class-activity-report-process','class_activity_report');
            Route::get('dashboard/gym-activity-report','index_gym_activity_report');
            Route::get('dashboard/gym-activity-report-process','gym_activity_report');
            Route::get('dashboard/instructor-report','index_instructor_report');
            Route::get('dashboard/instructor-report-process','instructor_report');
            
        });
    });

    Route::group(['middleware' => ['Admin']],function(){
        Route::controller(App\Http\Controllers\InstructorController::class)->group(function(){
            Route::get('dashboard/instructor','index');
            Route::get('dashboard/create-instructor', 'create');
            Route::post('dashboard/store-instructor', 'store');
            Route::get('dashboard/search-instructor','search');
            Route::get('dashboard/edit-instructor/{id}','edit');
            Route::put('dashboard/edit-instructor/update-instructor/{id}', 'update');
            Route::delete('dashboard/delete-instructor/{id}', 'destroy');
        });
    });

    Route::group(['middleware' => ['Kasir']],function(){
        Route::controller(App\Http\Controllers\MemberController::class)->group( function(){
            Route::get('dashboard/member','index');
            Route::get('dashboard/deactive-member','index_deactive');
            Route::get('dashboard/reset-class-member','reset_class_index');
            Route::get('dashboard/reset-class-member-process','reset_class');
            Route::get('dashboard/deactive-member-process','deactive');
            Route::get('dashboard/create-member', 'create');
            Route::post('dashboard/store-member', 'store');
            Route::get('dashboard/search-member','search');
            Route::get('dashboard/cetak-member/{id}','cetak_card');
            Route::get('dashboard/edit-member/{id}','edit');
            Route::get('dashboard/reset-password-member/{id}','reset_password');
            Route::put('dashboard/edit-member/update-member/{id}', 'update');
            Route::delete('dashboard/delete-member/{id}', 'destroy');
        });

        Route::controller(App\Http\Controllers\InstructorController::class)->group( function(){
            Route::get('dashboard/reset-late-instructor','reset_late_index');
            Route::get('dashboard/reset-late-instructor-process','reset_late');
        });
        
        Route::controller(App\Http\Controllers\ActivationTransactionController::class)->group(function(){
            Route::get('dashboard/activation-transaction','index');
            Route::post('dashboard/create-activation-transaction','create');
            Route::get('dashboard/activation-transaction-receipt/{id}','print_receipt');
            Route::get('dashboard/activation-transaction-confirmation','index_confirm_activation');
        });

        Route::controller(App\Http\Controllers\MoneyDepoController::class)->group(function(){
            Route::get('dashboard/money-deposit','index');
            Route::get('dashboard/money-deposit-receipt/{id}','print_receipt');
            Route::post('dashboard/create-money-deposit','store_data');
            Route::get('dashboard/money-deposit-confirmation','index_confirm_depomoney');
        });

        Route::controller(App\Http\Controllers\DepoClassTransactionController::class)->group(function(){
            Route::get('dashboard/class-deposit','index');
            Route::get('dashboard/class-deposit-receipt/{id}','print_receipt');
            Route::post('dashboard/create-class-deposit','store_data');
            Route::get('dashboard/class-deposit-confirmation','index_confirm_depoclass');
        });

        Route::controller(App\Http\Controllers\BookingClassController::class)->group(function(){
            Route::get('dashboard/presensi-booking-class','index_booking');
            Route::get('dashboard/presensi-class-receipt/{id}','booking_receipt');
        });

        Route::controller(App\Http\Controllers\BookingGymController::class)->group(function(){
            Route::get('dashboard/presensi-booking-gym','index');
            Route::get('dashboard/confirmation-booking-gym/{id}','confirmation_gym');
            Route::get('dashboard/presensi-gym-receipt/{id}','booking_receipt');
        });

        
    });
    Route::get('dashboard/logout',[App\Http\Controllers\LoginController::class,'logout']);
});